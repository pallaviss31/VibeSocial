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
            <header
                class="sticky top-0 z-40 flex h-16 w-full items-center justify-between border-b border-slate-200 bg-white/80 px-8 backdrop-blur-md">

                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-4">

                        <!-- Mobile menu -->
                        <button class="block lg:hidden text-slate-500 hover:text-slate-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16m-7 6h7"></path>
                            </svg>
                        </button>

                        <!-- USER MODE BUTTON -->
                        @auth
                            @if (auth()->user()->role === 'admin')
                                <a href="{{ route('dashboard') }}"
                                    class="hidden sm:flex items-center gap-2 px-3 py-1.5
                  rounded-lg bg-slate-100 text-slate-700
                  text-sm font-semibold
                  hover:bg-indigo-50 hover:text-indigo-600
                  transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7" />
                                    </svg>
                                    User Mode
                                </a>
                            @endif
                        @endauth



                    </div>

                    <button class="block lg:hidden text-slate-500 hover:text-slate-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>

                    <nav class="hidden sm:flex items-center gap-2 text-sm font-medium text-slate-500">
                        <a href="#" class="hover:text-indigo-600 transition-colors">Admin</a>
                        <svg class="h-4 w-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                        <span class="text-slate-900">Dashboard</span>
                    </nav>
                </div>

                <div class="flex items-center gap-3">

                    <button
                        class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-slate-50 rounded-full transition-all">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>

                    <div class="relative">
                        <button
                            class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-slate-50 rounded-full transition-all relative">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                </path>
                            </svg>
                            <span
                                class="absolute top-2 right-2.5 h-2 w-2 rounded-full bg-red-500 border-2 border-white"></span>
                        </button>
                    </div>

                    <div class="h-6 w-px bg-slate-200 mx-2"></div>

                    <div class="flex items-center gap-3 pl-2">
                        <div class="text-right hidden md:block">
                            <p class="text-sm font-bold text-slate-900 leading-none">
                                {{ auth()->user()->fname }} {{ auth()->user()->lname }}
                            </p>
                            <p class="text-xs font-medium text-slate-500 mt-1">
                                Administrator
                            </p>
                        </div>

                        <div class="relative group cursor-pointer">
                            <div
                                class="h-10 w-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white font-bold shadow-md shadow-indigo-100 ring-2 ring-white transition-transform group-hover:scale-105">
                                {{ substr(auth()->user()->fname, 0, 1) }}{{ substr(auth()->user()->lname, 0, 1) }}
                            </div>

                            <div
                                class="absolute right-0 mt-2 w-48 bg-white border border-slate-200 rounded-xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 py-2">
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-indigo-600">Your
                                    Profile</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-indigo-600">Account
                                    Settings</a>
                                <hr class="my-1 border-slate-100">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button
                                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-medium">
                                        Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
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
