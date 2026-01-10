<div class="min-h-screen bg-slate-50 pb-12">
    <div class="hidden lg:block w-1/4 left-10 fixed ">
        <div class="sticky top-24">
            <livewire:user.sidebar />
        </div>
    </div>
    <div class="lg:ml-72 px-8 pt-8 space-y-8 ">

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-black text-slate-900">Education Dashboard</h1>
                <p class="text-slate-500 text-sm">Welcome back! Here’s what’s happening with your courses.</p>
            </div>

            <div class="flex -space-x-3 overflow-hidden p-1">
                @foreach ($joinedGroups ?? [] as $group)
                    <div title="{{ $group->name }}"
                        class="inline-block h-10 w-10 rounded-full ring-2 ring-white bg-indigo-600 flex items-center justify-center text-white text-xs font-bold cursor-help">
                        {{ substr($group->name, 0, 1) }}
                    </div>
                @endforeach
                <button
                    class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-dashed border-slate-300 bg-white text-slate-400 hover:border-indigo-500 hover:text-indigo-500 transition-colors">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Average Quiz Score</p>
                        <h4 class="text-2xl font-black text-slate-900">{{ $averageScore }}%</h4>
                    </div>
                </div>
                <div class="mt-4 flex items-end gap-1 h-12">
                    <div class="flex-1 bg-indigo-100 rounded-t-sm h-1/2"></div>
                    <div class="flex-1 bg-indigo-100 rounded-t-sm h-3/4"></div>
                    <div class="flex-1 bg-indigo-200 rounded-t-sm h-2/3"></div>
                    <div class="flex-1 bg-indigo-400 rounded-t-sm h-full"></div>
                    <div class="flex-1 bg-indigo-600 rounded-t-sm h-4/5"></div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Completed Quizzes</p>
                        <h4 class="text-2xl font-black text-slate-900"> {{ $completedQuizzes }}/{{ $totalQuizzes }}</h4>
                    </div>
                </div>
                <div class="mt-6 w-full bg-slate-100 rounded-full h-2">
                    <div class="bg-emerald-500 h-2 rounded-full"
                        style="width: {{ $totalQuizzes > 0 ? ($completedQuizzes / $totalQuizzes) * 100 : 0 }}%"></div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-amber-50 text-amber-600 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Courses Enrolled</p>
                        <h4 class="text-2xl font-black text-slate-900">{{ $myCourses->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <section>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-slate-800">My Learning Path</h2>
                <a href="#" class="text-sm font-bold text-indigo-600 hover:text-indigo-700">View All</a>
            </div>

            @if ($myCourses->isEmpty())
                <div class="bg-white rounded-2xl border-2 border-dashed border-slate-200 p-12 text-center">
                    <p class="text-slate-400 font-medium">You haven't enrolled in any courses yet.</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($myCourses as $course)
                    <div
                        class="group bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="h-32 bg-slate-900 p-6 flex flex-col justify-end relative overflow-hidden">
                            <div class="absolute -right-4 -top-4 w-24 h-24 bg-indigo-500/20 rounded-full blur-2xl">
                            </div>
                            <h3 class="text-white font-bold text-lg relative z-10">{{ $course->name }}</h3>
                        </div>

                        @php
                            // Collect all attempts of this course (current user only if needed)
                            $attempts = $course->quizzes->flatMap->attempts;

                            $percentage =
                                $attempts->count() > 0
                                    ? round(
                                        ($attempts->sum('score') /
                                            $attempts->sum(fn($a) => max($a->quiz->total_questions, 1))) *
                                            100,
                                        2,
                                    )
                                    : 0;
                        @endphp

                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                    Quiz Performance
                                </span>

                                <!-- 🔹 Dynamic Percentage -->
                                <span class="text-sm font-black text-indigo-600">
                                    {{ $percentage }}%
                                </span>
                            </div>

                            <!-- 🔹 Dynamic Progress Bar -->
                            <div class="w-full bg-slate-100 rounded-full h-1.5 mb-6">
                                <div class="bg-indigo-600 h-1.5 rounded-full transition-all duration-500"
                                    style="width: {{ $percentage }}%">
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <span
                                    class="px-3 py-1 text-[10px] font-black uppercase rounded-lg
            {{ $course->pivot->status === 'completed' ? 'bg-emerald-50 text-emerald-600' : 'bg-blue-50 text-blue-600' }}">
                                    {{ ucfirst($course->pivot->status) }}
                                </span>

                                <a href=""
                                    class="text-sm font-bold text-slate-900 flex items-center gap-2 hover:text-indigo-600 transition-colors">
                                    Continue
                                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </section>

        <section class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
            <h2 class="text-xl font-bold text-slate-800 mb-6">Explore New Courses</h2>

            <div class="space-y-3">
                @foreach ($allCourses as $course)
                    @php
                        $enrolled = $myCourses->contains($course->id);
                    @endphp
                    <div
                        class="flex flex-col sm:flex-row items-center justify-between p-4 rounded-xl border border-slate-100 hover:border-indigo-100 hover:bg-indigo-50/30 transition-all group">
                        <div class="flex items-center gap-4">
                            <div
                                class="h-12 w-12 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-white group-hover:text-indigo-600 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900">{{ $course->name }}</h4>
                                <p class="text-xs text-slate-500 font-medium">{{ $course->semester }} ·
                                    {{ $course->year }}</p>
                            </div>
                        </div>

                        <div class="mt-4 sm:mt-0">
                            @if ($enrolled)
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 text-slate-500 text-xs font-bold">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Joined
                                </span>
                            @else
                                <button wire:click="enroll({{ $course->id }})"
                                    class="px-6 py-2 bg-white border border-slate-200 text-slate-900 text-xs font-black rounded-lg hover:bg-slate-900 hover:text-white hover:border-slate-900 transition-all shadow-sm">
                                    Enroll Now
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

    </div>
</div>
