<?php

namespace App\Livewire\User\Library;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Document;

class Upload extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $branch;
    public $semester;
    public $subject;
    public $type = 'notes';
    public $file;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'branch' => 'required|string',
        'semester' => 'required|string',
        'subject' => 'nullable|string',
        'type' => 'required|in:notes,assignment,pyq',
        'file' => 'required|file|max:20480', 
    ];

    public function uploadLibrary()
    {
        
        // dd($this->file);
        $this->validate();

        $path = $this->file->store('documents', 'public');

        Document::create([
            'user_id'   => auth()->id(),
            'title'     => $this->title,
            'description' => $this->description,
            'branch'    => $this->branch,
            'semester'  => $this->semester,
            'subject'   => $this->subject,
            'type'      => $this->type,
            'file_path' => $path, 
        ]);

        $this->reset(['title', 'description', 'branch', 'semester', 'subject', 'type', 'file']);

        session()->flash('success', 'Document uploaded successfully!');
    }

    public function render()
    {
        return view('livewire.user.library.upload');
    }
}
