<div>
<h2 class="text-xl font-bold mb-4">Available Courses</h2>

@foreach($courses as $course)
    <div class="border p-4 mb-3 rounded">
        <h3 class="font-semibold">{{ $course->name }}</h3>
        <p>{{ $course->semester }} | {{ $course->year }}</p>

        <button
            wire:click="enroll({{ $course->id }})"
            class="mt-2 px-4 py-1 bg-blue-600 text-white rounded">
            Enroll
        </button>
    </div>
@endforeach
</div>
