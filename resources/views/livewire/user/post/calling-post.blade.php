<div>
    @foreach ($posts as $post)
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 mb-4 hover:shadow-md transition duration-300" x-data="{open: false}">
        <!-- Header -->
        <div class="flex justify-between items-start mb-4">
            <div class="flex gap-3">
                <a href="{{ route('profile', $post->user->id) }}" class="w-10 h-10 rounded-full bg-indigo-100 border border-indigo-50 overflow-hidden">
                    <img src="@if ($post->user->dp) {{ asset('storage/images/dp/' . $post->user->dp) }} @else {{ asset('storage/dp.jpg') }} @endif" class="w-full h-full object-cover">
                </a>
                <div>
                    <a href="{{ route('profile', $post->user->id) }}" class="font-bold text-slate-900 hover:text-indigo-600 transition">{{ $post->user->fname }} {{ $post->user->lname }}</a>
                    <div class="flex items-center gap-2 text-xs text-slate-500 mt-0.5">
                        <span>{{ $post->created_at->diffForHumans() }}</span>
                        <span>•</span>
                        <span class="bg-slate-100 px-2 py-0.5 rounded-full text-slate-600 font-medium">General</span>
                    </div>
                </div>
            </div>
            <button class="text-slate-400 hover:text-slate-600 p-1 rounded-full hover:bg-slate-100 transition">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" /></svg>
            </button>
        </div>

        <!-- Content -->
        <div class="mb-4">
            <p class="text-slate-800 leading-relaxed whitespace-pre-wrap">{{ $post->content }}</p>
        </div>

        @if ($post->image)
        <div class="mb-4 rounded-xl overflow-hidden border border-slate-100">
            <img src="{{ asset('storage/' . $post->image) }}" class="w-full object-cover max-h-[250px]">
        </div>
        @endif

        <!-- Stats -->
        <div class="flex items-center justify-between text-sm text-slate-500 mb-4 pb-4 border-b border-slate-100">
            <div class="flex items-center gap-1">
                <div class="flex -space-x-1">
                    <div class="w-5 h-5 rounded-full bg-indigo-500 flex items-center justify-center border border-white">
                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" /></svg>
                    </div>
                </div>
                <span class="ml-1 font-medium">{{ $post->likes->count() }} Likes</span>
            </div>
            <div class="flex gap-4">
                <span class="hover:underline cursor-pointer" @click="open = !open">{{ $post->comments->count() }} Comments</span>
                <span class="hover:underline cursor-pointer">3 Shares</span>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between gap-2">
            <button wire:click="like({{ $post->id }})" class="flex-1 flex items-center justify-center gap-2 py-2 rounded-lg hover:bg-slate-50 transition {{ $post->likes->contains('user_id', auth()->id()) ? 'text-indigo-600 font-semibold' : 'text-slate-600 font-medium' }}">
                <svg class="w-5 h-5" fill="{{ $post->likes->contains('user_id', auth()->id()) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" /></svg>
                <span>Like</span>
            </button>
            <button class="flex-1 flex items-center justify-center gap-2 py-2 rounded-lg hover:bg-slate-50 text-slate-600 font-medium transition" @click="open = !open">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" /></svg>
                <span>Comment</span>
            </button>
            <button class="flex-1 flex items-center justify-center gap-2 py-2 rounded-lg hover:bg-slate-50 text-slate-600 font-medium transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" /></svg>
                <span>Share</span>
            </button>
        </div>

        <!-- Comment Section -->
        <div x-show="open" class="pt-4 border-t border-slate-100 mt-4" style="display: none;">
            <form wire:submit.prevent="addComment({{ $post->id }})" class="flex items-center gap-3 mb-4">
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=random" class="w-8 h-8 rounded-full">
                <div class="flex-1 relative">
                    <input type="text" wire:model="content" placeholder="Write a comment..." class="w-full bg-slate-50 border-none rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition placeholder-slate-400 text-sm">
                    <button type="submit" class="absolute right-2 top-1.5 text-indigo-600 hover:text-indigo-700 p-1">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                    </button>
                </div>
            </form>

            <div class="space-y-4">
                @foreach($post->comments as $comment)
                    <div class="flex gap-3">
                        <a href="{{ route('profile', $comment->user->id) }}" class="w-8 h-8 rounded-full bg-indigo-50 border border-indigo-100 overflow-hidden flex-shrink-0">
                            <img src="@if ($comment->user->dp) {{ asset('storage/images/dp/' . $comment->user->dp) }} @else {{ asset('images/dp.png') }} @endif" class="w-full h-full object-cover">
                        </a>
                        <div class="flex-1">
                            <div class="bg-slate-50 rounded-2xl rounded-tl-none px-4 py-2 inline-block">
                                <a href="{{ route('profile', $comment->user->id) }}" class="font-bold text-sm text-slate-900 hover:text-indigo-600">{{ $comment->user->fname }} {{ $comment->user->lname }}</a>
                                <p class="text-sm text-slate-700">{{ $comment->comment }}</p>
                            </div>
                            <div class="flex items-center gap-3 mt-1 ml-1 text-xs text-slate-500 font-medium">
                                <span>{{ $comment->created_at->diffForHumans() }}</span>
                                <button class="hover:text-indigo-600">Like</button>
                                <button class="hover:text-indigo-600">Reply</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
</div>