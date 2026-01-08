<?php

namespace App\Livewire\User\Quiz;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Quiz;
use App\Models\QuizAttempt;

#[Layout("components.layout.user")]
class QuizResult extends Component
{
    public $quizId;
    public $attemptId = null;

    public Quiz $quiz;
    public QuizAttempt $attempt;

    public $totalQuestions;
    public $correct;
    public $wrong;
    public $scorePercentage;
    public $isPassed;

    public function mount($quizId, $attemptId = null)
    {
        $this->quizId = $quizId;
        $this->attemptId = $attemptId;

        $this->quiz = Quiz::with('questions')->findOrFail($quizId);

        if ($attemptId) {
            // Admin / teacher view
            $this->attempt = QuizAttempt::with(['answers', 'user'])
                ->where('id', $attemptId)
                ->where('quiz_id', $quizId)
                ->firstOrFail();

            if (
                $this->attempt->user_id !== auth()->id() &&
                auth()->user()->role !== 'admin' &&
                $this->quiz->created_by !== auth()->id()
            ) {
                abort(403);
            }
        } else {
            // Student view
            $this->attempt = QuizAttempt::with(['answers', 'user'])
                ->where('quiz_id', $quizId)
                ->where('user_id', auth()->id())
                ->firstOrFail();
        }

        if ($this->attempt->status !== 'submitted') {
            abort(403, 'Quiz not submitted yet.');
        }

        // Calculations
        $this->totalQuestions = $this->quiz->questions->count();
        $this->correct = $this->attempt->score;
        $this->wrong = $this->totalQuestions - $this->correct;

        $this->scorePercentage = round(
            ($this->correct / max($this->totalQuestions, 1)) * 100
        );

        $this->isPassed = $this->scorePercentage >= 40;
    }

    public function render()
    {
        return view('livewire.user.quiz.quiz-result');
    }
}
