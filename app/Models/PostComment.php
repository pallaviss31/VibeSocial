<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
   protected $fillable = ['user_id', 'comment',"post_id"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
