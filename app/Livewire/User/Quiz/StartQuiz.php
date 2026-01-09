<?php

namespace App\Livewire\User\Quiz;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizAnswer;


#[Layout('components.layout.user')]
class StartQuiz extends Component
{
    public Quiz $quiz;
    public QuizAttempt $attempt;
    public $questions;
    public $answers = [];

   public function mount(Quiz $quiz)
{
    $this->quiz = $quiz;

    $this->attempt = QuizAttempt::firstOrCreate(
        [
            'quiz_id' => $quiz->id,
            'user_id' => auth()->id(),
        ],
        [
            'started_at' => now(),
            'status' => 'in_progress',
        ]
    );

    // If already submitted → redirect to result
    if ($this->attempt->status === 'submitted') {
        return redirect()->route('quiz.result', [
            'quizId' => $quiz->id,
            'attemptId' => $this->attempt->id,
        ]);
    }

    // Load questions
    $this->questions = $quiz->questions;

    // Load saved answers
    $this->answers = QuizAnswer::where('quiz_attempt_id', $this->attempt->id)
        ->pluck('selected_option', 'question_id')
        ->toArray();
}


    public function selectOption($questionId, $option)
    {
        if ($this->attempt->status !== 'in_progress') return;

        $this->answers[$questionId] = $option;

        QuizAnswer::updateOrCreate(
            [
                'quiz_attempt_id' => $this->attempt->id,
                'question_id' => $questionId,
            ],
            [
                'selected_option' => $option,
                'is_correct' => $this->isCorrect($questionId, $option),
            ]
        );
    }

    private function isCorrect($questionId, $option)
{
    $question = $this->questions->firstWhere('id', $questionId);

    return $question &&
        strtolower($question->correct_option) === strtolower($option);
}


    public function submitQuiz()
    {
        if ($this->attempt->status === 'submitted') return;

        // 6️⃣ Calculate score
        $score = QuizAnswer::where('quiz_attempt_id', $this->attempt->id)
            ->where('is_correct', true)
            ->count();

        // 7️⃣ Update attempt
        $this->attempt->update([
            'score' => $score,
            'status' => 'submitted',
            'submitted_at' => now(),
        ]);

        // 8️⃣ Redirect to result
        return $this->redirect(
            route('quiz.result', ['quizId' => $this->quiz->id]),
            navigate: true
        );
    }

    public function render()
    {
         $quizzes = Quiz::with([
        'attempts' => function ($q) {
            $q->where('user_id', auth()->id());
        }
    ])->get();
        return view('livewire.user.quiz.start-quiz', [
        'quizzes' => $quizzes
    ]);
    }
}
