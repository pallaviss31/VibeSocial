<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Course;
use Livewire\Attributes\Layout;

#[Layout("components.layout.admin")]
class Courses extends Component
{
    public $title;
    public $description;
    public $showForm = false; // Added to handle the toggle

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'nullable|min:5',
    ];

    public function createCourse()
    {
        $this->validate();

        Course::create([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        $this->reset(['title', 'description', 'showForm']);
        session()->flash('success', 'New Curriculum Deployed!');
    }

    public function deleteCourse($id)
    {
        Course::find($id)->delete();
        session()->flash('success', 'Course removed successfully.');
    }

    public function render()
    {
        return view('livewire.admin.courses', [
            'courses' => Course::latest()->get(),
            'totalCourses' => Course::count(),
            // Sending fake data for the "Vibe Check" stats
            'totalEnrollments' => rand(1500, 3000), 
            'activeRooms' => rand(5, 15)
        ]);
    }
}