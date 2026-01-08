<div class="max-w-8xl mx-auto px-4 lg:px-1 py-8">
    <div class="flex flex-col lg:flex-row gap-5">

        <!-- Left Sidebar: Academic Menu -->
        <div class="hidden lg:block w-1/4 ml-7">
            <div class="sticky top-24 h-[calc(100vh-6rem)] hover:overflow-y-auto pr-2">
                <livewire:user.sidebar />
            </div>
        </div>


        <!-- Center Feed: Campus Updates -->
        <div class="w-[70%]  ml-[22px]">
            <!-- Stories -->
            <livewire:user.story />

            <livewire:user.post.create-form />

            <div class="mt-6 space-y-6">
                @livewire('user.post.calling-post')
            </div>
        </div>

        <!-- Right Sidebar: Productivity Corner -->
        <div class="hidden lg:block lg:w-[500px]  mr-10">
            <div class="sticky top-24 space-y-6">
                <livewire:user.onlinefriends />

                <!-- Upcoming Deadlines Widget -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold text-slate-800">Deadlines</h3>
                        <a href="{{ route('assignments') }}"
                            class="text-xs font-medium text-indigo-600 hover:underline">View All</a>
                    </div>
                    <div class="space-y-4">
                        <div class="flex gap-3 items-start">
                            <div
                                class="flex-shrink-0 w-12 h-12 bg-red-50 rounded-xl flex flex-col items-center justify-center text-red-600 border border-red-100">
                                <span class="text-xs font-bold uppercase">Dec</span>
                                <span class="text-lg font-bold leading-none">10</span>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 line-clamp-1">Data Structures Final</h4>
                                <p class="text-xs text-slate-500">CS-101 • 10:00 AM</p>
                            </div>
                        </div>
                        <div class="flex gap-3 items-start">
                            <div
                                class="flex-shrink-0 w-12 h-12 bg-orange-50 rounded-xl flex flex-col items-center justify-center text-orange-600 border border-orange-100">
                                <span class="text-xs font-bold uppercase">Dec</span>
                                <span class="text-lg font-bold leading-none">12</span>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 line-clamp-1">History Essay Due</h4>
                                <p class="text-xs text-slate-500">HIS-202 • 11:59 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
