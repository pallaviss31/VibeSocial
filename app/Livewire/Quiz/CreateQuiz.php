<?php

namespace App\Livewire\Quiz;

use App\Models\Quiz;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layout.user')]
class CreateQuiz extends Component
{
    public $title;
    public $description;
    public $total_questions;
    public $passing_marks;
    public $course;
    public $semester;
    public $subject;
    public $time_limit = 15;


    protected $rules = [
        'title' => 'required|string|max:255',
        'total_questions' => 'required|integer|min:1',
        'passing_marks' => 'required|integer|min:1',
        'time_limit' => 'required|integer|min:1',
    ];

    public function save()
    {
        $this->validate();

        $user = auth()->user();
        $isAdmin = $user->role === 'admin';

        $quiz = Quiz::create([
            'title' => $this->title,
            'description' => $this->description,
            'total_questions' => $this->total_questions,
            'passing_marks' => $this->passing_marks,
            'course' => $this->course,
            'semester' => $this->semester,
            'subject' => $this->subject,
            'time_limit' => $this->time_limit,
            // 🔑 important part
            'created_by' => $user->id,
            'creator_role' => $user->role,
            'status' => 'draft',
            'is_published' => false,
        ]);
        // Redirect based on role
        return redirect()->to(
            $isAdmin
                ? route('quiz.manage', ['quiz' => $quiz->id])
                : route('quiz.manage', ['quiz' => $quiz->id])
        );
    }

    public function render()
    {
        return view('livewire.quiz.create-quiz');
    }
}
