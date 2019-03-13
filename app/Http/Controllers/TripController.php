<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\TripActivity;
use App\Models\Transpotation;
use Carbon\Carbon;
class TripController extends Controller
{
    public function show($id){
    	$trip=Trip::where('id',$id)->notDeleted()->first();
        if($trip!=null && ($trip->type=='public' || (!auth()->guest() && auth()->user()->trips()->find($id)!=null))){
            $calender=$trip->activities
            ->groupBy(function($date) {
                return Carbon::parse($date->start)->format('Y-m-d'); // grouping by years
            });
            return view('trip.show',compact('trip','calender'));
        }
        return redirect('/');

    }

    public function create($id=null){
    	$trip=null;
    	$calender=null;
    	if($id!=null){
            $trip=auth()->user()->trips()->find($id);
            if($trip==null || $trip->is_deleted==1){
                return redirect('/');
            }
            $activities=$trip->activities;
            $calender=$activities
            ->groupBy(function($date) {
        		return Carbon::parse($date->start)->format('Y-m-d'); // grouping by years
   		 });
        }
        $transpotation_types=Transpotation::get();
    	return view('trip.create',compact('trip','transpotation_types','calender'));
    }
    public function store(Request $request){
    	$daterange=$request->daterange;
    	$trip=$request->only('name','type','budget','start_location','end_location','description');
    	$trip['start_time']= Carbon::parse(explode('-', $daterange, 2)[0]);
    	$trip['end_time']=Carbon::parse(explode('-', $daterange, 2)[1]);

    	$newTrip=Trip::create($trip);
        $newTrip->users()->sync([auth()->user()->id=>['status'=>'confirmed']]);
    	return redirect()->route('create-trip',$newTrip->id);;
    }
    public function update(Request $request,$id){
        $exTrip=auth()->user()->trips()->find($id);
        if($exTrip==null || $exTrip->is_deleted==1){
            return redirect('/');
        }
    	$daterange=$request->daterange;
    	$trip=$request->only('name','type','budget','start_location','end_location','description');
    	$trip['start_time']= Carbon::parse(explode('-', $daterange, 2)[0]);
    	$trip['end_time']=Carbon::parse(explode('-', $daterange, 2)[1]);

    	$exTrip->update($trip);
    	return redirect()->back();

    }
    public function updateActivity(Request $request,$id){
        $trip=auth()->user()->trips()->find($request->trip_id);
        if($trip==null || $trip->is_deleted==1 ){
            return redirect('/');
        }
    	$tripActivity=$trip->activities->where('id',$id)->first();
    	$activity=$request->only('cost','description');
    	$activity['start']= Carbon::parse(explode('-', $request->daterange, 2)[0]);
    	$activity['end']=Carbon::parse(explode('-', $request->daterange, 2)[1]);
    	$tripActivity->update($activity);
    	$activity=[];
    	switch($tripActivity->activity_type){
    		case 'transport':
    			$activity['transpotation_type_id']=$request->transpotation_type_id;
    			$activity['start_location']=$request->start_location;
    			$activity['end_location']=$request->end_location;
    			break;
    		case 'meal':
    					# code...
    			break;
    		case 'accommodate':
    			$activity['accommodation_name']=$request->accommodation_name;
    			break;
    		default:
    			$activity['place_name']=$request->place_name;

    	}

    	$tripActivity->currentActivity()->update($activity);
    	return redirect()->back();

    }

        public function createActivity(Request $request){
        $trip=auth()->user()->trips()->find($request->trip_id);
        if($trip==null || $trip->is_deleted==1){
            return redirect('/');
        }
    	$activity=$request->only('cost','description','activity_type');
    	$activity['start']= Carbon::parse(explode('-', $request->daterange, 2)[0]);
    	$activity['end']=Carbon::parse(explode('-', $request->daterange, 2)[1]);
    	$tripActivity=$trip->activities()->create($activity);
    	$activity=[];
    	switch($tripActivity->activity_type){
    		case 'transport':
    			$activity['transpotation_type_id']=$request->transpotation_type_id;
    			$activity['start_location']=$request->start_location;
    			$activity['end_location']=$request->end_location;
          $activity['start_lat']=$request->start_lat;
          $activity['end_lat']=$request->end_lat;
          $activity['start_lng']=$request->start_lng;
          $activity['end_lng']=$request->end_lng;
    			break;
    		case 'meal':
    		    $activity['place']=$request->place;
            $activity['lat']=$request->lat;
            $activity['lng']=$request->lng;
    			break;
    		case 'accommodate':
    			$activity['accommodation_name']=$request->accommodation_name;
          $activity['lat']=$request->lat;
          $activity['lng']=$request->lng;
    			break;
    		default:
    			$activity['place_name']=$request->place_name;
          $activity['lat']=$request->lat;
          $activity['lng']=$request->lng;
    	}

    	$tripActivity->currentActivity()->create($activity);
    	return redirect()->back();

    }
    public function travellers($id){
        $travellers=Trip::where('id',$id)->notDeleted()->first()->users()->select('users.id','users.name','users.profile_image_id')->with('profileImage','socialMedia')->paginate(12);
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

    public function togleActivity($id,$type){
        $activity = TripActivity::find($id);
        if (is_null($activity)) {
            return redirect()->back()->with('errorMsg', 'Activity not Found');
        }

        if (auth()->guest() || $activity->trip->users()->find(auth()->user()->id)==null) {
            return redirect('/');
        }
        try {
            if($type=='publish'){
                $activity->update([
                    'is_published' => !$activity->is_published
                ]);
            }elseif($type=='delete'){
                $activity->update([
                    'is_deleted' => 1
                ]);
            }
        } catch (\PDOException $e) {
            Log::error($this->getLogMsg($e));
            return redirect()->back()->with('errorMsg', $this->getMessage($e));
        }
        return redirect('/');
    }
  public function togleTrip($id,$type){
        $trip = Trip::where('id',$id)->notDeleted()->first();
        if (is_null($trip)) {
            return redirect()->back()->with('errorMsg', 'Activity not Found');
        }

        if (auth()->guest() || $trip->users()->find(auth()->user()->id)==null) {
            return redirect('/');
        }
        try {
            if($type=='publish'){
                $trip->update([
                    'is_published' => !$trip->is_published
                ]);
            }elseif($type=='delete'){
                $trip->update([
                    'is_deleted' => 1
                ]);
            }
        } catch (\PDOException $e) {
            Log::error($this->getLogMsg($e));
            return redirect()->back()->with('errorMsg', $this->getMessage($e));
        }
        return redirect('/');
    }
}
