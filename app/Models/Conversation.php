<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


    namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'user_one_id',
        'user_two_id'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function userOne()
    {
        return $this->belongsTo(User::class, 'user_one_id');
    }

    public function userTwo()
    {
        return $this->belongsTo(User::class, 'user_two_id');
    }

    // Get the other person (not the logged-in user)
    public function otherUser()
    {
        return auth()->id() == $this->user_one_id
            ? $this->userTwo
            : $this->userOne;
    }
}




