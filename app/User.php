<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function likes(){
        return $this->belongsToMany('App\Image','likes');
    }

    public function followers() {
        return $this->belongsToMany('App\User', 'relations', 'followee_id', 'follower_id');
    }

    public function isFollower(User $user)
    {
        return $this->following()->wherePivot('followee_id', $user->id)->exists();
    }

    public function toggleFollower(User $user)
    {
        if ($this->isFollower($user)) {
            $this->following()->detach($user);
        } else {
            $this->following()->attach($user);
        }
    }

    public function hasLiked(Image $image){
        return $this->likes()->wherePivot('image_id',$image->id)->exists();
    }

    public function toggleLike(Image $image){
        if($this->hasLiked($image)){
            $this->likes()->detach($image);
        }
        else{
            $this->likes()->attach($image);
        }
    }

    public function following() {
        return $this->belongsToMany('App\User', 'relations', 'follower_id', 'followee_id');
    }
}

