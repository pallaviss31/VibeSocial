<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
     <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-slate-100 text-slate-800">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-slate-900 text-slate-100 flex flex-col">
        <div class="h-16 flex items-center px-6 text-lg font-semibold border-b border-slate-800">
            Admin Panel
        </div>

        <livewire:admin.sidebar />
    </aside>

    <!-- Main Content -->
    <main class="flex-1">
        <!-- Top bar -->
        <header class="h-16 bg-white shadow flex items-center justify-between px-6">
            <h1 class="text-lg font-semibold">Dashboard</h1>

            <div class="flex items-center gap-4">
                <span class="text-sm text-slate-500">
                    {{ auth()->user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-sm text-red-500 hover:underline">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- Page Content -->
        <section class="p-6">
            {{ $slot }}
        </section>
    </main>

</div>

@livewireScripts
</body>
</html>
