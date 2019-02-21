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
    	$trip=Trip::find($id);
    	$calender=$trip->activities
            ->groupBy(function($date) {
        		return Carbon::parse($date->start)->format('Y-m-d'); // grouping by years
   		 });
    	return view('trip.show',compact('trip','calender'));
    }

    public function create($id=null){
    	$trip=null;
    	$calender=null;
    	if($id!=null){
            $trip=auth()->user()->trips()->find($id);
            if($trip==null){
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
        if(auth()->user()->trips()->find($id)==null){
            return redirect('/');
        }
    	$daterange=$request->daterange;
    	$trip=$request->only('name','type','budget','start_location','end_location','description');
    	$trip['start_time']= Carbon::parse(explode('-', $daterange, 2)[0]);
    	$trip['end_time']=Carbon::parse(explode('-', $daterange, 2)[1]);
    	
    	Trip::find($id)->update($trip);
    	return redirect()->back();

    }
    public function updateActivity(Request $request,$id){
        $trip=auth()->user()->trips()->find($request->trip_id);
        if($trip==null){
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
        if($trip==null){
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

    	$tripActivity->currentActivity()->create($activity);
    	return redirect()->back();
    	
    }
    public function travellers($id){
        $travellers=Trip::find($id)->users()->select('users.id','users.name','users.profile_image_id')->with('profileImage')->paginate(12);
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
}
