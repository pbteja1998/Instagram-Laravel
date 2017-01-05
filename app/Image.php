<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 * @package App
 * @property string $original_name
 */
class Image extends Model
{
    protected $fillable = [
        'mime','name','original_name','no_of_likes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->belongsToMany('App\User','likes');
    }
}
