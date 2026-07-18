<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'AutoPrime') — Showroom Mobil</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts: Inter (SF Pro-like) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ──────────── BASE ──────────── */
        *, *::before, *::after { box-sizing: border-box; }
        html { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
        body { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; background: #fff; color: #1d1d1f; }

        /* ──────────── NAVBAR ──────────── */
        #main-nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 9000;
            padding: 0 max(24px, env(safe-area-inset-left));
            height: 60px; display: flex; align-items: center;
            background: transparent;
            transition: background 0.4s ease, backdrop-filter 0.4s ease, box-shadow 0.4s ease;
        }
        #main-nav.nav-scrolled {
            background: rgba(0,0,0,0.75);
            backdrop-filter: saturate(180%) blur(20px);
            -webkit-backdrop-filter: saturate(180%) blur(20px);
            box-shadow: 0 1px 0 rgba(255,255,255,0.08);
        }
        .nav-inner { width: 100%; max-width: 1120px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; gap: 32px; }
        .nav-logo { font-size: 18px; font-weight: 700; color: #fff; letter-spacing: -0.3px; text-decoration: none; transition: opacity 0.2s; }
        .nav-logo:hover { opacity: 0.75; }
        .nav-logo span { color: #f59e0b; }
        .nav-links { display: flex; align-items: center; gap: 28px; list-style: none; margin: 0; padding: 0; }
        .nav-links a { font-size: 13px; font-weight: 400; color: rgba(255,255,255,0.85); text-decoration: none; letter-spacing: 0; transition: color 0.2s; }
        .nav-links a:hover { color: #fff; }
        .nav-badge {
            display: inline-flex; align-items: center; justify-content: center;
            height: 30px; padding: 0 14px; border-radius: 20px;
            background: #f59e0b; color: #000; font-size: 12px; font-weight: 600;
            text-decoration: none; transition: opacity 0.2s;
        }
        .nav-badge:hover { opacity: 0.85; }
        .nav-hamburger { display: none; background: none; border: none; cursor: pointer; color: #fff; padding: 4px; }
        @media (max-width: 767px) {
            .nav-links { display: none; }
            .nav-hamburger { display: block; }
        }

        /* ──────────── MOBILE MENU ──────────── */
        #mobile-menu {
            display: none; position: fixed; inset: 0; z-index: 8999;
            background: rgba(0,0,0,0.96); backdrop-filter: blur(20px);
            flex-direction: column; align-items: center; justify-content: center; gap: 32px;
        }
        #mobile-menu.open { display: flex; }
        #mobile-menu a { font-size: 28px; font-weight: 700; color: #fff; text-decoration: none; letter-spacing: -0.5px; }
        #mobile-menu a:hover { color: #f59e0b; }
        #mobile-menu-close { position: absolute; top: 20px; right: 24px; background: none; border: none; color: #fff; cursor: pointer; font-size: 24px; }

        /* ──────────── APPLE BUTTONS ──────────── */
        .ap-btn {
            display: inline-flex; align-items: center; justify-content: center;
            height: 44px; padding: 0 24px; border-radius: 30px;
            font-size: 14px; font-weight: 500; text-decoration: none; transition: all 0.2s ease; cursor: pointer; border: none;
        }
        .ap-btn-primary { background: #f59e0b; color: #000; }
        .ap-btn-primary:hover { background: #fbbf24; transform: scale(1.02); }
        .ap-btn-dark { background: #1d1d1f; color: #fff; }
        .ap-btn-dark:hover { background: #333; transform: scale(1.02); }
        .ap-btn-outline { background: transparent; color: #fff; border: 1.5px solid rgba(255,255,255,0.35); }
        .ap-btn-outline:hover { border-color: #fff; background: rgba(255,255,255,0.08); }
        .ap-btn-outline-dark { background: transparent; color: #1d1d1f; border: 1.5px solid rgba(29,29,31,0.35); }
        .ap-btn-outline-dark:hover { border-color: #1d1d1f; background: rgba(29,29,31,0.05); }

        /* ──────────── REVEAL HELPERS ──────────── */
        .ap-clip { overflow: hidden; }
        .ap-reveal, .ap-item { will-change: transform, opacity; }

        /* ──────────── FORM INPUTS ──────────── */
        .ap-input {
            width: 100%; padding: 12px 16px; border: 1.5px solid #d2d2d7;
            border-radius: 12px; font-size: 15px; font-family: inherit;
            background: #fff; color: #1d1d1f; outline: none;
            transition: border-color 0.2s;
        }
        .ap-input:focus { border-color: #f59e0b; }
        .ap-label { display: block; font-size: 13px; font-weight: 500; color: #6e6e73; margin-bottom: 6px; }

        /* ──────────── CARD ──────────── */
        .car-card {
            background: #fff; border-radius: 18px; overflow: hidden;
            border: 1px solid #e8e8ed; text-decoration: none; display: block;
            transition: transform 0.35s cubic-bezier(.25,.46,.45,.94), box-shadow 0.35s cubic-bezier(.25,.46,.45,.94);
        }
        .car-card:hover { transform: translateY(-6px); box-shadow: 0 20px 60px rgba(0,0,0,0.12); }
        .car-card-img { aspect-ratio: 4/3; overflow: hidden; background: #f5f5f7; }
        .car-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .car-card:hover .car-card-img img { transform: scale(1.04); }

        /* ──────────── FOOTER ──────────── */
        #main-footer {
            background: #000; color: #6e6e73; font-size: 12px;
            padding: 40px max(24px, env(safe-area-inset-left));
            border-top: 1px solid #1d1d1f;
        }
        #main-footer .footer-inner { max-width: 1120px; margin: 0 auto; display: flex; flex-direction: column; gap: 16px; }
        #main-footer a { color: #6e6e73; text-decoration: none; }
        #main-footer a:hover { color: #fff; }

        /* ──────────── SECTION HELPERS ──────────── */
        .ap-section { padding: 120px max(24px, env(safe-area-inset-left)); }
        .ap-container { max-width: 1120px; margin: 0 auto; }
        .ap-eyebrow { font-size: 12px; font-weight: 600; letter-spacing: 0.15em; text-transform: uppercase; color: #f59e0b; margin-bottom: 16px; }
        .ap-headline { font-size: clamp(36px, 5vw, 64px); font-weight: 700; letter-spacing: -1.5px; line-height: 1.08; color: #1d1d1f; }
        .ap-headline-white { color: #fff; }
        .ap-subline { font-size: clamp(17px, 2vw, 21px); font-weight: 400; line-height: 1.6; color: #6e6e73; }
        .ap-divider { width: 48px; height: 3px; background: #f59e0b; border-radius: 3px; margin-bottom: 24px; }

        /* ──────────── BADGE ──────────── */
        .ap-tag { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase; }
        .ap-tag-amber { background: rgba(245,158,11,0.12); color: #d97706; }
        .ap-tag-red { background: rgba(239,68,68,0.1); color: #dc2626; }

        /* ──────────── NOTIFICATION TOAST ──────────── */
        .ap-toast { position: fixed; top: 80px; left: 50%; transform: translateX(-50%); z-index: 9999; padding: 12px 20px; border-radius: 12px; font-size: 14px; font-weight: 500; }
        .ap-toast-success { background: #d1fae5; color: #065f46; }
        .ap-toast-error { background: #fee2e2; color: #991b1b; }

        /* ──────────── SPEC GRID ──────────── */
        .spec-card { background: #f5f5f7; border-radius: 16px; padding: 20px 24px; }
        .spec-label { font-size: 12px; color: #6e6e73; font-weight: 500; letter-spacing: 0.02em; }
        .spec-value { font-size: 20px; font-weight: 700; color: #1d1d1f; margin-top: 4px; letter-spacing: -0.3px; }

        /* ──────────── GALLERY ──────────── */
        .gallery-main { aspect-ratio: 16/10; border-radius: 20px; overflow: hidden; background: #f5f5f7; }
        .gallery-main img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease; }
        .gallery-thumb { width: 80px; height: 60px; border-radius: 10px; overflow: hidden; border: 2px solid transparent; cursor: pointer; flex-shrink: 0; transition: border-color 0.2s; }
        .gallery-thumb.active { border-color: #f59e0b; }
        .gallery-thumb img { width: 100%; height: 100%; object-fit: cover; }

        /* ──────────── SCROLL LINE ANIMATION ──────────── */
        @keyframes scrollLine { 0%,100%{transform:scaleY(0);transform-origin:top;} 45%{transform:scaleY(1);transform-origin:top;} 55%{transform:scaleY(1);transform-origin:bottom;} 100%{transform:scaleY(0);transform-origin:bottom;} }
        .scroll-line { animation: scrollLine 2s ease-in-out infinite; }

        /* ──────────── HERO ──────────── */
        .hero-bg-orb {
            position: absolute; border-radius: 50%; pointer-events: none;
            background: radial-gradient(circle, rgba(245,158,11,0.18) 0%, transparent 70%);
        }
        @keyframes float { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-24px);} }

        /* ──────────── STATS ──────────── */
        .stat-number { font-size: clamp(42px, 6vw, 72px); font-weight: 800; letter-spacing: -2px; line-height: 1; color: #fff; }
        .stat-label { font-size: 14px; color: #6e6e73; margin-top: 6px; font-weight: 400; }

        /* ──────────── FILTER ──────────── */
        .filter-pill {
            height: 38px; padding: 0 16px; border-radius: 20px; border: 1.5px solid #e8e8ed;
            font-size: 13px; font-family: inherit; background: #fff; color: #1d1d1f; outline: none; cursor: pointer; transition: border-color 0.2s;
        }
        .filter-pill:focus { border-color: #f59e0b; }
        .filter-search {
            height: 38px; padding: 0 16px; border-radius: 20px; border: 1.5px solid #e8e8ed;
            font-size: 13px; font-family: inherit; background: #fff; color: #1d1d1f; outline: none; transition: border-color 0.2s; width: 100%;
        }
        .filter-search:focus { border-color: #f59e0b; }
    </style>
</head>
<body>

{{-- ════ NAVBAR ════ --}}
<nav id="main-nav">
    <div class="nav-inner">
        <a href="{{ route('home') }}" class="nav-logo">Auto<span>Prime</span></a>

        <ul class="nav-links">
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li><a href="{{ route('cars.index') }}">Koleksi</a></li>
            @auth
                @if(auth()->user()->isAdmin())
                    <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                @endif
                <li
                    x-data="{ open: false }"
                    @click.outside="open = false"
                    class="relative"
                    style="list-style:none"
                >
                    <button @click="open = !open"
                        style="background:none;border:none;cursor:pointer;display:flex;align-items:center;gap:6px;font-size:13px;color:rgba(255,255,255,0.85);font-family:inherit;padding:0;">
                        {{ auth()->user()->name }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 20 20" fill="currentColor"
                             :style="open ? 'transform:rotate(180deg)' : ''" style="transition:transform 0.2s">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                    <div x-show="open" x-transition
                         style="position:absolute;right:0;top:calc(100% + 8px);min-width:160px;background:#1d1d1f;border-radius:14px;overflow:hidden;box-shadow:0 20px 40px rgba(0,0,0,0.5);display:none;">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                style="width:100%;text-align:left;padding:14px 18px;font-size:13px;color:rgba(255,255,255,0.8);background:none;border:none;cursor:pointer;font-family:inherit;">
                                Keluar
                            </button>
                        </form>
                    </div>
                </li>
            @else
                <li><a href="{{ route('login') }}">Masuk</a></li>
                <li><a href="{{ route('register') }}" class="nav-badge">Daftar</a></li>
            @endauth
        </ul>

        <button class="nav-hamburger" onclick="document.getElementById('mobile-menu').classList.add('open')" aria-label="Menu">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
        </button>
    </div>
</nav>

{{-- ════ MOBILE MENU ════ --}}
<div id="mobile-menu">
    <button id="mobile-menu-close" onclick="document.getElementById('mobile-menu').classList.remove('open')" aria-label="Tutup">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
    </button>
    <a href="{{ route('home') }}" onclick="document.getElementById('mobile-menu').classList.remove('open')">Beranda</a>
    <a href="{{ route('cars.index') }}" onclick="document.getElementById('mobile-menu').classList.remove('open')">Koleksi</a>
    @auth
        @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}">Admin</a>
        @endif
        <form method="POST" action="{{ route('logout') }}" style="margin:0">
            @csrf
            <button type="submit" style="background:none;border:none;cursor:pointer;font-size:28px;font-weight:700;color:#fff;font-family:inherit;">Keluar</button>
        </form>
    @else
        <a href="{{ route('login') }}">Masuk</a>
        <a href="{{ route('register') }}" style="color:#f59e0b !important;">Daftar</a>
    @endauth
</div>

{{-- ════ TOAST MESSAGES ════ --}}
@if(session('success'))
    <div class="ap-toast ap-toast-success" id="ap-toast">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="ap-toast ap-toast-error" id="ap-toast">{{ session('error') }}</div>
@endif

<main>
    @yield('content')
</main>

<footer id="main-footer">
    <div class="footer-inner">
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
            <span style="font-size:13px;font-weight:700;color:#fff;">Auto<span style="color:#f59e0b;">Prime</span></span>
            <div style="display:flex;gap:20px;">
                <a href="{{ route('home') }}">Beranda</a>
                <a href="{{ route('cars.index') }}">Koleksi</a>
                @guest
                    <a href="{{ route('login') }}">Masuk</a>
                @endguest
            </div>
        </div>
        <p style="margin:0;">&copy; {{ date('Y') }} AutoPrime Showroom. Hak cipta dilindungi.</p>
    </div>
</footer>

<!-- GSAP -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

<script>
(function() {
    gsap.registerPlugin(ScrollTrigger);

    // ── NAVBAR SCROLL ──
    const nav = document.getElementById('main-nav');
    if (nav) {
        ScrollTrigger.create({
            start: 'top -60',
            onEnter: () => nav.classList.add('nav-scrolled'),
            onLeaveBack: () => nav.classList.remove('nav-scrolled')
        });
    }

    // ── TOAST AUTO-HIDE ──
    const toast = document.getElementById('ap-toast');
    if (toast) {
        gsap.from(toast, { y: -20, opacity: 0, duration: 0.5, ease: 'power3.out' });
        gsap.to(toast, { opacity: 0, y: -10, delay: 3.5, duration: 0.4, onComplete: () => toast.remove() });
    }

    // ── SCROLL REVEALS ──
    gsap.utils.toArray('.ap-reveal').forEach(el => {
        gsap.from(el, {
            scrollTrigger: { trigger: el, start: 'top 90%' },
            y: 40, opacity: 0, duration: 0.9, ease: 'power3.out'
        });
    });

    gsap.utils.toArray('.ap-stagger').forEach(container => {
        const items = container.querySelectorAll('.ap-item');
        if (!items.length) return;
        gsap.from(items, {
            scrollTrigger: { trigger: container, start: 'top 88%' },
            y: 50, opacity: 0, duration: 0.85, ease: 'power3.out', stagger: 0.1
        });
    });

    // ── HERO (if present) ──
    const heroLines = document.querySelectorAll('.hero-line');
    const heroEyebrow = document.querySelector('.hero-eyebrow');
    const heroSub = document.querySelector('.hero-sub');
    const heroCta = document.querySelector('.hero-cta');
    const heroScroll = document.querySelector('.hero-scroll');

    if (heroLines.length) {
        gsap.set(heroLines, { yPercent: 105 });
        if (heroEyebrow) gsap.set(heroEyebrow, { opacity: 0, y: 12 });
        if (heroSub) gsap.set(heroSub, { opacity: 0, y: 20 });
        if (heroCta) gsap.set(heroCta, { opacity: 0, y: 16 });
        if (heroScroll) gsap.set(heroScroll, { opacity: 0 });

        const tl = gsap.timeline({ delay: 0.15 });
        if (heroEyebrow) tl.to(heroEyebrow, { opacity: 1, y: 0, duration: 0.7, ease: 'power3.out' }, 0);
        tl.to(heroLines, { yPercent: 0, duration: 1.1, ease: 'power4.out', stagger: 0.11 }, 0.2);
        if (heroSub) tl.to(heroSub, { opacity: 1, y: 0, duration: 0.9, ease: 'power3.out' }, 0.75);
        if (heroCta) tl.to(heroCta, { opacity: 1, y: 0, duration: 0.8, ease: 'power3.out' }, 0.95);
        if (heroScroll) tl.to(heroScroll, { opacity: 1, duration: 0.6 }, 1.2);
    }

    // ── STAT COUNTERS ──
    document.querySelectorAll('.ap-counter').forEach(el => {
        const target = parseFloat(el.dataset.target);
        const suffix = el.dataset.suffix || '';
        gsap.from({ val: 0 }, {
            scrollTrigger: { trigger: el, start: 'top 85%' },
            val: target, duration: 1.8, ease: 'power2.out',
            onUpdate: function() { el.textContent = Math.floor(this.targets()[0].val).toLocaleString('id') + suffix; }
        });
    });
})();
</script>

</body>
</html>
