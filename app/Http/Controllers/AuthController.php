<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB;
class AuthController extends Controller
{
    public function showLoginForm()
    {
        // if (Auth::check()) {
        //     return redirect()->route('admin-dashboard');
        // }
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:4|confirmed'
            ]
        );
        $user=new User($request->all());
    }

    public function login(Request $request)
    {

        $this->validate(
            $request,
            [
                'email' => 'required|email',
                'password' => 'required|min:4'
            ]
        );

        $credentials = $request->only('email', 'password');

        $remember = $request->has('remember_me');
        if(User::where([['email',$request->email],['is_active',0]])->first()!=null){
            return back()->withErrors(['Verify Your Email before Login']);   
        }
        if (Auth::attempt($credentials, $remember)) {
                return redirect()->route('user-profile');
            
            //return redirect()->route('admin-dashboard');
        }
        return back()->withErrors(['Credentials not match']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login-form');
    }
    public function verifyUser($token)
    {
      $verifyUser = DB::table('unvalidate_users')->where('token', $token)->first();
      if(!is_null($verifyUser) ){
        $user = User::find($verifyUser->user_id);
        if(!$user->is_active) {
          $user->is_active = 1;
          $user->save();
          $status = "Your e-mail is verified. You can now login.";
        } else {
          $status = "Your e-mail is already verified. You can now login.";
        }
      } else {
        return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
      }
      return redirect('/login')->with('status', $status);
    }
}
