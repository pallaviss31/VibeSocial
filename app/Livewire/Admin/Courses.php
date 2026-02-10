<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Course;
use Livewire\Attributes\Layout;

#[Layout("components.layout.admin")]
class Courses extends Component
{
    public $name;
    public $semester;
    public $year;
    public $description;
    public $showForm = false;

    protected $rules = [
        'name' => 'required|min:3',
        'semester' => 'required',
        'year' => 'required',
        'description' => 'nullable|min:5',
    ];

    public function createCourse()
    {
        $this->validate();

        Course::create([
            'name' => $this->name,
            'semester' => $this->semester,
            'year' => $this->year,
            'description' => $this->description,
        ]);

        $this->reset(['name','semester','year','description','showForm']);

        session()->flash('success', 'Course added successfully!');
    }

    public function deleteCourse($id)
    {
        Course::find($id)?->delete();
        session()->flash('success', 'Course deleted.');
    }

    public function render()
    {
        return view('livewire.admin.courses', [
            'courses' => Course::latest()->get(),
            'totalCourses' => Course::count(),
            'totalEnrollments' => rand(1500, 3000),
            'activeRooms' => rand(5, 15)
        ]);
    }
}
