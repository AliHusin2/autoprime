<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk — AutoPrime</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; height: 100%; }
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; -webkit-font-smoothing: antialiased; background: #fff; }
        .ap-input {
            width: 100%; padding: 14px 16px; border: 1.5px solid #e8e8ed; border-radius: 12px;
            font-size: 15px; font-family: inherit; background: #fff; color: #1d1d1f;
            outline: none; transition: border-color 0.2s;
        }
        .ap-input:focus { border-color: #f59e0b; }
        .ap-label { display: block; font-size: 13px; font-weight: 500; color: #6e6e73; margin-bottom: 6px; }

        /* Animated orbs */
        .orb {
            position: absolute; border-radius: 50%; pointer-events: none;
            background: radial-gradient(circle, rgba(245,158,11,0.2) 0%, transparent 70%);
        }
        @keyframes drift { 0%,100%{transform:translate(0,0) scale(1);} 50%{transform:translate(30px,-20px) scale(1.1);} }
        @keyframes fadeSlideUp { from { opacity:0; transform:translateY(24px); } to { opacity:1; transform:translateY(0); } }
        .fade-in { animation: fadeSlideUp 0.7s ease forwards; }
        .fade-in-1 { animation-delay: 0.1s; opacity: 0; }
        .fade-in-2 { animation-delay: 0.2s; opacity: 0; }
        .fade-in-3 { animation-delay: 0.3s; opacity: 0; }
        .fade-in-4 { animation-delay: 0.4s; opacity: 0; }
        .fade-in-5 { animation-delay: 0.5s; opacity: 0; }
    </style>
</head>
<body>
<div style="min-height:100vh;display:grid;grid-template-columns:1fr 1fr;">

    {{-- ── LEFT: Branding ── --}}
    <div style="background:#000;position:relative;overflow:hidden;display:flex;flex-direction:column;justify-content:space-between;padding:40px 48px;">

        {{-- Ambient orbs --}}
        <div class="orb" style="width:600px;height:600px;top:-100px;left:-200px;animation:drift 10s ease-in-out infinite;"></div>
        <div class="orb" style="width:400px;height:400px;bottom:-100px;right:-100px;animation:drift 13s ease-in-out infinite reverse;"></div>

        {{-- Logo --}}
        <a href="{{ route('home') }}" style="position:relative;z-index:1;font-size:20px;font-weight:800;color:#fff;text-decoration:none;letter-spacing:-0.3px;">
            Auto<span style="color:#f59e0b;">Prime</span>
        </a>

        {{-- Main copy --}}
        <div style="position:relative;z-index:1;">
            <p style="font-size:11px;font-weight:600;letter-spacing:0.2em;text-transform:uppercase;color:#f59e0b;margin:0 0 20px;">Showroom Premium</p>
            <h1 style="font-size:clamp(32px,4vw,52px);font-weight:800;letter-spacing:-1.5px;line-height:1.1;color:#fff;margin:0 0 20px;">
                Selamat datang<br>kembali.
            </h1>
            <p style="font-size:16px;color:rgba(255,255,255,0.45);line-height:1.65;margin:0;max-width:320px;">
                Masuk untuk melihat koleksi terbaru, mengajukan test drive, dan memantau status pengajuan Anda.
            </p>

            {{-- Divider --}}
            <div style="width:48px;height:3px;background:#f59e0b;border-radius:3px;margin-top:36px;"></div>
        </div>

        {{-- Footer --}}
        <p style="position:relative;z-index:1;font-size:12px;color:rgba(255,255,255,0.2);margin:0;">
            &copy; {{ date('Y') }} AutoPrime Showroom
        </p>
    </div>

    {{-- ── RIGHT: Form ── --}}
    <div style="display:flex;align-items:center;justify-content:center;padding:48px 40px;background:#fff;">
        <div style="width:100%;max-width:380px;">

            {{-- Mobile logo --}}
            <div class="fade-in fade-in-1" style="display:none;text-align:center;margin-bottom:32px;">
                <a href="{{ route('home') }}" style="font-size:24px;font-weight:800;color:#1d1d1f;text-decoration:none;">
                    Auto<span style="color:#f59e0b;">Prime</span>
                </a>
            </div>

            <div class="fade-in fade-in-1" style="margin-bottom:36px;">
                <h2 style="font-size:28px;font-weight:800;color:#1d1d1f;margin:0 0 8px;letter-spacing:-0.6px;">Masuk ke Akun</h2>
                <p style="font-size:14px;color:#6e6e73;margin:0;">Belum punya akun?
                    <a href="{{ route('register') }}" style="color:#f59e0b;font-weight:500;text-decoration:none;">Daftar sekarang</a>
                </p>
            </div>

            @if (session('status'))
                <div class="fade-in fade-in-2" style="background:#d1fae5;color:#065f46;padding:12px 16px;border-radius:10px;font-size:14px;margin-bottom:20px;">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" style="display:flex;flex-direction:column;gap:16px;">
                @csrf

                <div class="fade-in fade-in-2">
                    <label for="email" class="ap-label">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           required autofocus autocomplete="username"
                           class="ap-input" placeholder="nama@email.com">
                    @error('email')
                        <p style="font-size:12px;color:#dc2626;margin:6px 0 0;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="fade-in fade-in-3">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;">
                        <label for="password" class="ap-label" style="margin:0;">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" style="font-size:12px;color:#f59e0b;text-decoration:none;font-weight:500;">Lupa password?</a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           class="ap-input" placeholder="••••••••">
                    @error('password')
                        <p style="font-size:12px;color:#dc2626;margin:6px 0 0;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="fade-in fade-in-4" style="display:flex;align-items:center;gap:8px;">
                    <input type="checkbox" id="remember" name="remember"
                           style="width:16px;height:16px;accent-color:#f59e0b;cursor:pointer;border-radius:4px;">
                    <label for="remember" style="font-size:13px;color:#6e6e73;cursor:pointer;">Ingat saya</label>
                </div>

                <div class="fade-in fade-in-5">
                    <button type="submit"
                            style="width:100%;height:52px;border:none;border-radius:14px;background:#1d1d1f;color:#fff;font-size:15px;font-weight:600;font-family:inherit;cursor:pointer;letter-spacing:-0.2px;transition:background 0.2s,transform 0.15s;"
                            onmouseover="this.style.background='#333'" onmouseout="this.style.background='#1d1d1f'"
                            onmousedown="this.style.transform='scale(0.98)'" onmouseup="this.style.transform='scale(1)'">
                        Masuk
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<style>
@media (max-width: 767px) {
    body > div { grid-template-columns: 1fr !important; }
    body > div > div:first-child { display: none !important; }
    body > div > div:last-child > div > div:first-child { display: block !important; }
}
</style>
</body>
</html>
