<?php

namespace App\Livewire\User\Courses;

use Livewire\Component;
use App\Models\Course;
use Livewire\Attributes\Layout;

#[Layout('components.layout.user')]

class CourseIndex extends Component
{
     public function enroll($courseId)
    {
        auth()->user()->courses()->syncWithoutDetaching([
            $courseId => ['status' => 'ongoing']
        ]);
    }
    public function render()
    {
       
        $user = auth()->user();

        $myCourses = $user->courses()->with([
            'quizzes.attempts' => function ($q) use ($user) {
                $q->where('user_id', $user->id);
            }
        ])->get();

        $allCourses = Course::all();

        /* ---------- DASHBOARD STATS ---------- */

        // Total quizzes attempted
        $totalAttempts = $myCourses
            ->flatMap->quizzes
            ->flatMap->attempts;

        // Average quiz score (%)
        $averageScore = $totalAttempts->count() > 0
            ? round(
                ($totalAttempts->sum('score') /
                $totalAttempts->sum(fn ($a) => max($a->quiz->total_questions, 1))) * 100,
                2
            )
            : 0;

        // Completed quizzes
        $completedQuizzes = $totalAttempts->count();
        $totalQuizzes = $myCourses->flatMap->quizzes->count();

        return view('livewire.user.courses.course-index', compact(
            'myCourses',
            'allCourses',
            'averageScore',
            'completedQuizzes',
            'totalQuizzes'
        ));
    }
}
