<div class="max-w-6xl mx-auto py-10 space-y-6">

    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">
            Add Questions ({{ $quiz->total_questions }})
        </h2>

        <span class="text-sm text-gray-500">
            Quiz: {{ $quiz->title }}
        </span>
    </div>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-8">

        @foreach ($questions as $index => $q)
            <div class="bg-white border rounded-xl shadow-sm p-6 space-y-4">

                <h3 class="font-semibold text-lg text-indigo-600">
                    Question {{ $index + 1 }}
                </h3>

                <textarea wire:model="questions.{{ $index }}.question"
                    class="w-full border rounded-lg p-3 focus:ring focus:ring-indigo-200" placeholder="Enter question here..."></textarea>
                @error('questions.' . $index . '.question')
                    <p class="text-xs text-rose-600 mt-1">
                        {{ $message }}
                    </p>
                @enderror

                <div class="grid md:grid-cols-2 gap-4">
                    <input wire:model="questions.{{ $index }}.option_a" class="border p-2 rounded"
                        placeholder="Option A">

                    <input wire:model="questions.{{ $index }}.option_b" class="border p-2 rounded"
                        placeholder="Option B">

                    <input wire:model="questions.{{ $index }}.option_c" class="border p-2 rounded"
                        placeholder="Option C">

                    <input wire:model="questions.{{ $index }}.option_d" class="border p-2 rounded"
                        placeholder="Option D">
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-600">
                        Correct Answer
                    </label>

                    <select wire:model="questions.{{ $index }}.correct_option"
                        class="border rounded p-2 w-full mt-1">
                        <option value="">Select correct option</option>
                        <option value="a">Option A</option>
                        <option value="b">Option B</option>
                        <option value="c">Option C</option>
                        <option value="d">Option D</option>
                    </select>

                </div>

            </div>
        @endforeach

        <div class="flex justify-end">
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-lg shadow">
                Save All Questions
            </button>
        </div>

    </form>
</div>
