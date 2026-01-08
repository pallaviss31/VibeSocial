<div class="relative h-[200px] mb-6 flex gap-2 overflow-x-auto no-scrollbar">
    <!-- Add Story Card -->
    <div class="w-[112px] flex-shrink-0 h-full bg-white rounded-xl shadow overflow-hidden relative cursor-pointer group">
        @if (auth()->user()->dp)
            <img src="{{ asset('storage/images/dp/' . auth()->user()->dp) }}" alt="Profile"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        @else
            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'User' }}&background=random"
                alt="Profile" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        @endif
        <div class="absolute bottom-0 w-full bg-white h-12 flex justify-center items-center">
            <form wire:submit.prevent="createStory">
                <input type="file" wire:model="media_path" id="story_media" class="hidden">
                <label for="story_media"
                    class="w-8 h-8 bg-blue-500 rounded-full border-4 border-white flex items-center justify-center -mt-8 text-white font-bold text-xl cursor-pointer">
                    +
                </label>
                @error('media_path') <span class="text-red-500 text-sm">{{ $message }}</span>
                    
                @enderror
                <input type="hidden" value="Create Story" class="hidden">
            </form>
        </div>
        <div class="absolute bottom-2 w-full text-center text-xs font-semibold text-black">Create story</div>
    </div>

    {{-- calling stories --}}
    @foreach ($stories as $story)
        <!-- Story 1 -->
        <div class="w-[112px] flex-shrink-0 h-full bg-gray-200 rounded-xl overflow-hidden relative cursor-pointer">
            <img src="{{ asset('storage/' . $story->media_path) }}"
                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
            <div class="absolute top-2 left-2 w-8 h-8 rounded-full border-4 border-blue-50 overflow-hidden">
                @if ($story->user->dp)
                    <img src="{{ asset('storage/images/dp/' . $story->user->dp) }}" class="w-full h-full object-cover">
                    
                @else
                    <img src="https://ui-avatars.com/api/?name={{ $story->user->name ?? 'User' }}&background=random"
                        class="w-full h-full object-cover">
                @endif
            </div>
            <div class="absolute bottom-2 left-2  text-white font-semibold text-xs shadow-black drop-shadow-md">
                {{ $story->user->fname }} {{ $story->user->lname }}
            </div>
        </div>
    @endforeach

</div>