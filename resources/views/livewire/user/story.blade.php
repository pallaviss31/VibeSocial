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
                @error('media_path')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <input type="hidden" value="Create Story" class="hidden">
            </form>
        </div>
        <div class="absolute bottom-2 w-full text-center text-xs font-semibold text-black">Create story</div>
    </div>

    {{-- calling stories --}}
    @php
        $groupedStories = $stories->groupBy('user_id');
    @endphp

    @foreach ($groupedStories as $userStories)
        @php
            $story = $userStories->first();
            $user = $story->user;
        @endphp

        <div wire:click="openStory({{ $user->id }})"
            class="w-[112px] h-full bg-gray-200 rounded-xl overflow-hidden relative cursor-pointer">


            <img src="{{ asset('storage/' . $story->media_path) }}" class="w-full h-full object-cover">

            <div class="absolute bottom-2 left-2 text-white text-xs font-bold">
                {{ $user->fname }}
            </div>

        </div>
    @endforeach
 @if ($viewerOpen)

<div
x-data="storyViewer(@entangle('currentIndex'), @entangle('viewerOpen'))"
x-init="init()"
x-cloak
class="fixed inset-0 bg-black flex items-center justify-center z-[999]">

    <div class="relative w-[420px] h-[750px] bg-black rounded-xl overflow-hidden">

        <!-- PROGRESS -->
        <div class="absolute top-3 left-3 right-3 flex gap-1 z-50">
            @foreach ($currentStories as $index => $s)
                <div class="flex-1 h-1 bg-gray-600">
                    <div class="h-full bg-white" :style="barWidth({{ $index }})"></div>
                </div>
            @endforeach
        </div>

        @php $story = $currentStories[$currentIndex] ?? null; @endphp

        @if ($story)
            @if (Str::endsWith($story['media_path'], ['.mp4','mov']))
                <video
                    x-ref="video"
                    autoplay
                    class="w-full h-full object-cover"
                    @loadedmetadata="setVideoDuration()"
                    @ended="next()">
                    <source src="{{ asset('storage/'.$story['media_path']) }}">
                </video>
            @else
                <img src="{{ asset('storage/'.$story['media_path']) }}"
                     class="w-full h-full object-cover">
            @endif
        @endif

        <button @click="close()" class="absolute top-4 right-4 text-white text-2xl">✕</button>

        <div @click="prev()" class="absolute left-0 top-0 w-1/2 h-full"></div>
        <div @click="next()" class="absolute right-0 top-0 w-1/2 h-full"></div>

    </div>
</div>

@endif

</div>
<script>
function storyViewer(currentIndex, viewerOpen) {
    return {
        progress: 0,
        timer: null,
        currentIndex,
        viewerOpen,
        duration: 5000,

        init() {
            this.start()

            this.$watch(() => this.currentIndex, () => {
                this.start()
            })
        },

        start() {
            clearInterval(this.timer)
            this.progress = 0

            let step = 100 / (this.duration / 50)

            this.timer = setInterval(() => {
                this.progress += step

                if (this.progress >= 100) {
                    this.next()
                }
            }, 50)
        },

        setVideoDuration() {
            let v = this.$refs.video
            if (v) {
                this.duration = v.duration * 1000
                this.start()
            }
        },

        next() {
            clearInterval(this.timer)
            this.$wire.nextStory().then(() => this.start())
        },

        prev() {
            clearInterval(this.timer)
            this.$wire.prevStory().then(() => this.start())
        },

        close() {
            clearInterval(this.timer)
            this.$wire.set('viewerOpen', false)
        },

        barWidth(i) {
            if (i < this.currentIndex) return 'width:100%'
            if (i == this.currentIndex) return `width:${this.progress}%`
            return 'width:0%'
        }
    }
}
</script>
