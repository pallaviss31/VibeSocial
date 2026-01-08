<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
   protected $fillable = [
        'user_id',
        'title',
        'description',
        'course_name',
        'due_date',
        'status',
        'submission_text',
        'submission_file',
        'grade',
    ];

    protected $casts = [
        'due_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
