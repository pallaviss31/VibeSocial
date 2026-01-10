<div class="space-y-6">

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-sm text-slate-500">Total Users</p>
            <h2 class="text-2xl font-bold mt-2">
                {{ $totalUsers }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-sm text-slate-500">Total Quizzes</p>
            <h2 class="text-2xl font-bold mt-2">
                {{ $totalQuizzes }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-sm text-slate-500">Active Courses</p>
            <h2 class="text-2xl font-bold mt-2">
                {{ $activeCourses }}
            </h2>
        </div>

    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Recent Activity</h3>

        @if(empty($recentActivities))
            <p class="text-sm text-slate-500">No recent activity</p>
        @else
            <ul class="space-y-3 text-sm text-slate-600">
                @foreach($recentActivities as $activity)
                    <li>✔ {{ $activity }}</li>
                @endforeach
            </ul>
        @endif
    </div>

</div>
