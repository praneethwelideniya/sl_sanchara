<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripTransportation extends Model
{
	protected $fillable=['transpotation_type_id','start_location','end_location','start_lat','start_lng','end_lat','end_lng'];
    public function transportType(){
    	return $this->belongsTo(Transpotation::class,'transpotation_type_id');
    }
}
