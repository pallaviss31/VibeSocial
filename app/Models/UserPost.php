<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPost extends Model
{
     protected $guarded =[];


     public function user()
    {
        return $this->hasOne(User::class,"id","user_id");
    }

    public function likes()
    {
        return $this->hasMany(PostLike::class, 'post_id');
    }
    public function comments()
    {
        return $this->hasMany(PostComment::class, 'post_id');
    }
}
