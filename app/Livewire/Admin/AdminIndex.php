<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout("components.layout.admin")]

class AdminIndex extends Component
{
     public function mount()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403);
        }
    }
    public function render()
    {
        return view('livewire.admin.admin-index');
    }
}
