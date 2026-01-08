<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layout.app')]
class Login extends Component
{
    #[Validate('required|string|email|max:222')]
    Public $email;

    #[Validate('required|string|min:8|max:222')]
    Public $password;

    Public function login()
    {
        $data = $this->validate();
        if (Auth::attempt($data)) {
            return redirect()->route('dashboard');
        }

        $this->addError('email', 'The provided credentials do not match our records.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
