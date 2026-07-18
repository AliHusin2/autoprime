@extends('layouts.app')
@section('title', 'Beranda')

@section('content')
{{-- ============ HERO ============ --}}
<section class="relative bg-gray-900 text-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 py-24 relative z-10" data-aos="fade-up">
        <h1 class="text-4xl md:text-5xl font-bold leading-tight max-w-2xl">
            Temukan Mobil Impian Anda di <span class="text-amber-400">AutoPrime</span>
        </h1>
        <p class="mt-4 text-gray-300 max-w-xl">Showroom online dengan koleksi mobil pilihan, harga transparan, dan proses test drive yang mudah.</p>
        <a href="{{ route('cars.index') }}" class="inline-block mt-8 bg-amber-500 text-gray-900 font-semibold px-6 py-3 rounded-full hover:bg-amber-400 transition-colors">
            Lihat Semua Produk &rarr;
        </a>
    </div>
    <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-900/80 to-transparent"></div>
</section>

{{-- ============ SHOWCASE PRODUK UNGGULAN (FR-03) ============ --}}
<section class="max-w-7xl mx-auto px-4 py-16">
    <div class="flex items-center justify-between mb-8" data-aos="fade-up">
        <h2 class="text-2xl font-bold">Mobil Unggulan</h2>
        <a href="{{ route('cars.index') }}" class="text-amber-600 font-medium hover:underline">Lihat Semua Produk &rarr;</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($featuredCars as $i => $car)
            <a href="{{ route('cars.show', $car) }}"
               data-aos="fade-up" data-aos-delay="{{ $i * 80 }}"
               class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-shadow overflow-hidden border border-gray-100">
                <div class="aspect-[4/3] bg-gray-200 overflow-hidden">
                    @if($car->primaryImage())
                        <img src="{{ asset('storage/' . $car->primaryImage()->image_path) }}" alt="{{ $car->name }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">Belum ada foto</div>
                    @endif
                </div>
                <div class="p-4">
                    <p class="text-xs uppercase tracking-wide text-amber-600 font-semibold">{{ $car->brand->name }} &middot; {{ $car->category->name }}</p>
                    <h3 class="font-semibold text-lg mt-1">{{ $car->name }} {{ $car->model }}</h3>
                    <p class="text-sm text-gray-500">{{ $car->year }} &middot; {{ number_format($car->mileage) }} km</p>
                    <p class="mt-2 font-bold text-gray-900">Rp {{ number_format($car->price, 0, ',', '.') }}</p>
                </div>
            </a>
        @empty
            <p class="text-gray-500 col-span-3">Belum ada data mobil. Silakan tambahkan lewat panel Admin.</p>
        @endforelse
    </div>
</section>
@endsection
