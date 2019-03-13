<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Actuallymab\LaravelComment\Contracts\Commentable;
use Actuallymab\LaravelComment\HasComments;

class Trip extends Model implements Commentable
{
    use HasComments;
    
	protected $fillable=['name','type','start_time','end_time','start_location','end_location','description','budget','is_deleted','is_published'];
	protected $dates=['start_time','end_time'];
    public function activities(){
    	return $this->hasMany(TripActivity::class)->orderBy('start');
    }
    public function users(){
        return $this->belongsToMany(User::class,'trip_users')->withPivot('status');
    }
    public function scopePublished(Builder $builder)
    {
        return $builder->where('is_published', 1);
    }
    public function scopeNotDeleted(Builder $builder)
    {
        return $builder->where('is_deleted', 0);
    }
}
