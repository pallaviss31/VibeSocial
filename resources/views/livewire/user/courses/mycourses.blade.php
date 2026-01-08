<div>
<h2 class="text-xl font-bold mb-4">My Courses</h2>

@if($myCourses->isEmpty())
    <p>No courses enrolled yet.</p>
@endif

@foreach($myCourses as $course)
    <div class="border p-4 mb-3 rounded">
        <h3>{{ $course->name }}</h3>
        <p>Status: {{ $course->pivot->status }}</p>
    </div>
@endforeach
</div>
