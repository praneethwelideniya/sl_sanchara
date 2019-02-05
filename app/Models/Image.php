<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	protected $fillable=['src','img_type','caption','src_type','user_id'];
    protected $guarded = ['id'];

}
