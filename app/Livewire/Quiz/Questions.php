<?php

namespace App\Livewire\Quiz;

use App\Models\Quiz;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layout.user')]
class Questions extends Component
{
    public $quiz;
    public $questions = [];

    public function mount($quiz)
    {
        $this->quiz = Quiz::findOrFail($quiz);

        // generate fixed number of questions
        for ($i = 0; $i < $this->quiz->total_questions; $i++) {
            $this->questions[] = [
                'question' => '',
                'option_a' => '',
                'option_b' => '',
                'option_c' => '',
                'option_d' => '',
                'correct_option' => '',
            ];
        }
    }

    public function save()
    {
        foreach ($this->questions as $q) {
            $this->quiz->questions()->create($q);
        }

        $user = auth()->user();
        $isAdmin = $user->role === 'admin';

        // 🔑 UPDATE QUIZ STATE HERE
        $this->quiz->update([
            'status' => $isAdmin ? 'approved' : 'pending',
            'is_published' => $isAdmin ? true : false,
        ]);

        session()->flash('success', 'Quiz completed successfully!');

        return redirect()->to(
            $isAdmin ? route('admin.quizzes') : route('quiz')
        );
    }

    public function render()
    {
        return view('livewire.quiz.questions');
    }
}
