<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Mail\SubscribeConfirmation;
use App\Models\Address;
use App\Models\Role;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\UploadImageRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('backend.userList', compact('users'));
    }
    public function travellers(){
        $travellers=User::select('id','name','profile_image_id')->with('profileImage')->paginate(12);
            $response = [
                'pagination' => [
                    'total' => $travellers->total(),
                    'per_page' => $travellers->perPage(),
                    'current_page' => $travellers->currentPage(),
                    'last_page' => $travellers->lastPage(),
                    'from' => $travellers->firstItem(),
                    'to' => $travellers->lastItem()
                ],
                'data' => $travellers
            ];
       

        return response()->json($response);        
    }

    public function show($userId)
    {
        $user = User::find($userId);
        return view('backend.userDetails', compact('user'));
    }

    public function destroy($userId)
    {
        if (Auth::user()->id == $userId) {
            return back()->with('errorMsg', 'You cannot delete yourself');
        }
        try {
            User::destroy($userId);
        } catch (\PDOException $e) {
            //Log::error($this->getLogMsg($e));
            return redirect()->back()->with('errorMsg', $this->getMessage($e));
        }
        return back()->with('successMsg', 'User deleted');
    }

    public function create()
    {
        $roles = Role::where('name', '!=', 'owner')->get();
        return view('backend.user_create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $newUser = $request->only('name', 'email');
        $newUser['username']=$request->get('email');
        $newUser['title'] = "user";
        $newUser['website'] = "http://slsanchara.com";
        $newUser['password'] = Hash::make($request->get('password'));
        // $newAddress = $request->only('city', 'country_name');
        $newAddress['city'] = "badulla";
        $newAddress['country_name'] = "Sri Lanka";
        $newUser['cover_image_id'] = 0;
        try {
            $newAddress = Address::create($newAddress);
            $newAddress['address_id'] = $newAddress->id;
            $newUser = User::create($newUser);
            // $newUser->roles()->attach($request->get('role_id'));
            $newUser->roles()->attach(8);
            // $newUser->profileImage()
            // ->create(['src'=>'profile_default.jpg','img_type'=>'profile','caption'=>'Profile Pic','src_type'=>'internal','user_id'=>$newUser->id]);
            $img=Image::create(['src'=>'profile_picture.png','img_type'=>'profile','caption'=>'Profile Pic','src_type'=>'internal','user_id'=>$newUser->id]);
            $newUser->profileImage()->associate($img)->save();
        } catch (\Exception $e) {
            dd($e);
            //Log::error($this->getLogMsg($e));
            // return back()->withInput()->with('errorMsg', $this->getMessage($e));
        }
        return redirect()->route('login-form')->with('successMsg', 'User created!');
    }

    public function edit()
    {
        $user = Auth::user();
        $public=0;     
        return view('traveller.edit',compact('user','public'));
    }

    public function update(UserRequest $request, $userId)
    {
        $newUser = $request->only('name', 'username', 'email');
        $newUser['is_active'] = $request->has('is_active');
        try {
            if ($request->has('password')) {
                $newUser['password'] = \Hash::make($request->get('password'));
            }
            $user = User::where('id', $userId)->first();
            $user->update($newUser);
            if ($request->has('role_id')) {
                $user->roles()->detach();
                $user->roles()->attach($request->get('role_id'));
            }
        } catch (\Exception $e) {
            //Log::error($this->getLogMsg($e));
            // return back()->with('errorMsg', $e->getMessage());
        }
        return redirect()->route('get-user', ['userId' => $userId])->with('successMsg', 'User updated');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $newPassword = $request->get('new_password');

        if (!Hash::check($request->get('old_password'), Auth::user()->password)) {
            return back()->with('errorMsg', 'Unauthorized request');
        }
        try {
            User::where('id', Auth::user()->id)->update(['password' => Hash::make($newPassword)]);
        } catch (\PDOException $e) {
            // Log::error($this->getLogMsg($e));
            // return back()->with('errorMsg', $this->getMessage($e));
        }

        return back()->with('successMsg', 'Password changed');
    }

    public function profile($id=null)
    {
        $public=1;
        if($id==null){
        $user = Auth::user();
        $public=0;
        }
        else{
            $user= User::find($id);
            if(!auth()->guest() && $user->id==auth()->user()->id){
                $public=0;
            }    
        }
        
        
        return view('traveller.user-profile',compact('user','public'));
    }



    public function subscribe(Request $request)
    {
        $clientIP = $_SERVER['REMOTE_ADDR'] ?? null;
        $newAddress = ['ip' => $clientIP];

        try {
            $this->validate($request, ['name' => 'required', 'email' => 'required|email']);

            \DB::transaction(function () use ($newAddress, $request, $clientIP) {
                $newAddress = Address::create($newAddress);
                $newUser = User::where('email', $request->get('email'))->first();

                if (is_null($newUser)) {
                    $newUser = $request->only('email', 'name');
                    $newUser['last_ip'] = $clientIP;
                    $newUser['address_id'] = $newAddress->id;
                    $newUser['token'] = Hash::make($request->get('email'));
                    $newUser = User::create($newUser);
                    $newUser->attachRole(Role::where('name', 'reader')->first());

                    $newUser->reader()->create(['notify' => 0, 'is_verified' => 0]);
                    Mail::to($request->get('email'))->queue(new SubscribeConfirmation($newUser));
                } else {
                    return back()->with('warningMsg', 'You have already subscribed, please contact with admin');
                }
            });
        } catch (\Exception $e) {
            //Log::error($this->getLogMsg($e));
            // return back()->with('errorMsg', $this->getMessage($e));
        }
        return back()->with('successMsg', 'Thanks, a mail has been to confirm you subscription');
    }

    public function confirmSubscribe(Request $request, $userId)
    {
        try {
            $this->validate($request, ['token' => 'required']);

            $user = User::where('id', $userId)
                ->where('token', $request->get('token'))
                ->first();

            if (is_null($user)) {
                return redirect()->route('home')->with('errorMsg', 'Invalid request');
            }

            if ($user->isReader()) {
                $user->reader->update(['is_verified' => 1, 'notify' => 1]);
                return redirect()->route('home')->with('successMsg', 'Congratulation, your subscription confirmed');
            }
        } catch (\Exception $e) {
            // Log::error($this->getLogMsg($e));
            // return response()->json(['errorMsg' => $this->getMessage($e)]);
        }
        return redirect()->route('home')->with('warningMsg', 'Something went wrong');
    }

    public function unSubscribe(Request $request, $userId)
    {
        try {
            $this->validate($request, ['token' => 'required']);

            $user = User::where('id', $userId)
                ->where('token', $request->get('token'))
                ->first();

            if (is_null($user)) {
                return redirect()->route('home')->with('errorMsg', 'Invalid request');
            }

            if ($user->isReader() && $user->reader->notify) {
                $user->reader->update(['is_verified' => 1, 'notify' => 0]);
                return redirect()->route('home')->with('successMsg', 'You have un-subscribed confirmed');
            }
        } catch (\Exception $e) {
            // Log::error($this->getLogMsg($e));
            // return response()->json(['errorMsg' => $this->getMessage($e)]);
        }
        return redirect()->route('home')->with('errorMsg', 'No subscription found');
    }

    public function toggleActive($userId)
    {
        try {
            $user = User::find($userId);
            $user->update(['is_active' => !$user->is_active]);
        } catch (\Exception $e) {
            // Log::error($this->getLogMsg($e));
            // return back()->with('errorMsg', $this->getMessage($e));
        }
        return back()->with('successMsg', 'User updated successfully!');
    }

    public function uploadProPic(UploadImageRequest $request){
        $this->validate($request, [
            'pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $user = auth()->user();
        if ($request->hasFile('pic')) {
        $image = $request->file('pic');
        $name = $user->id.'_profile_'.time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/users').'/profile/';
        $newImage=$user->profileImage()->update(['src'=>$name]);
        $image->move($destinationPath, $name);

        return response()->json(['type'=>"pro_pic",'name'=>$name, 'src'=> '/users/profile/'.$user->profileImage->src]);
    }
}
    public function uploadPic(UploadImageRequest $request){
        $this->validate($request, [
            'pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $user = auth()->user();
        if ($request->hasFile('pic')) {
        $image = $request->file('pic');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/users').'/'.$user->id.'/other/';
        $newImage=$user->images()->create(['src'=> $name,
                            'caption' =>'other',
                            'src_type' =>'internal',
                            'img_type'=>'other']);

        // $newImage->create(['src'=> $name,
        //                     'caption' =>'other',
        //                     'src_type' =>'internal',
        //                     'user_id' => $user->id,
        //                     'img_type'=>'other']);

        $image->move($destinationPath, $name);

         return response()->json(['type'=>"pic",'name'=>$name,'id'=>$newImage->id]);
    }

    }

    public function deletePic(Request $req){
        $user = auth()->user()->images()->findOrFail($req->id)->delete();
        return redirect()->back();

    }

}
