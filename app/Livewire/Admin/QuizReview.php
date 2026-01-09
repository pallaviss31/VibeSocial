<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Quiz;
use App\Models\Question;
use Livewire\Attributes\Layout;

#[Layout("components.layout.admin")]

class QuizReview extends Component
{
    public Quiz $quiz;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz->load('questions');
    }

    public function deleteQuestion($id)
    {
        Question::findOrFail($id)->delete();
    }

    public function render()
    {
        return view('livewire.admin.quiz-review');
    }
}
