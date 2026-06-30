<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-zinc-100 text-zinc-950 antialiased">
    <div class="min-h-screen lg:flex">
        <aside class="bg-zinc-950 text-white lg:w-72">
            <div class="px-6 py-6">
                <a href="{{ route('admin.dashboard') }}" class="block text-xl font-black">Thayu Admin</a>
                <p class="mt-1 text-sm text-zinc-400">Addeh Prince content desk</p>
            </div>
            @auth
                <nav class="grid gap-1 px-3 pb-6 text-sm">
                    <a class="admin-nav" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <a class="admin-nav" href="{{ route('admin.songs.index') }}">Songs</a>
                    <a class="admin-nav" href="{{ route('admin.events.index') }}">Events</a>
                    <a class="admin-nav" href="{{ route('admin.services.index') }}">Branding Services</a>
                    <a class="admin-nav" href="{{ route('home') }}">View Website</a>
                    <form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="admin-nav w-full text-left">Logout</button></form>
                </nav>
            @endauth
        </aside>
        <main class="flex-1 px-4 py-6 sm:px-8">
            @if(session('success'))<div class="mb-5 rounded-md bg-emerald-100 px-4 py-3 text-sm text-emerald-900">{{ session('success') }}</div>@endif
            @yield('content')
        </main>
    </div>
</body>
</html>
