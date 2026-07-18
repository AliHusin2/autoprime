<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - AutoPrime</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
<div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">

    {{-- ============ SISI KIRI: BRANDING ============ --}}
    <div class="hidden lg:flex flex-col justify-between bg-gray-900 text-white p-12 relative overflow-hidden">
        <div class="absolute inset-0 opacity-20"
             style="background-image: radial-gradient(circle at 20% 20%, #f59e0b 0%, transparent 40%), radial-gradient(circle at 80% 80%, #f59e0b 0%, transparent 40%);"></div>

        <a href="{{ route('login') }}" class="relative text-2xl font-bold tracking-wide">
            Auto<span class="text-amber-400">Prime</span>
        </a>

        <div class="relative">
            <h1 class="text-4xl font-bold leading-tight max-w-md">
                Selamat datang kembali di showroom mobil pilihan Anda.
            </h1>
            <p class="mt-4 text-gray-300 max-w-sm">
                Masuk untuk melihat koleksi mobil terbaru, mengajukan test drive,
                dan memantau status pengajuan Anda.
            </p>
        </div>

        <p class="relative text-sm text-gray-500">&copy; {{ date('Y') }} AutoPrime Showroom</p>
    </div>

    {{-- ============ SISI KANAN: FORM LOGIN ============ --}}
    <div class="flex items-center justify-center p-6 sm:p-12">
        <div class="w-full max-w-sm">
            <div class="lg:hidden text-center mb-8">
                <span class="text-2xl font-bold text-gray-900">Auto<span class="text-amber-500">Prime</span></span>
            </div>

            <h2 class="text-2xl font-bold text-gray-900">Masuk ke Akun</h2>
            <p class="text-sm text-gray-500 mt-1 mb-6">Silakan login untuk melanjutkan.</p>

            @if (session('status'))
                <div class="mb-4 text-sm font-medium text-green-600">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                           class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:ring-amber-500 focus:border-amber-500">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:ring-amber-500 focus:border-amber-500">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 text-gray-600">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-amber-500 focus:ring-amber-500">
                        Ingat saya
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-amber-600 hover:underline">Lupa password?</a>
                    @endif
                </div>

                <button type="submit"
                        class="w-full bg-gray-900 text-white font-semibold py-2.5 rounded-lg hover:bg-gray-800 transition-colors">
                    Login
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-500">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-amber-600 font-medium hover:underline">Daftar di sini</a>
            </p>
        </div>
    </div>
</div>
</body>
</html>
