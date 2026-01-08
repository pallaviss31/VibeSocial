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
        return view('livewire.user.courses.course-index', [
            'myCourses' => $user->courses,
            'allCourses' => Course::all(),
        ]);
    }
}
