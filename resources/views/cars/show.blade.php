@extends('layouts.app')
@section('title', $car->name . ' ' . $car->model . ' — AutoPrime')

@section('content')

{{-- ── Back bar ── --}}
<div style="background:#fff;border-bottom:1px solid #e8e8ed;padding:0 24px;">
    <div style="max-width:1120px;margin:0 auto;height:52px;display:flex;align-items:center;">
        <a href="{{ route('cars.index') }}"
           style="display:inline-flex;align-items:center;gap:6px;font-size:13px;color:#6e6e73;text-decoration:none;transition:color 0.2s;"
           onmouseover="this.style.color='#1d1d1f'" onmouseout="this.style.color='#6e6e73'">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Kembali ke Koleksi
        </a>
    </div>
</div>

{{-- ── Hero Product Section ── --}}
<section style="background:#fff;padding:48px 24px 0;">
    <div style="max-width:1120px;margin:0 auto;">
        <div style="text-align:center;margin-bottom:40px;" class="ap-reveal">
            <span class="ap-tag ap-tag-amber" style="margin-bottom:12px;display:inline-block;">{{ $car->brand->name }} &middot; {{ $car->category->name }}</span>
            <h1 style="font-size:clamp(32px,5vw,56px);font-weight:800;letter-spacing:-1.5px;line-height:1.08;color:#1d1d1f;margin:0 0 12px;">
                {{ $car->name }} {{ $car->model }}
            </h1>
            <p style="font-size:clamp(28px,4vw,44px);font-weight:700;color:#f59e0b;margin:0;letter-spacing:-1px;">
                Rp {{ number_format($car->price, 0, ',', '.') }}
            </p>
            @if($car->status === 'sold')
                <span class="ap-tag ap-tag-red" style="margin-top:12px;display:inline-block;font-size:13px;padding:6px 14px;">Mobil ini sudah terjual</span>
            @endif
        </div>
    </div>
</section>

{{-- ── Gallery ── --}}
<section style="background:#fff;padding:0 24px 80px;">
    <div style="max-width:1120px;margin:0 auto;"
         x-data="{
            active: 0,
            images: {{ $car->images->pluck('image_path')->map(fn($p) => asset('storage/'.$p))->toJson() }},
            zoomed: false
         }"
         class="ap-reveal">

        {{-- Main image --}}
        <div class="gallery-main" @click="images.length && (zoomed = true)" :style="images.length ? 'cursor:zoom-in' : ''">
            <template x-if="images.length">
                <img :src="images[active]" :alt="'{{ $car->name }}'" style="width:100%;height:100%;object-fit:cover;transition:transform 0.5s ease;">
            </template>
            <template x-if="!images.length">
                <div style="width:100%;height:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:12px;color:#b0b0b8;">
                    <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><rect x="2" y="7" width="20" height="12" rx="2"/><path d="M7 7V5a2 2 0 012-2h6a2 2 0 012 2v2"/></svg>
                    <span style="font-size:14px;">Belum ada foto</span>
                </div>
            </template>
        </div>

        {{-- Thumbnails --}}
        <div style="display:flex;gap:10px;margin-top:12px;overflow-x:auto;padding-bottom:4px;">
            <template x-for="(img, i) in images" :key="i">
                <button class="gallery-thumb" :class="active === i ? 'active' : ''" @click="active = i">
                    <img :src="img" style="width:100%;height:100%;object-fit:cover;">
                </button>
            </template>
        </div>

        {{-- Lightbox --}}
        <template x-if="zoomed">
            <div @click="zoomed = false"
                 style="position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.92);display:flex;align-items:center;justify-content:center;cursor:zoom-out;padding:24px;">
                <img :src="images[active]" style="max-width:100%;max-height:100%;border-radius:12px;object-fit:contain;">
            </div>
        </template>
    </div>
</section>

{{-- ── Specs + CTA ── --}}
<section style="background:#f5f5f7;padding:80px 24px 120px;">
    <div style="max-width:1120px;margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:start;">

        {{-- Left: Specs --}}
        <div>
            <h2 class="ap-headline" style="margin:0 0 40px;" data-ap-reveal>Spesifikasi.</h2>

            <div class="ap-stagger" style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:48px;">
                <div class="spec-card ap-item">
                    <p class="spec-label">Tahun</p>
                    <p class="spec-value">{{ $car->year }}</p>
                </div>
                <div class="spec-card ap-item">
                    <p class="spec-label">Transmisi</p>
                    <p class="spec-value">{{ ucfirst($car->transmission) }}</p>
                </div>
                <div class="spec-card ap-item">
                    <p class="spec-label">Bahan Bakar</p>
                    <p class="spec-value">{{ ucfirst($car->fuel_type) }}</p>
                </div>
                <div class="spec-card ap-item">
                    <p class="spec-label">Kilometer</p>
                    <p class="spec-value">{{ number_format($car->mileage) }} km</p>
                </div>
            </div>

            @if($car->description)
                <div class="ap-reveal">
                    <h3 style="font-size:16px;font-weight:700;color:#1d1d1f;margin:0 0 12px;">Deskripsi</h3>
                    <p style="font-size:15px;color:#6e6e73;line-height:1.75;margin:0;">{{ $car->description }}</p>
                </div>
            @endif
        </div>

        {{-- Right: CTA / Inquiry --}}
        <div>
            <div style="background:#fff;border-radius:24px;padding:36px;box-shadow:0 4px 40px rgba(0,0,0,0.06);" class="ap-reveal">
                @if($car->status === 'sold')
                    <div style="text-align:center;padding:40px 0;">
                        <div style="width:60px;height:60px;background:#fee2e2;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                        </div>
                        <h3 style="font-size:20px;font-weight:700;color:#dc2626;margin:0 0 8px;">Mobil Sudah Terjual</h3>
                        <p style="font-size:14px;color:#6e6e73;margin:0 0 24px;">Kendaraan ini tidak lagi tersedia. Lihat koleksi lain kami.</p>
                        <a href="{{ route('cars.index') }}" class="ap-btn ap-btn-dark" style="width:100%;justify-content:center;">Lihat Koleksi Lain</a>
                    </div>
                @else
                    <div style="margin-bottom:28px;">
                        <h3 style="font-size:22px;font-weight:700;color:#1d1d1f;margin:0 0 6px;letter-spacing:-0.4px;">Tertarik dengan mobil ini?</h3>
                        <p style="font-size:14px;color:#6e6e73;margin:0;">Isi form di bawah dan kami akan hubungi Anda dalam waktu 24 jam.</p>
                    </div>

                    @if(session('success'))
                        <div style="background:#d1fae5;color:#065f46;padding:14px 18px;border-radius:12px;font-size:14px;margin-bottom:20px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    @guest
                        <div style="background:#f5f5f7;border-radius:16px;padding:20px;text-align:center;margin-bottom:20px;">
                            <p style="font-size:14px;color:#6e6e73;margin:0 0 14px;">Masuk untuk mengajukan inquiry</p>
                            <a href="{{ route('login') }}" class="ap-btn ap-btn-dark" style="width:100%;justify-content:center;">Masuk</a>
                        </div>
                    @endguest

                    <form method="POST" action="{{ route('inquiries.store', $car) }}">
                        @csrf
                        <div style="margin-bottom:16px;">
                            <label class="ap-label">Nomor HP / WhatsApp</label>
                            <input type="text" name="phone" required value="{{ old('phone') }}"
                                   class="ap-input" placeholder="+62 812 xxxx xxxx">
                            @error('phone')
                                <p style="font-size:12px;color:#dc2626;margin:6px 0 0;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div style="margin-bottom:24px;">
                            <label class="ap-label">Pesan <span style="color:#b0b0b8;">(opsional)</span></label>
                            <textarea name="message" rows="3" class="ap-input" placeholder="Contoh: Saya ingin test drive hari Sabtu..."
                                      style="resize:none;line-height:1.6;">{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="ap-btn ap-btn-primary" style="width:100%;justify-content:center;height:52px;font-size:16px;">
                            Kirim Pengajuan
                        </button>
                    </form>

                    <p style="font-size:12px;color:#b0b0b8;text-align:center;margin:16px 0 0;">
                        Kami merespons dalam 24 jam kerja
                    </p>
                @endif
            </div>
        </div>

    </div>
</section>

{{-- ── Responsive fix for mobile ── --}}
<style>
@media (max-width: 768px) {
    section:nth-of-type(4) > div > div {
        grid-template-columns: 1fr !important;
        gap: 40px !important;
    }
}
</style>

@endsection
