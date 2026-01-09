<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\QuizAttempt;
use App\Models\Question;

class Quiz extends Model
{
    protected $fillable = [
        'title',
        'description',
        'total_questions',
        'passing_marks',
        'course',
        'semester',
        'subject',
        'created_by',
        'creator_role',
        'status',
        'is_published',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function attempts()
{
    return $this->hasMany(QuizAttempt::class);
}

 public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
