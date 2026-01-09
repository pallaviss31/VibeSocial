<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'semester', 'year', 'description'];

    public function users()
    {
        return $this
            ->belongsToMany(User::class, 'course_users')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
