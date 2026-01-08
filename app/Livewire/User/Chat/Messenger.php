<?php

namespace App\Livewire\User\Chat;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layout.user')]
class Messenger extends Component
{
    public $conversations = [];
    public $selectedConversation;
    public $messages = [];
    public $body = '';
    public $conversationId = null;
    public $typing = false;
    public $otherUserTyping = false;

    protected $listeners = [
        'typing' => 'showTypingIndicator',
        'hide-typing' => 'hideTypingIndicator',
    ];

    public function mount($conversationId = null)
    {
        $this->loadConversations();

        if (request()->has('user')) {
            $otherUserId = request()->get('user');
            $this->conversationId = $this->getOrCreateConversation($otherUserId);
        }

        if ($conversationId) {
            $this->conversationId = $conversationId;
        }

        if ($this->conversationId) {
            $this->selectConversation($this->conversationId);
        }
    }

    public function getOrCreateConversation($otherUserId)
    {
        $userId = auth()->id();

        $convo = Conversation::where(function ($q) use ($userId, $otherUserId) {
            $q
                ->where('user_one_id', $userId)
                ->where('user_two_id', $otherUserId);
        })
            ->orWhere(function ($q) use ($userId, $otherUserId) {
                $q
                    ->where('user_one_id', $otherUserId)
                    ->where('user_two_id', $userId);
            })
            ->first();

        if ($convo) {
            return $convo->id;
        }

        return Conversation::create([
            'user_one_id' => $userId,
            'user_two_id' => $otherUserId,
        ])->id;
    }

    public function loadConversations()
    {
        $this->conversations = Conversation::with('userOne', 'userTwo', 'messages')
            ->where('user_one_id', auth()->id())
            ->orWhere('user_two_id', auth()->id())
            ->latest()
            ->get();
    }

    public function selectConversation($id)
    {
        $this->conversationId = $id;

        $this->selectedConversation = Conversation::with('userOne', 'userTwo')
            ->findOrFail($id);

        $this->messages = Message::where('conversation_id', $id)
            ->orderBy('created_at')
            ->get();

        Message::where('conversation_id', $id)
            ->where('sender_id', '!=', auth()->id())
            ->update(['is_read' => true]);

        $this->dispatch('scroll-down');
    }

    public function sendMessage()
    {
        if (!$this->selectedConversation || trim($this->body) === '')
            return;

        Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'sender_id' => auth()->id(),
            'body' => $this->body,
        ]);

        $this->body = '';

        $this->refreshMessages();
        $this->loadConversations();

        $this->dispatch('scroll-down');
    }

    public function refreshMessages()
    {
        if ($this->selectedConversation) {
            $this->messages = Message::where('conversation_id', $this->selectedConversation->id)
                ->orderBy('created_at')
                ->get();
        }
    }

    public function updatedBody()
    {
        if ($this->selectedConversation) {
            $this->dispatch('typing', $this->selectedConversation->id);
        }
    }

    public function showTypingIndicator()
    {
        $this->otherUserTyping = true;
    }

    public function hideTypingIndicator()
    {
        $this->otherUserTyping = false;
    }

    public function render()
    {
        return view('livewire.user.chat.messenger');
    }
}
