<?php

namespace App\Livewire\User\Quiz;

use App\Models\Quiz;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layout.user')]
class QuizList extends Component
{
    public $quizzes;
    public $myQuiz;
    public $courses =[];

   public function mount()
{
    $userId = auth()->id();

    // quizzes
    $this->quizzes = Quiz::where('created_by', $userId)
        ->orWhere(function ($q) {
            $q->where('is_published', 1)
              ->where('status', 'approved');
        })
        ->orderBy('created_at', 'desc')
        ->get();

    // my quizzes
    $this->myQuiz = Quiz::where('created_by', $userId)
        ->orderBy('created_at', 'desc')
        ->get();

    // ✅ THIS WAS MISSING
    $this->courses = Course::orderBy('name')->get();
}


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
                    $query
                        ->where('is_published', true)
                        ->where('status', 'approved');
                })
                ->latest()
                ->get(),
        ]);
    }
}
