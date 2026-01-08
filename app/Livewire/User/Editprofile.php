<?php

namespace App\Livewire\User;

use Livewire\Component;

class Editprofile extends Component
{
    public $subject, $location, $graduation_year, $bio;

    public function mount()
    {
        $user = auth()->user();

        $this->subject = $user->subject;
        $this->location = $user->location;
        $this->graduation_year = $user->graduation_year;
        $this->bio = $user->bio;
    }
     public function save()
    {
        auth()->user()->update([
            'subject' => $this->subject,
            'location' => $this->location,
            'graduation_year' => $this->graduation_year,
            'bio' => $this->bio,
        ]);

        session()->flash('success', 'Profile updated successfully!');
    }
    public function render()
    {
        return view('livewire.user.editprofile');
    }
}



