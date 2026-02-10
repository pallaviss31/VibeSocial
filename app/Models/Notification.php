<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
     protected $fillable = [
        'user_id',
        'from_user_id',
        'type',
        'message',
        'link',
        'is_read'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class,'from_user_id');
    }
}
