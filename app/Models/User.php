<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;
    
    protected $guarded = ['id'];
    protected $appends = ['createdAtHuman'];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function activeArticles()
    {
        return $this->articles()->published()->notDeleted()->latest();
    }
    public function profileImage()
    {
        return $this->belongsTo(Image::class,'profile_image_id');
    }

    public function coverImage()
    {
        return $this->belongsTo(Image::class,'cover_image_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function reader()
    {
        return $this->hasOne(Reader::class);
    }

    public function isReader()
    {
        return !is_null($this->reader);
    }

    public function scopeActive(Builder $builder)
    {
        return $builder->where('is_active', 1);
    }

    public function getCreatedAtHumanAttribute()
    {
        $carbonDate = new Carbon($this->created_at);
        return $carbonDate->diffForHumans();
    }

    public static function getSubscribedUsers()
    {
        $subscribedReadersIds = Reader::subscribed()
            ->verified()
            ->pluck('user_id');
        $users = self::whereIn('id', $subscribedReadersIds)->get();
        return $users;
    }
}
