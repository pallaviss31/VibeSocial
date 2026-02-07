<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyGroup extends Model
{
     protected $fillable = [
        'name','slug','description','subject','visibility','created_by','cover_image','settings'
    ];
 public function posts()
    {
        return $this->hasMany(GroupPost::class, 'study_group_id');
    }
    public function members()
    {
        return $this->hasMany(GroupMember::class, 'study_group_id')->where('status', 'joined');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'group_members')
            ->withPivot('role','status')
            ->withTimestamps();
    }
}
