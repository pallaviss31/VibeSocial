<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
     protected $fillable = [
        'study_group_id', 'user_id', 'role', 'status', 'joined_at'
    ];

    public function group() {
        return $this->belongsTo(StudyGroup::class);
    }

   public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
