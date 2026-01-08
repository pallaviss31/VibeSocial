<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-4">
    <div class="flex gap-3 mb-4">
        <div class="w-10 h-10 rounded-full bg-indigo-100 border border-indigo-50 flex-shrink-0 overflow-hidden">
            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=random" class="w-full h-full object-cover">
        </div>
        <div class="flex-1">
            <form wire:submit.prevent="createPost">
                <input type="text" wire:model="content" class="w-full bg-slate-50 border-none rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition placeholder-slate-500 text-slate-700" placeholder="Share updates, ask questions, or discuss topics...">
                @error('content') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                
                @if ($image)
                <div class="mt-3 relative rounded-xl overflow-hidden border border-slate-200 group">
                    <img src="{{ $image->temporaryUrl() }}" class="w-full max-h-64 object-cover">
                    <button type="button" wire:click="$set('image', null)" class="absolute top-2 right-2 bg-black/50 hover:bg-black/70 text-white p-1.5 rounded-full backdrop-blur-sm transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                @endif

                <div class="flex items-center justify-between mt-4 pt-3 border-t border-slate-100">
                    <div class="flex gap-2">
                        <label for="post-image" class="flex items-center gap-2 px-3 py-1.5 rounded-lg hover:bg-indigo-50 text-indigo-600 cursor-pointer transition">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            <span class="text-sm font-medium">Photo</span>
                            <input type="file" id="post-image" wire:model="image" class="hidden">
                        </label>
                        <button type="button" class="flex items-center gap-2 px-3 py-1.5 rounded-lg hover:bg-orange-50 text-orange-600 transition">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            <span class="text-sm font-medium">Video</span>
                        </button>
                        <button type="button" class="flex items-center gap-2 px-3 py-1.5 rounded-lg hover:bg-green-50 text-green-600 transition">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            <span class="text-sm font-medium">File</span>
                        </button>
                    </div>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-1.5 rounded-lg font-semibold text-sm shadow-md shadow-indigo-200 transition">
                        Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>