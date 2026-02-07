<div
    class="flex flex-col h-[75vh] bg-slate-50 rounded-[2rem] shadow-2xl shadow-slate-200/50 overflow-hidden border border-white">

    {{-- 1. CHAT HEADER --}}
    <div class="px-6 py-4 bg-white/80 backdrop-blur-md border-b border-slate-100 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse"></div>
            <h3 class="font-bold text-slate-800 tracking-tight">Study Group Feed</h3>
        </div>
        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ count($posts) }} Messages</span>
    </div>

    {{-- 2. MESSAGES AREA --}}
    <div class="flex-1 overflow-y-auto p-6 space-y-6 custom-scrollbar">
        @forelse($posts as $post)
            @php $isMine = auth()->id() === $post->user_id; @endphp

            <div
                class="flex {{ $isMine ? 'justify-end' : 'justify-start' }} animate-in fade-in slide-in-from-bottom-2 duration-300">
                <div class="max-w-[80%] flex flex-col {{ $isMine ? 'items-end' : 'items-start' }}">

                    @if (!$isMine)
                        <span class="text-[10px] font-bold text-slate-400 ml-2 mb-1 uppercase tracking-tighter">
                            {{ $post->user->fname }}
                        </span>
                    @endif

                    <div
                        class="relative group shadow-sm
                        {{ $isMine
                            ? 'bg-indigo-600 text-white rounded-[1.25rem] rounded-tr-none'
                            : 'bg-white text-slate-700 rounded-[1.25rem] rounded-tl-none border border-slate-100' }} 
                        px-4 py-3">

                        @if ($post->content)
                            <p class="text-sm leading-relaxed whitespace-pre-wrap font-medium">{{ $post->content }}</p>
                        @endif

                        {{-- DYNAMIC ATTACHMENT LOGIC --}}
                        @if ($post->image)
                            @php
                                $extension = pathinfo($post->image, PATHINFO_EXTENSION);
                                $isImg = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                            @endphp

                            @if ($isImg)
                                {{-- IMAGE DISPLAY --}}
                                <div
                                    class="mt-2 overflow-hidden rounded-xl border {{ $isMine ? 'border-indigo-400' : 'border-slate-100' }}">
                                    <img src="{{ asset('storage/' . $post->image) }}"
                                        class="max-h-72 w-full object-cover hover:scale-105 transition-transform duration-500">
                                </div>
                            @else
                                {{-- FILE DOWNLOAD CARD --}}
                                <a href="{{ asset('storage/' . $post->image) }}" target="_blank"
                                    class="mt-2 flex items-center gap-3 p-3 rounded-xl border transition-all
                                   {{ $isMine ? 'bg-indigo-700 border-indigo-500 text-white' : 'bg-slate-50 border-slate-200 text-slate-700' }}">
                                    <div class="p-2 bg-black/10 rounded-lg text-current">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-width="2"
                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div class="overflow-hidden">
                                        <p class="text-[11px] font-bold truncate w-32">{{ basename($post->image) }}</p>
                                        <p class="text-[9px] opacity-70 uppercase font-black">Download File</p>
                                    </div>
                                </a>
                            @endif
                        @endif

                        {{-- ACTIONS --}}
                        @if ($this->canEdit($post))
                            <div
                                class="absolute -top-8 {{ $isMine ? 'right-0' : 'left-0' }} flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity bg-white/90 backdrop-blur px-2 py-1 rounded-lg border border-slate-100 shadow-sm">
                                <button wire:click="startEdit({{ $post->id }})"
                                    class="text-[10px] font-bold text-indigo-600 hover:text-indigo-800 uppercase">Edit</button>
                                <button wire:click="deletePost({{ $post->id }})"
                                    class="text-[10px] font-bold text-rose-500 hover:text-rose-700 uppercase">Delete</button>
                            </div>
                        @endif
                    </div>

                    <span class="mt-1.5 text-[9px] font-bold text-slate-400 uppercase tracking-widest px-1">
                        {{ $post->created_at?->diffForHumans() ?? 'Just now' }}
                    </span>
                </div>
            </div>
        @empty
            <div class="h-full flex flex-col items-center justify-center text-slate-300">
                <p class="text-xs font-bold uppercase tracking-widest opacity-50">No messages yet</p>
            </div>
        @endforelse
    </div>

    {{-- 3. INPUT AREA --}}
    @if ($this->canPost())
        <div class="p-4 bg-white border-t border-slate-100">

            {{-- PREVIEW CARD --}}
            @if ($image)
                <div
                    class="relative inline-flex items-center gap-3 p-2 bg-slate-50 border border-slate-200 rounded-xl mb-3">
                    @php
                        $isPreviewImg = in_array($image->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif']);
                    @endphp
                    @if ($isPreviewImg)
                        <img src="{{ $image->temporaryUrl() }}"
                            class="h-12 w-12 rounded object-cover ring-2 ring-indigo-500">
                    @else
                        <div class="h-12 w-12 bg-indigo-100 text-indigo-600 flex items-center justify-center rounded">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2"
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                    <div class="pr-6">
                        <p class="text-[9px] font-bold text-slate-400 uppercase">Attachment</p>
                        <p class="text-xs font-bold text-slate-600 truncate w-32">{{ $image->getClientOriginalName() }}
                        </p>
                    </div>
                    <button wire:click="$set('image', null)"
                        class="absolute -top-2 -right-2 bg-rose-500 text-white rounded-full p-1 shadow-md hover:scale-110 transition-transform">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif

            {{-- INPUT BAR --}}
            <div class="p-4 bg-white border-t border-slate-100">

                {{-- 1. PREVIEW (ONLY SHOWS IF A FILE IS CHOSEN) --}}
                @if ($image)
                    <div
                        class="relative inline-flex items-center gap-3 p-2 bg-slate-50 border border-slate-200 rounded-xl mb-3">
                        @php
                            $isPreviewImg = in_array($image->getClientOriginalExtension(), [
                                'jpg',
                                'jpeg',
                                'png',
                                'gif',
                                'webp',
                            ]);
                        @endphp
                        @if ($isPreviewImg)
                            <img src="{{ $image->temporaryUrl() }}"
                                class="h-12 w-12 rounded object-cover ring-2 ring-indigo-500">
                        @else
                            <div
                                class="h-12 w-12 bg-indigo-100 text-indigo-600 flex items-center justify-center rounded">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-width="2"
                                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="pr-6">
                            <p class="text-[9px] font-bold text-slate-400 uppercase">Attachment</p>
                            <p class="text-xs font-bold text-slate-600 truncate w-32">
                                {{ $image->getClientOriginalName() }}</p>
                        </div>
                        <button type="button" wire:click="$set('image', null)"
                            class="absolute -top-2 -right-2 bg-rose-500 text-white rounded-full p-1 shadow-md hover:scale-110">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif

                {{-- 2. THE ACTUAL INPUT BAR --}}
                <form wire:submit.prevent="createPost">
                <div
                    class="flex items-center gap-2 bg-slate-100 rounded-2xl p-1.5 focus-within:ring-2 focus-within:ring-indigo-100 transition-all">

                    {{-- IMPORTANT: THE LABEL MUST WRAP THE INPUT --}}
                    <label class="cursor-pointer text-slate-400 hover:text-indigo-600 flex items-center justify-center">
                        📎
                        <input type="file" wire:model="image" class="hidden" accept="image/*">
                    </label>




                    <textarea wire:model="content" rows="1"
                        class="flex-1 bg-transparent border-none focus:ring-0 text-sm py-2 resize-none" placeholder="Message or file..."></textarea>

                    <button wire:click="createPost"
                        class="bg-indigo-600 text-white p-2.5 rounded-xl hover:bg-indigo-700 active:scale-95 transition-all">
                        <svg class="w-5 h-5 rotate-90" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
