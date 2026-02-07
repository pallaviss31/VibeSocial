<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Layout;

#[Layout("components.layout.admin")]


class Users extends Component
{
    public function render()
    {
        return view('livewire.admin.users', [
            'users' => User::latest()->get(),
        ]);
    }
}
