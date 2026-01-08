<?php

namespace App\Livewire\User\Courses;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layout.user')]

class Mycourses extends Component
{
    public function render()
    {
        return view('livewire.user.courses.mycourses', [
            'myCourses' => auth()->user()->courses
        ]);
    }
}
