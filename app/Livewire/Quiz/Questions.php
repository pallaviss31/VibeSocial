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
      protected function rules()
    {
        return [
            'questions.*.question' => 'required|string|min:5',
            'questions.*.option_a' => 'required|string',
            'questions.*.option_b' => 'required|string',
            'questions.*.option_c' => 'required|string',
            'questions.*.option_d' => 'required|string',
            'questions.*.correct_option' => 'required|in:a,b,c,d',
        ];
    }


    public function save()
    {
        foreach ($this->questions as $q) {
            $this->quiz->questions()->create($q);
        }

        $user = auth()->user();
        $isAdmin = $user->role === 'admin';

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
