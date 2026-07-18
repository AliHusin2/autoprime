@extends('layouts.app')
@section('title', 'AutoPrime — Showroom Mobil')

@section('content')

{{-- ══════════════════════════════════════
     HERO — Full viewport, cinematic reveal
══════════════════════════════════════ --}}
<section class="hero-section" style="position:relative;min-height:100svh;background:#000;display:flex;flex-direction:column;align-items:center;justify-content:center;overflow:hidden;">

    {{-- Ambient orbs --}}
    <div class="hero-bg-orb" style="width:700px;height:700px;top:50%;left:50%;transform:translate(-55%,-55%);opacity:0.9;"></div>
    <div class="hero-bg-orb" style="width:400px;height:400px;bottom:10%;right:10%;background:radial-gradient(circle,rgba(245,158,11,0.08) 0%,transparent 70%);"></div>

    {{-- Noise texture overlay --}}
    <div style="position:absolute;inset:0;opacity:0.03;background-image:url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22300%22 height=%22300%22><filter id=%22n%22><feTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%223%22 stitchTiles=%22stitch%22/></filter><rect width=%22300%22 height=%22300%22 filter=%22url(%23n)%22 opacity=%221%22/></svg>');"></div>

    <div style="position:relative;z-index:10;text-align:center;padding:0 24px;width:100%;max-width:960px;">

        <p class="hero-eyebrow" style="font-size:11px;font-weight:600;letter-spacing:0.25em;text-transform:uppercase;color:#f59e0b;margin-bottom:24px;">
            AutoPrime Showroom
        </p>

        <h1 style="margin:0;padding:0;">
            <div class="ap-clip" style="margin-bottom:4px;">
                <span class="hero-line" style="display:block;font-size:clamp(52px,10vw,120px);font-weight:800;letter-spacing:-3px;line-height:1;color:#fff;">Temukan</span>
            </div>
            <div class="ap-clip" style="margin-bottom:4px;">
                <span class="hero-line" style="display:block;font-size:clamp(52px,10vw,120px);font-weight:800;letter-spacing:-3px;line-height:1;color:#fff;">Mobil</span>
            </div>
            <div class="ap-clip">
                <span class="hero-line" style="display:block;font-size:clamp(52px,10vw,120px);font-weight:800;letter-spacing:-3px;line-height:1;color:#f59e0b;">Impian Anda.</span>
            </div>
        </h1>

        <p class="hero-sub" style="font-size:clamp(16px,2vw,20px);color:rgba(255,255,255,0.55);font-weight:400;line-height:1.65;max-width:520px;margin:28px auto 0;">
            Koleksi mobil terkurasi, harga transparan, dan pengalaman showroom yang berbeda dari yang lain.
        </p>

        <div class="hero-cta" style="display:flex;flex-wrap:wrap;gap:12px;justify-content:center;margin-top:40px;">
            <a href="{{ route('cars.index') }}" class="ap-btn ap-btn-primary" style="height:48px;padding:0 28px;font-size:15px;">Jelajahi Koleksi</a>
            <a href="{{ route('register') }}" class="ap-btn ap-btn-outline" style="height:48px;padding:0 28px;font-size:15px;">Mulai Sekarang</a>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="hero-scroll" style="position:absolute;bottom:40px;left:50%;transform:translateX(-50%);display:flex;flex-direction:column;align-items:center;gap:8px;">
        <span style="font-size:10px;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.3);">Scroll</span>
        <div class="scroll-line" style="width:1px;height:48px;background:linear-gradient(to bottom,rgba(255,255,255,0.4),transparent);"></div>
    </div>
</section>

{{-- ══════════════════════════════════════
     STATEMENT SECTION — White
══════════════════════════════════════ --}}
<section style="background:#fff;padding:140px 24px;text-align:center;">
    <div style="max-width:860px;margin:0 auto;" class="ap-reveal">
        <p class="ap-eyebrow" style="text-align:center;">Mengapa AutoPrime</p>
        <h2 style="font-size:clamp(32px,5vw,60px);font-weight:700;letter-spacing:-1.5px;line-height:1.1;color:#1d1d1f;margin:0 0 24px;">
            Bukan sekadar showroom.<br>Pengalaman yang berbeda.
        </h2>
        <p class="ap-subline" style="text-align:center;max-width:640px;margin:0 auto;">
            Kami memilih setiap mobil dengan teliti, menawarkan harga yang jujur, dan memastikan proses yang mudah dari pertama kali lihat hingga test drive.
        </p>
    </div>

    {{-- Feature Pills --}}
    <div class="ap-stagger" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:24px;max-width:900px;margin:72px auto 0;">
        <div class="ap-item" style="background:#f5f5f7;border-radius:20px;padding:36px 28px;text-align:left;">
            <div style="width:44px;height:44px;background:#f59e0b;border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:20px;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2.5" stroke-linecap="round"><path d="M9 12l2 2 4-4"/><path d="M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z"/></svg>
            </div>
            <h3 style="font-size:18px;font-weight:700;color:#1d1d1f;margin:0 0 8px;letter-spacing:-0.3px;">Terverifikasi</h3>
            <p style="font-size:14px;color:#6e6e73;line-height:1.6;margin:0;">Setiap kendaraan melewati proses seleksi ketat sebelum masuk koleksi kami.</p>
        </div>
        <div class="ap-item" style="background:#f5f5f7;border-radius:20px;padding:36px 28px;text-align:left;">
            <div style="width:44px;height:44px;background:#f59e0b;border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:20px;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2.5" stroke-linecap="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
            </div>
            <h3 style="font-size:18px;font-weight:700;color:#1d1d1f;margin:0 0 8px;letter-spacing:-0.3px;">Harga Transparan</h3>
            <p style="font-size:14px;color:#6e6e73;line-height:1.6;margin:0;">Tidak ada biaya tersembunyi. Harga yang tertera adalah harga yang Anda bayar.</p>
        </div>
        <div class="ap-item" style="background:#f5f5f7;border-radius:20px;padding:36px 28px;text-align:left;">
            <div style="width:44px;height:44px;background:#f59e0b;border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:20px;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2.5" stroke-linecap="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
            </div>
            <h3 style="font-size:18px;font-weight:700;color:#1d1d1f;margin:0 0 8px;letter-spacing:-0.3px;">Test Drive Mudah</h3>
            <p style="font-size:14px;color:#6e6e73;line-height:1.6;margin:0;">Ajukan test drive langsung dari halaman produk, kami konfirmasi dalam 24 jam.</p>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════
     FEATURED CARS — Light gray
══════════════════════════════════════ --}}
<section style="background:#f5f5f7;padding:120px 24px;">
    <div style="max-width:1120px;margin:0 auto;">

        <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-bottom:64px;" class="ap-reveal">
            <div>
                <p class="ap-eyebrow">Koleksi Pilihan</p>
                <h2 class="ap-headline">Mobil Unggulan.</h2>
            </div>
            <a href="{{ route('cars.index') }}" style="font-size:14px;font-weight:500;color:#f59e0b;text-decoration:none;display:flex;align-items:center;gap:6px;white-space:nowrap;">
                Lihat Semua
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="ap-stagger" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:20px;">
            @forelse($featuredCars as $car)
                <a href="{{ route('cars.show', $car) }}" class="car-card ap-item">
                    <div class="car-card-img">
                        @if($car->primaryImage())
                            <img src="{{ asset('storage/' . $car->primaryImage()->image_path) }}"
                                 alt="{{ $car->name }} {{ $car->model }}" loading="lazy">
                        @else
                            <div style="width:100%;height:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:8px;color:#b0b0b8;">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="7" width="20" height="12" rx="2"/><path d="M7 7V5a2 2 0 012-2h6a2 2 0 012 2v2"/></svg>
                                <span style="font-size:12px;">Belum ada foto</span>
                            </div>
                        @endif
                    </div>
                    <div style="padding:20px 22px 24px;">
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                            <span class="ap-tag ap-tag-amber">{{ $car->brand->name }}</span>
                            @if($car->status === 'sold')
                                <span class="ap-tag ap-tag-red">Terjual</span>
                            @endif
                        </div>
                        <h3 style="font-size:17px;font-weight:700;color:#1d1d1f;margin:0 0 4px;letter-spacing:-0.3px;line-height:1.3;">{{ $car->name }} {{ $car->model }}</h3>
                        <p style="font-size:13px;color:#6e6e73;margin:0 0 14px;">{{ $car->year }} &middot; {{ number_format($car->mileage) }} km &middot; {{ ucfirst($car->transmission) }}</p>
                        <p style="font-size:20px;font-weight:800;color:#1d1d1f;margin:0;letter-spacing:-0.5px;">Rp {{ number_format($car->price, 0, ',', '.') }}</p>
                    </div>
                </a>
            @empty
                <div style="grid-column:1/-1;padding:80px;text-align:center;color:#6e6e73;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="margin:0 auto 16px;display:block;opacity:0.3;"><rect x="2" y="7" width="20" height="12" rx="2"/><path d="M7 7V5a2 2 0 012-2h6a2 2 0 012 2v2"/></svg>
                    <p style="font-size:15px;margin:0;">Belum ada mobil. Tambahkan lewat panel Admin.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════
     STATS — Black
══════════════════════════════════════ --}}
<section style="background:#000;padding:120px 24px;">
    <div style="max-width:1120px;margin:0 auto;">
        <div class="ap-reveal" style="text-align:center;margin-bottom:80px;">
            <p class="ap-eyebrow">Kepercayaan Pelanggan</p>
            <h2 class="ap-headline ap-headline-white">Angka yang<br>bicara sendiri.</h2>
        </div>
        <div class="ap-stagger" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:48px;text-align:center;">
            <div class="ap-item">
                <div class="stat-number"><span class="ap-counter" data-target="500" data-suffix="+">500+</span></div>
                <p class="stat-label">Mobil Tersedia</p>
            </div>
            <div class="ap-item">
                <div class="stat-number"><span class="ap-counter" data-target="1200" data-suffix="+">1.200+</span></div>
                <p class="stat-label">Pelanggan Puas</p>
            </div>
            <div class="ap-item">
                <div class="stat-number"><span class="ap-counter" data-target="50" data-suffix="+">50+</span></div>
                <p class="stat-label">Merek Tersedia</p>
            </div>
            <div class="ap-item">
                <div class="stat-number"><span class="ap-counter" data-target="5" data-suffix=" Tahun">5 Tahun</span></div>
                <p class="stat-label">Pengalaman</p>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════
     CTA — White
══════════════════════════════════════ --}}
<section style="background:#fff;padding:160px 24px;text-align:center;">
    <div style="max-width:720px;margin:0 auto;" class="ap-reveal">
        <p class="ap-eyebrow" style="text-align:center;">Siap Mulai?</p>
        <h2 style="font-size:clamp(36px,6vw,72px);font-weight:800;letter-spacing:-2px;line-height:1.05;color:#1d1d1f;margin:0 0 24px;">
            Mobil impian Anda<br>menunggu di sini.
        </h2>
        <p class="ap-subline" style="max-width:480px;margin:0 auto 48px;text-align:center;">
            Temukan kendaraan yang sempurna dari ribuan pilihan. Mulai perjalanan Anda hari ini.
        </p>
        <div style="display:flex;flex-wrap:wrap;gap:12px;justify-content:center;">
            <a href="{{ route('cars.index') }}" class="ap-btn ap-btn-dark" style="height:52px;padding:0 32px;font-size:16px;">Lihat Koleksi</a>
            @guest
                <a href="{{ route('register') }}" class="ap-btn ap-btn-outline-dark" style="height:52px;padding:0 32px;font-size:16px;">Buat Akun Gratis</a>
            @endguest
        </div>
    </div>
</section>

@endsection
