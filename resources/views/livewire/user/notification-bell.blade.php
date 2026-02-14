<div x-data="{ open: @entangle('open').live }" @click.outside="open = false" class="relative">

    <button @click="open = !open"
        class="relative p-2.5 text-slate-500 hover:text-blue-600 hover:bg-blue-50 rounded-full transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-100">

        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
        </svg>

        @if ($count > 0)
            <span class="absolute top-2 right-2 flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500 border-2 border-white"></span>
            </span>
        @endif
    </button>

    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-1 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-1 scale-95"
        class="absolute right-0 mt-3 w-80 bg-white shadow-2xl rounded-2xl border border-slate-100 z-50 overflow-hidden"
        style="display: none;">

        <div class="flex justify-between items-center px-4 py-3 border-b border-slate-50 bg-slate-50/50">
            <h3 class="font-bold text-slate-800 text-sm tracking-tight">Notifications</h3>

            @if ($count > 0)
                <button wire:click="markAllRead"
                    class="text-xs font-semibold text-blue-600 hover:text-blue-700 transition-colors">
                    Mark all read
                </button>
            @endif
        </div>

        <div class="max-h-[400px] overflow-y-auto divide-y divide-slate-50">
            @forelse($notifications as $n)
                <a href="{{ $n->link }}" wire:click.prevent="markAsRead({{ $n->id }})"
                    class="group flex gap-3 p-4 transition-colors hover:bg-slate-50 
                   {{ $n->is_read ? 'opacity-75' : 'bg-blue-50/30' }}">

                    <div class="relative shrink-0">
                        <img src="{{ $n->fromUser->profile_photo ?? '/default.png' }}"
                            class="w-10 h-10 rounded-full object-cover ring-2 ring-white shadow-sm">
                        @if (!$n->is_read)
                            <div
                                class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-blue-500 border-2 border-white rounded-full">
                            </div>
                        @endif
                    </div>

                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-slate-700 leading-snug">
                            <span class="font-bold text-slate-900">{{ $n->sender->fname }}</span>
                            <span class="text-slate-600">
                                @if ($n->type == 'like')
                                    liked your post ❤️
                                @elseif($n->type == 'comment')
                                    commented on your post 💬
                                @elseif($n->type == 'friend_request')
                                    sent a friend request 🤝
                                @endif
                            </span>
                        </p>

                        <p class="text-[11px] font-medium text-slate-400 mt-1 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $n->created_at->diffForHumans() }}
                        </p>
                    </div>
                </a>

            @empty
                <div class="py-12 px-4 text-center">
                    <div class="bg-slate-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                            </path>
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-slate-500">All caught up!</p>
                    <p class="text-xs text-slate-400">No new notifications for you.</p>
                </div>
            @endforelse
        </div>

        <a href="/notifications"
            class="block py-3 text-center text-xs font-bold text-slate-500 bg-slate-50 hover:text-slate-700 border-t border-slate-100">
            View All Notifications
        </a>
    </div>
</div>
