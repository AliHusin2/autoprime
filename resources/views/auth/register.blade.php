<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar — AutoPrime</title>
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
        .orb {
            position: absolute; border-radius: 50%; pointer-events: none;
            background: radial-gradient(circle, rgba(245,158,11,0.2) 0%, transparent 70%);
        }
        @keyframes drift { 0%,100%{transform:translate(0,0) scale(1);} 50%{transform:translate(-30px,20px) scale(1.12);} }
        @keyframes fadeSlideUp { from { opacity:0; transform:translateY(24px); } to { opacity:1; transform:translateY(0); } }
        .fade-in { animation: fadeSlideUp 0.7s ease forwards; }
        .fade-in-1 { animation-delay: 0.05s; opacity: 0; }
        .fade-in-2 { animation-delay: 0.12s; opacity: 0; }
        .fade-in-3 { animation-delay: 0.19s; opacity: 0; }
        .fade-in-4 { animation-delay: 0.26s; opacity: 0; }
        .fade-in-5 { animation-delay: 0.33s; opacity: 0; }
        .fade-in-6 { animation-delay: 0.40s; opacity: 0; }
    </style>
</head>
<body>
<div style="min-height:100vh;display:grid;grid-template-columns:1fr 1fr;">

    {{-- ── LEFT: Branding ── --}}
    <div style="background:#000;position:relative;overflow:hidden;display:flex;flex-direction:column;justify-content:space-between;padding:40px 48px;">
        <div class="orb" style="width:700px;height:700px;top:-150px;left:-250px;animation:drift 12s ease-in-out infinite;"></div>
        <div class="orb" style="width:350px;height:350px;bottom:-50px;right:-80px;animation:drift 9s ease-in-out infinite reverse;opacity:0.6;"></div>

        <a href="{{ route('home') }}" style="position:relative;z-index:1;font-size:20px;font-weight:800;color:#fff;text-decoration:none;letter-spacing:-0.3px;">
            Auto<span style="color:#f59e0b;">Prime</span>
        </a>

        <div style="position:relative;z-index:1;">
            <p style="font-size:11px;font-weight:600;letter-spacing:0.2em;text-transform:uppercase;color:#f59e0b;margin:0 0 20px;">Mulai Perjalanan Anda</p>
            <h1 style="font-size:clamp(32px,4vw,52px);font-weight:800;letter-spacing:-1.5px;line-height:1.1;color:#fff;margin:0 0 20px;">
                Buat akun.<br>Temukan mobil<br>impian Anda.
            </h1>
            <p style="font-size:16px;color:rgba(255,255,255,0.45);line-height:1.65;margin:0;max-width:320px;">
                Daftar gratis dan nikmati akses ke ribuan koleksi kendaraan pilihan kami.
            </p>
            <div style="width:48px;height:3px;background:#f59e0b;border-radius:3px;margin-top:36px;"></div>
        </div>

        <p style="position:relative;z-index:1;font-size:12px;color:rgba(255,255,255,0.2);margin:0;">
            &copy; {{ date('Y') }} AutoPrime Showroom
        </p>
    </div>

    {{-- ── RIGHT: Form ── --}}
    <div style="display:flex;align-items:center;justify-content:center;padding:48px 40px;background:#fff;overflow-y:auto;">
        <div style="width:100%;max-width:380px;">

            <div class="fade-in fade-in-1" style="margin-bottom:32px;">
                <h2 style="font-size:28px;font-weight:800;color:#1d1d1f;margin:0 0 8px;letter-spacing:-0.6px;">Buat Akun Baru</h2>
                <p style="font-size:14px;color:#6e6e73;margin:0;">Sudah punya akun?
                    <a href="{{ route('login') }}" style="color:#f59e0b;font-weight:500;text-decoration:none;">Masuk di sini</a>
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}" style="display:flex;flex-direction:column;gap:14px;">
                @csrf

                <div class="fade-in fade-in-2">
                    <label for="name" class="ap-label">Nama Lengkap</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}"
                           required autofocus autocomplete="name"
                           class="ap-input" placeholder="John Doe">
                    @error('name')
                        <p style="font-size:12px;color:#dc2626;margin:6px 0 0;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="fade-in fade-in-3">
                    <label for="email" class="ap-label">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           required autocomplete="username"
                           class="ap-input" placeholder="nama@email.com">
                    @error('email')
                        <p style="font-size:12px;color:#dc2626;margin:6px 0 0;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="fade-in fade-in-4">
                    <label for="password" class="ap-label">Password</label>
                    <input id="password" type="password" name="password"
                           required autocomplete="new-password"
                           class="ap-input" placeholder="Min. 8 karakter">
                    @error('password')
                        <p style="font-size:12px;color:#dc2626;margin:6px 0 0;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="fade-in fade-in-5">
                    <label for="password_confirmation" class="ap-label">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                           required autocomplete="new-password"
                           class="ap-input" placeholder="Ulangi password">
                    @error('password_confirmation')
                        <p style="font-size:12px;color:#dc2626;margin:6px 0 0;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="fade-in fade-in-6" style="margin-top:4px;">
                    <button type="submit"
                            style="width:100%;height:52px;border:none;border-radius:14px;background:#f59e0b;color:#000;font-size:15px;font-weight:700;font-family:inherit;cursor:pointer;letter-spacing:-0.2px;transition:background 0.2s,transform 0.15s;"
                            onmouseover="this.style.background='#fbbf24'" onmouseout="this.style.background='#f59e0b'"
                            onmousedown="this.style.transform='scale(0.98)'" onmouseup="this.style.transform='scale(1)'">
                        Buat Akun
                    </button>
                    <p style="font-size:12px;color:#b0b0b8;text-align:center;margin:12px 0 0;">
                        Gratis, tanpa kartu kredit
                    </p>
                </div>
            </form>
        </div>
    </div>

</div>

<style>
@media (max-width: 767px) {
    body > div { grid-template-columns: 1fr !important; }
    body > div > div:first-child { display: none !important; }
}
</style>
</body>
</html>
