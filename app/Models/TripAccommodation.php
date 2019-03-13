<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripAccommodation extends Model
{
    protected $fillable=['accommodation_name','lat','lng'];
}
