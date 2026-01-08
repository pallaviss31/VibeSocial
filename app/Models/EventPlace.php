<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class EventPlace extends Model
{
      use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'event_type',
        'date',
        'time',
        'venue',
        'meet_link',
        'image',
        'department',
        'year',
        'organizer_id',
        'max_participants'
    ];
    public function joinRequests()
{
    return $this->hasMany(EventUser::class, 'eventplace_id')
        ->where('status', 'pending')
        ->with('user');
}


    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }
     public function participants()
    {
        return $this->hasMany(EventUser::class, 'eventplace_id');
    }
}
