<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') — AutoPrime Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        html, body { height: 100%; margin: 0; padding: 0; }
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; -webkit-font-smoothing: antialiased; background: #f2f2f7; color: #1d1d1f; display: flex; }

        /* ── SIDEBAR ── */
        #adm-sidebar {
            width: 220px; flex-shrink: 0; background: #0c0c0e;
            display: flex; flex-direction: column;
            position: fixed; top: 0; left: 0; bottom: 0; z-index: 100;
            overflow-y: auto;
        }
        .adm-logo { padding: 24px 20px 20px; border-bottom: 1px solid rgba(255,255,255,0.06); }
        .adm-logo-mark { font-size: 18px; font-weight: 800; color: #fff; letter-spacing: -0.3px; text-decoration: none; display: block; }
        .adm-logo-mark span { color: #f59e0b; }
        .adm-logo-sub { font-size: 10px; font-weight: 500; color: rgba(255,255,255,0.25); letter-spacing: 0.12em; text-transform: uppercase; margin-top: 3px; }
        .adm-nav { padding: 12px 10px; flex: 1; }
        .adm-nav-section { font-size: 10px; font-weight: 600; color: rgba(255,255,255,0.2); letter-spacing: 0.12em; text-transform: uppercase; padding: 12px 10px 6px; }
        .adm-nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 10px; border-radius: 10px; margin-bottom: 2px;
            font-size: 13px; font-weight: 500; color: rgba(255,255,255,0.55);
            text-decoration: none; transition: all 0.18s ease;
            border-left: 2px solid transparent;
        }
        .adm-nav-item:hover { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.85); }
        .adm-nav-item.active { background: rgba(245,158,11,0.1); color: #f59e0b; border-left-color: #f59e0b; }
        .adm-nav-item svg { flex-shrink: 0; opacity: 0.7; }
        .adm-nav-item.active svg { opacity: 1; }
        .adm-sidebar-footer { padding: 16px 10px; border-top: 1px solid rgba(255,255,255,0.06); }
        .adm-user-pill {
            display: flex; align-items: center; gap: 10px; padding: 8px 10px;
            border-radius: 10px; background: rgba(255,255,255,0.04);
        }
        .adm-avatar { width: 32px; height: 32px; border-radius: 50%; background: #f59e0b; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; color: #000; flex-shrink: 0; }
        .adm-username { font-size: 12px; font-weight: 600; color: rgba(255,255,255,0.7); line-height: 1.3; }
        .adm-userrole { font-size: 10px; color: rgba(255,255,255,0.3); }

        /* ── MAIN ── */
        #adm-main { margin-left: 220px; flex: 1; display: flex; flex-direction: column; min-height: 100vh; }
        #adm-header {
            position: sticky; top: 0; z-index: 90;
            background: rgba(242,242,247,0.85); backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0,0,0,0.06);
            padding: 0 32px; height: 56px; display: flex; align-items: center; justify-content: space-between;
        }
        .adm-page-title { font-size: 15px; font-weight: 700; color: #1d1d1f; letter-spacing: -0.2px; }
        .adm-breadcrumb { font-size: 13px; color: #6e6e73; }
        #adm-content { padding: 28px 32px; flex: 1; }

        /* ── CARDS ── */
        .adm-card { background: #fff; border-radius: 16px; border: 1px solid rgba(0,0,0,0.06); }
        .adm-stat-card { padding: 20px 22px; }
        .adm-stat-num { font-size: 36px; font-weight: 800; letter-spacing: -1px; line-height: 1; color: #1d1d1f; margin-bottom: 4px; }
        .adm-stat-label { font-size: 13px; color: #6e6e73; font-weight: 400; }
        .adm-stat-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; }

        /* ── TABLES ── */
        .adm-table { width: 100%; border-collapse: collapse; }
        .adm-table thead th { padding: 12px 16px; font-size: 11px; font-weight: 600; color: #6e6e73; text-transform: uppercase; letter-spacing: 0.08em; text-align: left; border-bottom: 1px solid #e8e8ed; }
        .adm-table tbody td { padding: 14px 16px; font-size: 14px; color: #1d1d1f; border-bottom: 1px solid #f5f5f7; vertical-align: middle; }
        .adm-table tbody tr:last-child td { border-bottom: none; }
        .adm-table tbody tr:hover td { background: #fafafa; }

        /* ── INPUTS ── */
        .adm-input {
            width: 100%; padding: 10px 14px; border: 1.5px solid #e8e8ed;
            border-radius: 10px; font-size: 14px; font-family: inherit; background: #fff;
            color: #1d1d1f; outline: none; transition: border-color 0.2s;
        }
        .adm-input:focus { border-color: #f59e0b; }
        .adm-select { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236e6e73' stroke-width='2.5'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; padding-right: 32px; }
        .adm-label { display: block; font-size: 12px; font-weight: 600; color: #6e6e73; margin-bottom: 6px; letter-spacing: 0.02em; text-transform: uppercase; }
        .adm-textarea { resize: vertical; min-height: 80px; }

        /* ── BADGES ── */
        .badge { display: inline-flex; align-items: center; height: 22px; padding: 0 8px; border-radius: 6px; font-size: 11px; font-weight: 600; letter-spacing: 0.02em; }
        .badge-green { background: #d1fae5; color: #065f46; }
        .badge-red { background: #fee2e2; color: #991b1b; }
        .badge-amber { background: rgba(245,158,11,0.12); color: #92400e; }
        .badge-blue { background: #dbeafe; color: #1e40af; }
        .badge-gray { background: #f3f4f6; color: #374151; }

        /* ── BUTTONS ── */
        .adm-btn { display: inline-flex; align-items: center; gap: 6px; height: 36px; padding: 0 16px; border-radius: 8px; font-size: 13px; font-weight: 600; text-decoration: none; border: none; cursor: pointer; font-family: inherit; transition: all 0.18s; }
        .adm-btn-primary { background: #1d1d1f; color: #fff; }
        .adm-btn-primary:hover { background: #333; }
        .adm-btn-amber { background: #f59e0b; color: #000; }
        .adm-btn-amber:hover { background: #fbbf24; }
        .adm-btn-ghost { background: transparent; color: #6e6e73; border: 1.5px solid #e8e8ed; }
        .adm-btn-ghost:hover { border-color: #1d1d1f; color: #1d1d1f; }
        .adm-btn-danger { background: #fee2e2; color: #991b1b; }
        .adm-btn-danger:hover { background: #fecaca; }
        .adm-btn-sm { height: 30px; padding: 0 12px; font-size: 12px; border-radius: 6px; }

        /* ── TOAST ── */
        .adm-toast { position: fixed; top: 16px; left: 50%; transform: translateX(-50%); z-index: 9999; padding: 12px 20px; border-radius: 12px; font-size: 13px; font-weight: 600; box-shadow: 0 8px 32px rgba(0,0,0,0.12); white-space: nowrap; }
        .adm-toast-success { background: #fff; color: #1d1d1f; border: 1px solid #d1fae5; }
        .adm-toast-success::before { content: '✓'; display: inline-block; width: 20px; height: 20px; background: #10b981; color: white; border-radius: 50%; text-align: center; line-height: 20px; font-size: 11px; margin-right: 10px; }
        .adm-toast-error { background: #fff; color: #1d1d1f; border: 1px solid #fecaca; }
        .adm-toast-error::before { content: '!'; display: inline-block; width: 20px; height: 20px; background: #ef4444; color: white; border-radius: 50%; text-align: center; line-height: 20px; font-size: 12px; font-weight: 800; margin-right: 10px; }

        /* ── MOBILE (basic) ── */
        @media (max-width: 768px) {
            #adm-sidebar { transform: translateX(-100%); transition: transform 0.3s; }
            #adm-sidebar.open { transform: translateX(0); }
            #adm-main { margin-left: 0; }
        }

        /* ── IMAGE UPLOAD PREVIEW ── */
        .img-preview-grid { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 12px; }
        .img-preview-item { position: relative; width: 90px; height: 70px; border-radius: 10px; overflow: hidden; border: 1.5px solid #e8e8ed; }
        .img-preview-item img { width: 100%; height: 100%; object-fit: cover; }
        .img-preview-del { position: absolute; top: 4px; right: 4px; width: 18px; height: 18px; background: rgba(0,0,0,0.65); color: white; border: none; border-radius: 50%; font-size: 11px; cursor: pointer; display: flex; align-items: center; justify-content: center; line-height: 1; }
        .upload-zone { border: 1.5px dashed #d2d2d7; border-radius: 12px; padding: 28px; text-align: center; cursor: pointer; transition: border-color 0.2s, background 0.2s; }
        .upload-zone:hover { border-color: #f59e0b; background: rgba(245,158,11,0.03); }
        .upload-zone input { display: none; }
    </style>
</head>
<body>

<!-- ════ SIDEBAR ════ -->
<aside id="adm-sidebar">
    <div class="adm-logo">
        <a href="{{ route('admin.dashboard') }}" class="adm-logo-mark">Auto<span>Prime</span></a>
        <div class="adm-logo-sub">Admin Panel</div>
    </div>

    <nav class="adm-nav">
        <div class="adm-nav-section">Utama</div>

        <a href="{{ route('admin.dashboard') }}"
           class="adm-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
            Dashboard
        </a>

        <a href="{{ route('admin.cars.index') }}"
           class="adm-nav-item {{ request()->routeIs('admin.cars.*') ? 'active' : '' }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="2" y="8" width="20" height="10" rx="2"/><path d="M6 8V6a2 2 0 012-2h8a2 2 0 012 2v2"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
            Kelola Mobil
        </a>

        <a href="{{ route('admin.inquiries.index') }}"
           class="adm-nav-item {{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
            Inquiry
        </a>

        <div class="adm-nav-section" style="margin-top:8px;">Katalog</div>

        <a href="{{ route('admin.brands.index') }}"
           class="adm-nav-item {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82z"/><circle cx="7" cy="7" r="1"/></svg>
            Brand
        </a>

        <a href="{{ route('admin.categories.index') }}"
           class="adm-nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/></svg>
            Kategori
        </a>

        <div style="height:1px;background:rgba(255,255,255,0.06);margin:12px 0;"></div>

        <a href="{{ route('home') }}" class="adm-nav-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            Lihat Situs
        </a>
    </nav>

    <div class="adm-sidebar-footer">
        <div class="adm-user-pill">
            <div class="adm-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
            <div>
                <div class="adm-username">{{ auth()->user()->name }}</div>
                <div class="adm-userrole">Administrator</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}" style="margin-top:8px;">
            @csrf
            <button type="submit"
                style="width:100%;padding:8px 10px;background:none;border:none;cursor:pointer;font-family:inherit;font-size:12px;color:rgba(255,255,255,0.3);text-align:left;border-radius:8px;transition:color 0.2s;"
                onmouseover="this.style.color='rgba(255,255,255,0.6)'" onmouseout="this.style.color='rgba(255,255,255,0.3)'">
                Keluar
            </button>
        </form>
    </div>
</aside>

<!-- ════ MAIN ════ -->
<div id="adm-main">
    <header id="adm-header">
        <div>
            <div class="adm-page-title">@yield('title', 'Dashboard')</div>
        </div>
        <div style="display:flex;align-items:center;gap:12px;">
            @yield('header-actions')
        </div>
    </header>

    <!-- Toast messages -->
    @if(session('success'))
        <div class="adm-toast adm-toast-success" id="adm-toast">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="adm-toast adm-toast-error" id="adm-toast">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div style="margin:16px 32px 0;padding:14px 18px;background:#fee2e2;border-radius:12px;font-size:13px;color:#991b1b;">
            <div style="font-weight:600;margin-bottom:6px;">Ada kesalahan:</div>
            <ul style="margin:0;padding-left:16px;">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <main id="adm-content">
        @yield('content')
    </main>
</div>

<script>
// Toast auto-hide
const toast = document.getElementById('adm-toast');
if (toast) {
    toast.style.transition = 'opacity 0.4s,transform 0.4s';
    setTimeout(() => { toast.style.opacity = '0'; toast.style.transform = 'translateX(-50%) translateY(-8px)'; setTimeout(() => toast.remove(), 400); }, 3500);
}
</script>
</body>
</html>
