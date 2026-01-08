<?php

namespace App\Livewire\User\Library;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Document;

class View extends Component
{
    public $document;
    public $open = false;

    // Listen for event from index page
    #[On('open-document')]
    public function openModal($payload)
    {
        $id = $payload['id'];  // retrieve document ID

        $this->document = Document::find($id);

        // Increase views
        if ($this->document) {
            $this->document->increment('views');
        }

        $this->open = true;
    }

    public function render()
    {
        return view('livewire.user.library.view');
    }
}
