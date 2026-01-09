<div class="max-w-4xl mx-auto py-12 px-4">
    <div class="bg-white shadow-xl rounded-2xl p-8 border border-slate-100">

        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-slate-800">
                Create New Quiz
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Fill in the details to create a new quiz
            </p>
        </div>

        <form wire:submit.prevent="save" class="space-y-6">

            <!-- Title -->
            <div>
                <label class="block text-xs font-semibold text-slate-500 mb-1">
                    Quiz Title
                </label>
                <input
                    wire:model="title"
                    type="text"
                    placeholder="e.g. Python Basics"
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                           transition"
                >
            </div>

            <!-- Description -->
            <div>
                <label class="block text-xs font-semibold text-slate-500 mb-1">
                    Description (optional)
                </label>
                <textarea
                    wire:model="description"
                    rows="3"
                    placeholder="Short description about this quiz"
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                           transition"
                ></textarea>
            </div>

            <!-- Numbers -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Total Questions -->
                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1">
                        Total Questions
                    </label>
                    <input
                        wire:model="total_questions"
                        type="number"
                        min="1"
                        placeholder="e.g. 10"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                               transition"
                    >
                </div>

                <!-- Passing Marks -->
                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1">
                        Passing Marks
                    </label>
                    <input
                        wire:model="passing_marks"
                        type="number"
                        min="1"
                        placeholder="e.g. 6"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                               transition"
                    >
                </div>

            </div>

            <!-- Time + Course -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Time Limit -->
                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1">
                        Time Limit (minutes)
                    </label>
                    <input
                        wire:model.defer="time_limit"
                        type="number"
                        min="1"
                        placeholder="e.g. 15"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                               transition"
                    >
                    <p class="text-[11px] text-slate-400 mt-1">
                        Quiz will auto-submit when time ends
                    </p>
                </div>

                <!-- Course -->
                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1">
                        Course
                    </label>
                    <select
                        wire:model="course_id"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                               transition"
                    >
                        <option value="">Select Course</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">
                                {{ $course->name }} ({{ $course->semester }})
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <!-- Button -->
            <div class="pt-4 flex justify-end">
                <button
                    type="submit"
                    class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700
                           text-white text-sm font-semibold px-8 py-3 rounded-xl
                           shadow-md hover:shadow-lg transition"
                >
                    Save & Add Questions →
                </button>
            </div>

        </form>
    </div>
</div>
