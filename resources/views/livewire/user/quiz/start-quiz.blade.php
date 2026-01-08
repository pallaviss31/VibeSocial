<div class="max-w-4xl mx-auto p-6 space-y-6">

    <h1 class="text-xl font-bold mb-4">
        {{ $quiz->title }}
    </h1>

    @foreach ($questions as $q)
        <div class="bg-white p-4 rounded-xl shadow space-y-2">
            <p class="font-semibold">
                {{ $loop->iteration }}. {{ $q->question }}
            </p>

            @foreach (['a','b','c','d'] as $opt)
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio"
                        wire:click="selectOption({{ $q->id }}, '{{ $opt }}')"
                        @checked(($answers[$q->id] ?? '') === $opt)>
                    {{ $q->{'option_'.$opt} }}
                </label>
            @endforeach
        </div>
    @endforeach

    <button
        type="button"
        wire:click="submitQuiz"
        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-bold">
        Submit Quiz
    </button>

</div>
