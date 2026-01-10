<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Course;
use App\Models\QuizAttempt;
use Livewire\Attributes\Layout;

#[Layout("components.layout.admin")]

class AdminIndex extends Component
{
     public function mount()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403);
        }
    }
    public function render()
    {
        return view('livewire.admin.admin-index', [
            'totalUsers'    => User::count(),
            'totalQuizzes'  => Quiz::count(),

            // courses having at least one ongoing student
            'activeCourses' => Course::whereHas('users', function ($q) {
                $q->where('course_users.status', 'ongoing');
            })->count(),
        ]);
    }
}
