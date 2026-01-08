<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'eventplace_id',
        'user_id',
        'participation_type'
    ];

    public function event()
    {
        return $this->belongsTo(EventPlace::class, 'eventplace_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
