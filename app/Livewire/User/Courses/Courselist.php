<?php

namespace App\Livewire\User\Courses;

use Livewire\Component;
use App\Models\Course;
use Livewire\Attributes\Layout;

#[Layout('components.layout.user')]

class Courselist extends Component
{
    public function enroll($courseId)
    {
        auth()->user()->courses()->syncWithoutDetaching([
            $courseId => ['status' => 'ongoing']
        ]);

        session()->flash('success', 'Course enrolled successfully');
    }
    public function render()
    {
        return view('livewire.user.courses.courselist', [
            'courses' => Course::all()
        ]);
    }
}
