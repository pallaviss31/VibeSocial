<div class="max-w-5xl mx-auto p-6 space-y-6">

    <!-- Sidebar -->
    <div class="hidden lg:block fixed left-10 w-1/4">
        <div class="sticky top-24">
            <livewire:user.sidebar />
        </div>
    </div>

    <div class="max-w-5xl mx-auto p-6 space-y-6">

        {{-- 🔒 PENDING / BLOCKED MESSAGE --}}
        @if(!$canView)
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 text-center">
                <p class="text-yellow-700 text-sm">
                    Your request is pending admin approval.
                </p>
            </div>
        @endif

        {{-- 👑 ADMIN PANEL --}}
        @if(auth()->id() === $group->created_by)
            <div class="bg-white border rounded-xl p-4 shadow mt-6">
                <h3 class="text-sm font-semibold mb-3 text-gray-700">
                    Join Requests
                </h3>

                @forelse($requests as $request)
                    <div class="flex justify-between items-center border-b py-2">
                        <div class="flex items-center gap-3">
                            <img src="{{ $request->user->profile_image
                                ? asset('storage/' . $request->user->profile_image)
                                : 'https://ui-avatars.com/api/?name=' . urlencode($request->user->fname) }}"
                                class="w-9 h-9 rounded-full object-cover border">

                            <div>
                                <p class="text-sm font-medium text-gray-800">
                                    {{ $request->user->fname }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    Requested to join
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button wire:click="approve({{ $request->id }})"
                                class="px-3 py-1 text-xs rounded bg-green-600 text-white">
                                Approve
                            </button>

                            <button wire:click="reject({{ $request->id }})"
                                class="px-3 py-1 text-xs rounded bg-red-600 text-white">
                                Reject
                            </button>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-gray-500">No pending requests</p>
                @endforelse
            </div>
        @endif

        {{-- ✅ REAL GROUP CONTENT --}}
       <div class="max-w-7xl mx-auto px-6 py-8 bg-gray-50 min-h-screen">

    <!-- GROUP HEADER -->
    <div class="bg-white rounded-3xl shadow overflow-hidden">
        <!-- Cover -->
        <div class="h-56 bg-gradient-to-r from-indigo-500 to-purple-600"></div>

        <!-- Info -->
        <div class="p-6 flex flex-col md:flex-row justify-between gap-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    {{ $group->name }}
                </h1>

                <p class="text-sm text-indigo-600 mt-1">
                    {{ $group->category }}
                </p>

                <p class="mt-3 text-gray-600 max-w-2xl">
                    {{ $group->description }}
                </p>
            </div>

            <!-- Stats -->
            <div class="flex gap-4 text-center">
                <div class="bg-indigo-50 px-5 py-3 rounded-xl">
                    <p class="text-xl font-bold text-indigo-700">
                        {{ $group->members->count() }}
                    </p>
                    <p class="text-xs text-gray-600">Members</p>
                </div>

                <div class="bg-green-50 px-5 py-3 rounded-xl">
                    <p class="text-xl font-bold text-green-700">
                        {{ $group->posts_count ?? 0 }}
                    </p>
                    <p class="text-xs text-gray-600">Posts</p>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">

        <!-- LEFT : POSTS -->
        <div class="lg:col-span-2 space-y-6">

            <!-- CREATE POST BOX -->
            <div class="bg-white p-4 rounded-xl shadow">
                <textarea
                    class="w-full border rounded-lg p-3 focus:ring focus:ring-indigo-200"
                    placeholder="Share notes, doubts or announcements..."
                ></textarea>

                <div class="flex justify-end mt-3">
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
                        Post
                    </button>
                </div>
            </div>

            {{-- POSTS LOOP (OPTIONAL) --}}
            @forelse($posts ?? [] as $post)
                <div class="bg-white p-5 rounded-xl shadow space-y-3">
                    <div class="flex items-center gap-3">
                        <img
                            src="{{ $post->user->profile_image
                                ? asset('storage/'.$post->user->profile_image)
                                : 'https://ui-avatars.com/api/?name='.urlencode($post->user->fname) }}"
                            class="w-10 h-10 rounded-full object-cover"
                        >

                        <div>
                            <p class="text-sm font-semibold">
                                {{ $post->user->fname }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ $post->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>

                    <p class="text-gray-700">
                        {{ $post->content }}
                    </p>
                </div>
            @empty
                <p class="text-sm text-gray-400">
                    No posts yet
                </p>
            @endforelse
        </div>

        <!-- RIGHT : SIDEBAR -->
        <div class="space-y-6">

            <!-- GROUP RULES -->
            <div class="bg-white p-5 rounded-xl shadow">
                <h3 class="font-semibold mb-3">Group Rules</h3>
                <ul class="text-sm text-gray-600 space-y-2">
                    @foreach($group->rules ?? [] as $rule)
                        <li>• {{ $rule }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="bg-white p-5 rounded-xl shadow">
                <h3 class="font-semibold mb-3">
                    Members
                </h3>

                <div class="space-y-3">
                    @forelse($group->members as $user)
                        <div class="flex items-center gap-3">
                            <img
                                src="{{ $user->profile_image
                                    ? asset('storage/'.$user->profile_image)
                                    : 'https://ui-avatars.com/api/?name='.urlencode($user->fname) }}"
                                class="w-8 h-8 rounded-full object-cover"
                            >

                            <p class="text-sm text-gray-700">
                                {{ $user->fname }}
                            </p>
                        </div>
                    @empty
                        <p class="text-sm text-gray-400">
                            No members yet
                        </p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>


    </div>
</div>
