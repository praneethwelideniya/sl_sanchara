<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
	protected $fillable=['name','type','start_time','end_time','start_location','end_location','description','budget'];
	protected $dates=['start_time','end_time'];
    public function activities(){
    	return $this->hasMany(TripActivity::class)->orderBy('start');
    }
    public function users(){
        return $this->belongsToMany(User::class,'trip_users')->withPivot('status');
    }
}
