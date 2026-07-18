<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'AutoPrime') - Showroom Mobil</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
</head>
<body class="bg-gray-50 text-gray-800">

    {{-- ============ NAVBAR BERANIMASI (FR-04) ============ --}}
    <nav
        x-data="{ scrolled: false, open: false }"
        x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 20)"
        :class="scrolled ? 'bg-gray-900/95 shadow-lg py-2' : 'bg-gray-900 py-4'"
        class="fixed top-0 inset-x-0 z-50 transition-all duration-300"
    >
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-white font-bold text-xl tracking-wide transition-transform duration-300"
               :class="scrolled ? 'scale-90' : 'scale-100'">
                Auto<span class="text-amber-400">Prime</span>
            </a>

            <div class="hidden md:flex items-center gap-6 text-sm">
                <a href="{{ route('home') }}" class="text-gray-200 hover:text-amber-400 transition-colors">Beranda</a>
                <a href="{{ route('cars.index') }}" class="text-gray-200 hover:text-amber-400 transition-colors">Semua Produk</a>

                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-200 hover:text-amber-400 transition-colors">Dashboard Admin</a>
                    @endif

                    <div class="relative" x-data="{ menuOpen: false }" @click.outside="menuOpen = false">
                        <button @click="menuOpen = !menuOpen" class="flex items-center gap-2 text-gray-200 hover:text-amber-400">
                            {{ auth()->user()->name }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform" :class="menuOpen ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
                        </button>
                        <div x-show="menuOpen" x-transition class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-xl overflow-hidden" style="display:none;">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-200 hover:text-amber-400 transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="bg-amber-500 text-gray-900 font-semibold px-4 py-1.5 rounded-full hover:bg-amber-400 transition-colors">Daftar</a>
                @endauth
            </div>

            <button class="md:hidden text-white" @click="open = !open">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/></svg>
            </button>
        </div>

        <div x-show="open" x-transition class="md:hidden px-4 pt-4 pb-2 space-y-2 bg-gray-900" style="display:none;">
            <a href="{{ route('home') }}" class="block text-gray-200 py-1">Beranda</a>
            <a href="{{ route('cars.index') }}" class="block text-gray-200 py-1">Semua Produk</a>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="block text-gray-200 py-1">Dashboard Admin</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block text-gray-200 py-1">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block text-gray-200 py-1">Login</a>
                <a href="{{ route('register') }}" class="block text-amber-400 py-1">Daftar</a>
            @endauth
        </div>
    </nav>

    <main class="pt-20">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 mt-4">
                <div class="bg-green-100 text-green-800 px-4 py-3 rounded-lg">{{ session('success') }}</div>
            </div>
        @endif
        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 mt-4">
                <div class="bg-red-100 text-red-800 px-4 py-3 rounded-lg">{{ session('error') }}</div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-gray-900 text-gray-400 text-sm mt-16 py-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            &copy; {{ date('Y') }} AutoPrime Showroom. Dibuat untuk keperluan tugas UAS Pemrograman Web 2.
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => AOS.init({ duration: 700, once: true }));
    </script>
</body>
</html>
