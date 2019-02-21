<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $guarded = ['id'];
    protected $appends = ['createdAtHuman'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

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
    public function socials(){
        return $this->hasMany(Social::class);
    }
    public function reader()
    {
        return $this->hasOne(Reader::class);
    }
    public function socialMedia(){
        return $this->belongsToMany(Socialmedia::class,'socials')->withPivot('public_profile');
    }
    public function trips(){
        return $this->belongsToMany(Trip::class,'trip_users')->withPivot('status');
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

    /**
    * @param string|array $roles
    */
    public function authorizeRoles($roles)
    {
      if (is_array($roles)) {
          return $this->hasAnyRole($roles) || 
                 abort(401, 'This action is unauthorized.');
      }
      return $this->hasRole($roles) || 
             abort(401, 'This action is unauthorized.');
    }
    /**
    * Check multiple roles
    * @param array $roles
    */
    public function hasAnyRole($roles)
    {
      return null !== $this->roles()->whereIn('name', $roles)->first();
    }
    /**
    * Check one role
    * @param string $role
    */
    public function hasRole($role)
    {
      return null !== $this->roles()->where('name', $role)->first();
    }

}
