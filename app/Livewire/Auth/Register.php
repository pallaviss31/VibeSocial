<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Livewire\Attributes\Validate;

#[Layout('components.layout.app')]

class Register extends Component
{

    #[Validate("required|string|max:222")]
    Public $fname;

    #[Validate("required|string|max:222")]
    Public $lname;

    #[Validate("required|string|max:222")]
    Public $email;

    #[Validate("required|date")]
    Public $dob;

    #[Validate("required|string|in:male,female,other")]
    Public $gender;

    #[Validate("required|string|max:222")]
    Public $phone;

    #[Validate("required|string|min:8|max:222")]
    Public $password;

    Public function register(){
        $data = $this->validate();

        $newuser = User::create($data);

        $this->reset();

        Auth::attempt(["email"=>$data["email"],"password"=>$data["password"]]);
        redirect()->route("dashboard");

    }

    


    public function render()
    {
        return view('livewire.auth.register');
    }
}
