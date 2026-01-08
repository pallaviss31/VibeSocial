<?php

namespace App\Livewire\User\Chat;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layout.user')]

class ConversationBox extends Component
{
    public function render()
    {
        return view('livewire.user.chat.conversation-box');
    }
}
