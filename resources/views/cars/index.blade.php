@extends('layouts.app')
@section('title', 'Koleksi — AutoPrime')

@section('content')

{{-- Page hero --}}
<section style="background:#000;padding:140px 24px 80px;">
    <div style="max-width:1120px;margin:0 auto;" class="ap-reveal">
        <p class="ap-eyebrow">Katalog Kendaraan</p>
        <h1 class="ap-headline ap-headline-white">Semua Koleksi.</h1>
        <p class="ap-subline" style="margin-top:16px;max-width:500px;">
            {{ $cars->total() }} kendaraan tersedia. Filter dan temukan yang paling sesuai.
        </p>
    </div>
</section>

{{-- Filter bar --}}
<section style="background:#fff;border-bottom:1px solid #e8e8ed;position:sticky;top:60px;z-index:100;">
    <form method="GET" action="{{ route('cars.index') }}" style="max-width:1120px;margin:0 auto;padding:16px 24px;display:flex;flex-wrap:wrap;gap:10px;align-items:center;">
        <div style="flex:1;min-width:180px;position:relative;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#6e6e73" stroke-width="2" stroke-linecap="round"
                 style="position:absolute;left:12px;top:50%;transform:translateY(-50%);">
                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
            </svg>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama atau model..."
                   style="width:100%;height:38px;padding:0 16px 0 36px;border-radius:20px;border:1.5px solid #e8e8ed;font-size:13px;font-family:inherit;background:#fff;outline:none;"
                   onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='#e8e8ed'">
        </div>

        <select name="brand_id" class="filter-pill">
            <option value="">Semua Brand</option>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}" @selected(request('brand_id') == $brand->id)>{{ $brand->name }}</option>
            @endforeach
        </select>

        <select name="category_id" class="filter-pill">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @selected(request('category_id') == $cat->id)>{{ $cat->name }}</option>
            @endforeach
        </select>

        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Harga min"
               class="filter-pill" style="width:120px;">
        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Harga max"
               class="filter-pill" style="width:120px;">

        <button type="submit" class="ap-btn ap-btn-primary" style="height:38px;padding:0 20px;font-size:13px;">Terapkan</button>
        @if(request()->anyFilled(['q','brand_id','category_id','min_price','max_price']))
            <a href="{{ route('cars.index') }}" class="ap-btn ap-btn-outline-dark" style="height:38px;padding:0 16px;font-size:13px;">Reset</a>
        @endif
    </form>
</section>

{{-- Grid --}}
<section style="background:#f5f5f7;padding:64px 24px 120px;">
    <div style="max-width:1120px;margin:0 auto;">

        @if($cars->isEmpty())
            <div style="text-align:center;padding:120px 24px;color:#6e6e73;" class="ap-reveal">
                <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="margin:0 auto 20px;display:block;opacity:0.25;"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                <h3 style="font-size:22px;font-weight:700;color:#1d1d1f;margin:0 0 8px;">Tidak ada hasil</h3>
                <p style="margin:0;font-size:15px;">Coba ubah filter pencarian Anda.</p>
            </div>
        @else
            <div class="ap-stagger" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(290px,1fr));gap:20px;">
                @foreach($cars as $car)
                    <a href="{{ route('cars.show', $car) }}" class="car-card ap-item">
                        <div class="car-card-img" style="position:relative;">
                            @if($car->primaryImage())
                                <img src="{{ asset('storage/' . $car->primaryImage()->image_path) }}"
                                     alt="{{ $car->name }}" loading="lazy">
                            @else
                                <div style="width:100%;height:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:8px;color:#b0b0b8;">
                                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="7" width="20" height="12" rx="2"/><path d="M7 7V5a2 2 0 012-2h6a2 2 0 012 2v2"/></svg>
                                    <span style="font-size:11px;">Belum ada foto</span>
                                </div>
                            @endif
                            @if($car->status === 'sold')
                                <div style="position:absolute;top:12px;left:12px;">
                                    <span class="ap-tag ap-tag-red">Terjual</span>
                                </div>
                            @endif
                        </div>
                        <div style="padding:18px 20px 22px;">
                            <span class="ap-tag ap-tag-amber">{{ $car->brand->name }} &middot; {{ $car->category->name }}</span>
                            <h3 style="font-size:16px;font-weight:700;color:#1d1d1f;margin:8px 0 4px;letter-spacing:-0.2px;line-height:1.3;">{{ $car->name }} {{ $car->model }}</h3>
                            <p style="font-size:12px;color:#6e6e73;margin:0 0 12px;">{{ $car->year }} &middot; {{ number_format($car->mileage) }} km &middot; {{ ucfirst($car->transmission) }}</p>
                            <p style="font-size:19px;font-weight:800;color:#1d1d1f;margin:0;letter-spacing:-0.4px;">Rp {{ number_format($car->price, 0, ',', '.') }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div style="margin-top:60px;" class="ap-reveal">
                {{ $cars->links() }}
            </div>
        @endif
    </div>
</section>

@endsection
