<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GooglePlaces;
use App\Models\Trip;
class GoogleAPIController extends Controller
{
    public function getPlaces($type,$input=null){
    	if(is_null($input)){
    		$in=''.$type.'';
    		$response=GooglePlaces::textSearch($in);
    	}
    	else{
    		$in=''.$input.'';
    	$response=GooglePlaces::textSearch($in,['type'=>$type]);
    	}
      //dd($response);
    	$res=[];
    	foreach ($response['results'] as $key => $value) {
    		$res[$key]=['name'=>$value['name'],'location'=>$value['geometry']['location'],'formatted_address'=>$value['formatted_address'],'icon'=>$value['icon']];
    	}
    	return $res;
    }

    public function getTripLocations($id){
      $activities=Trip::find($id)->activities;
      $travel=[];
      $stay=[];
      $key=0;
    	foreach ($activities as $activity) {
        $act=$activity->currentActivity;
        if($activity->activity_type==='transport'){
          array_push  ($travel,['origin'=>['lat'=>floatval($act->start_lat),'lng'=>floatval($act->start_lng)],'destination'=>['lat'=>floatval($act->end_lat),'lng'=>floatval($act->end_lng)]]);
        }
        else{
          array_push($stay,['position'=>['lat'=>floatval($act->lat),'lng'=>floatval($act->lng)]]);
        }
      }
      return response()->json(['travel'=>$travel,'stay'=>$stay]);
    }

    private function getPosition(){
        // return ['lat'=>]
    }
}
