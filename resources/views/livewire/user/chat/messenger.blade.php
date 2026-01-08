<div class="flex h-screen bg-gray-100">

    <!-- Conversation List -->
    <div class="w-1/3 border-r bg-white overflow-y-auto">
        <div class="p-4 text-xl font-bold border-b">Messages</div>

        @foreach ($conversations as $convo)
            @php
                $otherUser = $convo->user_one_id == auth()->id() ? $convo->userTwo : $convo->userOne;

                $lastMessage = $convo->messages->last();
            @endphp

            <div wire:click="selectConversation({{ $convo->id }})"
                class="flex items-center gap-3 p-4 border-b hover:bg-gray-100 cursor-pointer {{ $selectedConversation && $selectedConversation->id == $convo->id ? 'bg-gray-100' : '' }}">

                <img src="@if ($otherUser->dp) {{ asset('storage/images/dp/' . $otherUser->dp) }} @else {{ asset('storage/dp.jpg') }} @endif"
                    class="w-10 h-10 rounded-full object-cover">




                <div class="flex-1">
                    <p class="font-semibold">{{ $otherUser->fname }}</p>
                    <p class="text-sm text-gray-500 truncate">
                        {{ $lastMessage ? $lastMessage->body : 'No messages yet' }}
                    </p>
                </div>

                @php
                    $unread = $convo->messages
                        ->where('sender_id', '!=', auth()->id())
                        ->where('is_read', false)
                        ->count();
                @endphp

                @if ($unread > 0)
                    <span class="bg-blue-500 text-white text-xs px-2 py-1 rounded-full">
                        {{ $unread }}
                    </span>
                @endif
            </div>
        @endforeach
    </div>

    <!-- Chat Box -->
    <div class="flex-1 flex flex-col">

        @if ($selectedConversation)
            <!-- Header -->
            @php
                $chatUser =
                    $selectedConversation->user_one_id == auth()->id()
                        ? $selectedConversation->userTwo
                        : $selectedConversation->userOne;
            @endphp

            <div class="p-4 border-b bg-white flex items-center gap-3">
                <img src="@if ($otherUser->dp) {{ asset('storage/images/dp/' . $otherUser->dp) }} @else {{ asset('storage/dp.jpg') }} @endif"
                    class="w-10 h-10 rounded-full object-cover">

                <div>
                    <p class="font-semibold">{{ $chatUser->fname }}</p>
                    <p class="text-sm text-gray-500 truncate">
                        {{ $otherUserTyping ? 'Typing...' : 'Online' }}
                    </p>
                </div>
            </div>

            <!-- Messages -->
            <div id="chatScroll" class="flex-1 p-4 overflow-y-auto space-y-3">
                @foreach ($messages as $msg)
                    <div class="flex {{ $msg->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                        <div
                            class="max-w-xs p-3 rounded-xl text-white 
                            {{ $msg->sender_id == auth()->id() ? 'bg-blue-600 rounded-br-none' : 'bg-gray-600 rounded-bl-none' }}">

                            {{ $msg->body }}

                            <div class="text-xs text-gray-300 mt-1">
                                {{ $msg->created_at->format('h:i A') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Input Box -->
            <div class="p-4 bg-white border-t flex gap-3">
                <input type="text" wire:model.debounce.300ms="body"
                    class="flex-1 border rounded-full px-4 py-2 focus:outline-none focus:ring"
                    placeholder="Message..." />

                <button wire:click="sendMessage"
                    class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700">
                    Send
                </button>
            </div>
        @else
            <!-- No chat selected -->
            <div class="flex items-center justify-center h-full text-gray-500 text-lg">
                Select a conversation to start chatting
            </div>

        @endif
    </div>
</div>

<script>
    window.addEventListener('scroll-down', () => {
        let el = document.getElementById('chatScroll');
        if (el) {
            el.scrollTop = el.scrollHeight;
        }
    });
</script>
