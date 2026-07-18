<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') - AutoPrime</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">
<div class="flex min-h-screen">
    <aside class="w-64 bg-gray-900 text-gray-200 flex-shrink-0">
        <div class="px-6 py-5 text-xl font-bold border-b border-gray-800">
            Auto<span class="text-amber-400">Prime</span> <span class="text-xs font-normal block text-gray-400">Admin Panel</span>
        </div>
        <nav class="px-3 py-4 space-y-1 text-sm">
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-amber-400' : '' }}">Dashboard</a>
            <a href="{{ route('admin.cars.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.cars.*') ? 'bg-gray-800 text-amber-400' : '' }}">Kelola Mobil</a>
            <a href="{{ route('admin.brands.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.brands.*') ? 'bg-gray-800 text-amber-400' : '' }}">Kelola Brand</a>
            <a href="{{ route('admin.categories.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.categories.*') ? 'bg-gray-800 text-amber-400' : '' }}">Kelola Kategori</a>
            <a href="{{ route('admin.inquiries.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.inquiries.*') ? 'bg-gray-800 text-amber-400' : '' }}">Inquiry / Test Drive</a>
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-800 mt-4 text-gray-400">&larr; Lihat Situs</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-3 py-2 rounded-lg hover:bg-gray-800 text-gray-400">Logout</button>
            </form>
        </nav>
    </aside>

    <div class="flex-1">
        <header class="bg-white shadow px-6 py-4 flex items-center justify-between">
            <h1 class="text-lg font-semibold">@yield('title', 'Dashboard')</h1>
            <span class="text-sm text-gray-500">{{ auth()->user()->name }} (Admin)</span>
        </header>

        <main class="p-6">
            @if(session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-3 rounded-lg mb-4">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 text-red-800 px-4 py-3 rounded-lg mb-4">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="bg-red-100 text-red-800 px-4 py-3 rounded-lg mb-4">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
