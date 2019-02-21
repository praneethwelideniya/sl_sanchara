<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripActivity extends Model
{
    protected $fillable=['activity_type','start','end','cost','description'];
	protected $dates = ['start','end'];
    // public function tripPlace(){
    // 	return $this->hasOne(TripPlace::class,'activity_id');
    // }
    // Public function tripAccommodation(){
    // 	return $this->hasOne(TripAccommodation::class,'trip_activity_id');
    // }
    // public function tripTransportation(){
    // 	return $this->hasOne(TripTransportation::class,'trip_activity_id');
    // }
    // public function tripMeal(){
    // 	return $this->hasOne(TripMeal::class,'activity_id');
    // }
    public function currentActivity()
    {
    	switch ($this->activity_type){
    		case 'transport':
    			return $this->hasOne(TripTransportation::class,'trip_activity_id');
    			break;
    		case 'accommodate':
    			return $this->hasOne(TripAccommodation::class,'trip_activity_id');
    			break;
    		case 'meal':
    			return $this->hasOne(TripMeal::class,'activity_id');			# code...
    			break;
    		default:
    			return $this->hasOne(TripPlace::class,'activity_id');			
    	}
    }
}
