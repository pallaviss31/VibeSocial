<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Quiz;
use Livewire\Attributes\Layout;

#[Layout("components.layout.admin")]


class QuizIndex extends Component
{
    public $showCreateModal = false;
    public function approve($quizId)
    {
        Quiz::where('id', $quizId)->update([
            'status' => 'approved',
            'is_published' => true,
        ]);
    }

    public function reject($quizId)
    {
        Quiz::where('id', $quizId)->update([
            'status' => 'rejected',
            'is_published' => false,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.quiz-index', [
            'quizzes' => Quiz::latest()->get(),
        ]);
    }
}
