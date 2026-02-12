<div class="relative">

    <button wire:click="loadNotifications"
        class="relative p-2 text-slate-500 hover:bg-slate-100 rounded-full">

        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
    </svg>

        @if($count > 0)
            <span class="absolute top-1 right-1 w-3 h-3 bg-red-500 rounded-full"></span>
        @endif
    </button>

    <div class="absolute right-0 mt-2 w-80 bg-white shadow rounded">
        @foreach($notifications as $n)
            <div wire:click="markAsRead({{ $n->id }})"
                 class="p-3 border-b cursor-pointer hover:bg-gray-50">

                {{ $n->message }}
            </div>
        @endforeach
    </div>

</div>
