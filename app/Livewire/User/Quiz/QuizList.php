<?php

namespace App\Livewire\User\Quiz;
use Livewire\Component;
use App\Models\Quiz;

use Livewire\Attributes\Layout;

#[Layout('components.layout.user')]

class QuizList extends Component
{
    public $showCreateModal = false;
    public function render()
    {
        $userId = auth()->id();
        return view('livewire.user.quiz.quiz-list', [
            'quizzes' => Quiz::where(function ($query) use ($userId) {
                // Creator can see all their quizzes
                $query->where('created_by', $userId);
            })
            ->orWhere(function ($query) {
                // Other users see only live quizzes
                $query->where('is_published', true)
                      ->where('status', 'approved');
            })
            ->latest()
            ->get(),
        ]);
    }
}


