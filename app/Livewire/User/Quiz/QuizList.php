<?php

namespace App\Livewire\User\Quiz;

use App\Models\Quiz;
use App\Models\Course;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layout.user')]
class QuizList extends Component
{
     public string $search = '';
    public bool $myQuiz = false;            // All / My toggle
    public string $sortDirection = 'desc';  // Latest / Oldest
    public bool $showCreateModal = false;

    // Data
    public $courses = [];

    public function mount()
    {
        // Load static data only
        $this->courses = Course::orderBy('name')->get();
    }

    // 🔁 Toggle sorting
    public function toggleSort()
    {
        $this->sortDirection = $this->sortDirection === 'desc'
            ? 'asc'
            : 'desc';
    }

    public function render()
    {
        $userId = auth()->id();

        $query = Quiz::query();

         if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        
        if ($this->myQuiz) {
            // Only quizzes created by logged-in user
            $query->where('created_by', $userId);
        } else {
            // My quizzes + public approved quizzes
            $query->where(function ($q) use ($userId) {
                $q->where('created_by', $userId)
                  ->orWhere(function ($q2) {
                      $q2->where('is_published', true)
                         ->where('status', 'approved');
                  });
            });
        }

        
        $query->orderBy('created_at', $this->sortDirection);

        return view('livewire.user.quiz.quiz-list', [
            'quizzes' => $query->get(),
        ]);
    }
}
