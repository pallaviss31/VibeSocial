<div class="min-h-screen bg-gray-50 py-10">

    <!-- Sidebar -->
    <div class="hidden lg:block fixed left-10 w-1/4">
        <div class="sticky top-24">
            <livewire:user.sidebar />
        </div>
    </div>

    <!-- Main Content -->
    <div class="lg:ml-80 px-6 space-y-12">

        <!-- MY COURSES -->
        <section class="bg-white rounded-xl shadow p-6">
            <h2 class="text-2xl font-bold mb-6 border-b pb-3">
                My Courses
            </h2>

            @if($myCourses->isEmpty())
                <div class="text-gray-500 text-center py-10">
                    You have not enrolled in any course yet.
                </div>
            @endif

            <div class="grid md:grid-cols-2 gap-4">
                @foreach($myCourses as $course)
                    <div class="border rounded-lg p-4 hover:shadow transition">
                        <h3 class="font-semibold text-lg">
                            {{ $course->name }}
                        </h3>

                        <p class="text-sm mt-2">
                            Status:
                            <span class="font-semibold
                                {{ $course->pivot->status === 'completed'
                                    ? 'text-green-600'
                                    : 'text-blue-600' }}">
                                {{ ucfirst($course->pivot->status) }}
                            </span>
                        </p>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- ALL COURSES -->
        <section class="bg-white rounded-xl shadow p-6">
            <h2 class="text-2xl font-bold mb-6 border-b pb-3">
                All Courses
            </h2>

            <div class="space-y-4">
                @foreach($allCourses as $course)

                    @php
                        $enrolled = $myCourses->contains($course->id);
                        $status = $enrolled
                            ? $myCourses->where('id', $course->id)->first()->pivot->status
                            : null;
                    @endphp

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between
                                border rounded-lg p-4 hover:shadow transition">

                        <div>
                            <h3 class="font-semibold text-lg">
                                {{ $course->name }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $course->semester }} · {{ $course->year }}
                            </p>
                        </div>

                        <div class="mt-3 md:mt-0">
                            @if($enrolled && $status === 'completed')
                                <span class="px-3 py-1 text-sm rounded-full
                                             bg-green-100 text-green-700">
                                    Completed
                                </span>

                            @elseif($enrolled)
                                <span class="px-3 py-1 text-sm rounded-full
                                             bg-blue-100 text-blue-700">
                                    Enrolled
                                </span>

                            @else
                                <button
                                    wire:click="enroll({{ $course->id }})"
                                    class="px-5 py-2 rounded-lg bg-blue-600
                                           hover:bg-blue-700 text-white text-sm
                                           transition">
                                    Enroll
                                </button>
                            @endif
                        </div>

                    </div>

                @endforeach
            </div>
        </section>

    </div>
</div>
