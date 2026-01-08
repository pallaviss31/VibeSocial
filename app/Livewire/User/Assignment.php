<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout("components.layout.user")]
class Assignment extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $course_name;
    public $due_date;
    public $isCreating = false;
    public $selectedAssignment = null;
    public $filter = 'all';
    public $submission_text;
    public $submission_file;

    protected $rules = [
        'title' => 'required|string|max:255',
        'course_name' => 'required|string|max:255',
        'due_date' => 'required|date',
        'description' => 'nullable|string',
    ];

    public function submitAssignment()
    {
        $this->validate([
            'submission_text' => 'nullable|string',
            'submission_file' => 'nullable|file|max:10240', // 10MB max
        ]);

        if (!$this->submission_text && !$this->submission_file) {
            $this->addError('submission', 'Please provide either text or a file.');
            return;
        }

        $filePath = null;
        if ($this->submission_file) {
            $filePath = $this->submission_file->store('assignments', 'public');
        }

        $this->selectedAssignment->update([
            'submission_text' => $this->submission_text,
            'submission_file' => $filePath,
            'status' => 'completed',
        ]);

        $this->reset(['submission_text', 'submission_file']);
    }

    public function showDetails($id)
    {
        $this->selectedAssignment = \App\Models\Assignment::find($id);
    }

    public function closeDetails()
    {
        $this->selectedAssignment = null;
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    public function create()
    {
        $this->validate();

        \App\Models\Assignment::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
            'description' => $this->description,
            'course_name' => $this->course_name,
            'due_date' => $this->due_date,
            'status' => 'pending',
        ]);

        $this->reset(['title', 'description', 'course_name', 'due_date', 'isCreating']);
    }

    public function toggleCreate()
    {
        $this->isCreating = !$this->isCreating;
    }

    public function render()
    {
        $query = \App\Models\Assignment::where('user_id', auth()->id());

        if ($this->filter === 'pending') {
            $query->where('status', 'pending');
        } elseif ($this->filter === 'completed') {
            $query->where('status', 'completed');
        } elseif ($this->filter === 'overdue') {
            $query->where('due_date', '<', now())->where('status', '!=', 'completed');
        }

        $assignments = $query->orderBy('due_date', 'asc')->get();

        return view('livewire.user.assignment', [
            'assignments' => $assignments
        ]);
    }
}