<div class="max-w-5xl mx-auto px-6 py-8 space-y-8">

    <!-- Quiz Header -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6">
        <h2 class="text-3xl font-bold text-gray-800">
            {{ $quiz->title }}
        </h2>

        <p class="text-sm text-slate-500 mt-2 max-w-3xl">
            {{ $quiz->description }}
        </p>
    </div>

    <!-- Questions Section -->
    <div class="space-y-6">

        @foreach ($quiz->questions as $q)
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 hover:shadow-md transition">

                <!-- Question -->
                <div class="flex items-start justify-between gap-4">
                    <p class="font-semibold text-gray-800 text-lg leading-snug">
                        {{ $loop->iteration }}. {{ $q->question }}
                    </p>

                    <span class="text-xs px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 font-medium">
                        Question {{ $loop->iteration }}
                    </span>
                </div>

                <!-- Options -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-4 text-sm">
                    <div class="px-4 py-2 rounded-lg border bg-gray-50">
                        <span class="font-medium">A.</span> {{ $q->option_a }}
                    </div>
                    <div class="px-4 py-2 rounded-lg border bg-gray-50">
                        <span class="font-medium">B.</span> {{ $q->option_b }}
                    </div>
                    <div class="px-4 py-2 rounded-lg border bg-gray-50">
                        <span class="font-medium">C.</span> {{ $q->option_c }}
                    </div>
                    <div class="px-4 py-2 rounded-lg border bg-gray-50">
                        <span class="font-medium">D.</span> {{ $q->option_d }}
                    </div>
                </div>

                <!-- Correct Answer -->
                <div class="mt-4">
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full
                        bg-green-100 text-green-700 text-sm font-medium">
                        ✔ Correct Answer:
                        {{ strtoupper($q->correct_option) }}
                    </span>
                </div>

                <!-- Actions -->
                <div class="mt-5 flex justify-end gap-3">
                    <button
                        class="inline-flex items-center px-4 py-1.5 rounded-lg text-sm font-medium
                        text-blue-600 bg-blue-50 hover:bg-blue-100 transition">
                        Edit
                    </button>

                    <button
                        wire:click="deleteQuestion({{ $q->id }})"
                        class="inline-flex items-center px-4 py-1.5 rounded-lg text-sm font-medium
                        text-red-600 bg-red-50 hover:bg-red-100 transition">
                        Delete
                    </button>
                </div>

            </div>
        @endforeach

    </div>

</div>
