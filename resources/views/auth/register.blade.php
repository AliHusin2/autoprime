<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - AutoPrime</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
<div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">

    {{-- ============ SISI KIRI: BRANDING ============ --}}
    <div class="hidden lg:flex flex-col justify-between bg-gray-900 text-white p-12 relative overflow-hidden order-2 lg:order-1">
        <div class="absolute inset-0 opacity-20"
             style="background-image: radial-gradient(circle at 20% 20%, #f59e0b 0%, transparent 40%), radial-gradient(circle at 80% 80%, #f59e0b 0%, transparent 40%);"></div>

        <a href="{{ route('login') }}" class="relative text-2xl font-bold tracking-wide">
            Auto<span class="text-amber-400">Prime</span>
        </a>

        <div class="relative">
            <h1 class="text-4xl font-bold leading-tight max-w-md">
                Buat akun dan mulai jelajahi koleksi mobil kami.
            </h1>
            <p class="mt-4 text-gray-300 max-w-sm">
                Daftar gratis untuk melihat katalog lengkap dan mengajukan
                test drive langsung dari rumah.
            </p>
        </div>

        <p class="relative text-sm text-gray-500">&copy; {{ date('Y') }} AutoPrime Showroom</p>
    </div>

    {{-- ============ SISI KANAN: FORM REGISTER ============ --}}
    <div class="flex items-center justify-center p-6 sm:p-12 order-1 lg:order-2">
        <div class="w-full max-w-sm">
            <div class="lg:hidden text-center mb-8">
                <span class="text-2xl font-bold text-gray-900">Auto<span class="text-amber-500">Prime</span></span>
            </div>

            <h2 class="text-2xl font-bold text-gray-900">Buat Akun Baru</h2>
            <p class="text-sm text-gray-500 mt-1 mb-6">Daftar sebagai customer untuk mulai browsing mobil.</p>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                           class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:ring-amber-500 focus:border-amber-500">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                           class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:ring-amber-500 focus:border-amber-500">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                           class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:ring-amber-500 focus:border-amber-500">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                           class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:ring-amber-500 focus:border-amber-500">
                    @error('password_confirmation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full bg-amber-500 text-gray-900 font-semibold py-2.5 rounded-lg hover:bg-amber-400 transition-colors">
                    Daftar
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-500">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-amber-600 font-medium hover:underline">Login di sini</a>
            </p>
        </div>
    </div>
</div>
</body>
</html>
