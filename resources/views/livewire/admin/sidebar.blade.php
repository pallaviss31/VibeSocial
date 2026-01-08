<nav class="flex-1 px-4 py-6 space-y-2">

    <a href="{{ route('admin.index') }}"
       class="flex items-center gap-3 px-4 py-2 rounded-lg
              hover:bg-slate-800 transition">
        📊 <span>Dashboard</span>
    </a>

    <a href="{{ route('admin.quizzes') }}"
       class="flex items-center gap-3 px-4 py-2 rounded-lg
              hover:bg-slate-800 transition">
        🧠 <span>Quizzes</span>
    </a>

    <a href="#"
       class="flex items-center gap-3 px-4 py-2 rounded-lg
              hover:bg-slate-800 transition">
        📚 <span>Courses</span>
    </a>

    <a href="#"
       class="flex items-center gap-3 px-4 py-2 rounded-lg
              hover:bg-slate-800 transition">
        👥 <span>Users</span>
    </a>

    <a href="#"
       class="flex items-center gap-3 px-4 py-2 rounded-lg
              hover:bg-slate-800 transition">
        ⚙️ <span>Settings</span>
    </a>

</nav>
