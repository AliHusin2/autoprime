@extends('layouts.app')
@section('title', 'Semua Produk')

@section('content')
<section class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-2xl font-bold mb-6" data-aos="fade-up">Katalog Mobil</h1>

    {{-- ============ FILTER & PENCARIAN (FR-06) ============ --}}
    <form method="GET" action="{{ route('cars.index') }}" class="bg-white rounded-2xl shadow-sm p-5 mb-8 grid grid-cols-1 md:grid-cols-6 gap-3">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama/model..."
               class="md:col-span-2 rounded-lg border-gray-300 text-sm focus:ring-amber-500 focus:border-amber-500">

        <select name="brand_id" class="rounded-lg border-gray-300 text-sm focus:ring-amber-500 focus:border-amber-500">
            <option value="">Semua Brand</option>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}" @selected(request('brand_id') == $brand->id)>{{ $brand->name }}</option>
            @endforeach
        </select>

        <select name="category_id" class="rounded-lg border-gray-300 text-sm focus:ring-amber-500 focus:border-amber-500">
            <option value="">Semua Kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>

        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Harga min"
               class="rounded-lg border-gray-300 text-sm focus:ring-amber-500 focus:border-amber-500">
        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Harga max"
               class="rounded-lg border-gray-300 text-sm focus:ring-amber-500 focus:border-amber-500">

        <div class="md:col-span-6 flex gap-2">
            <button type="submit" class="bg-gray-900 text-white px-5 py-2 rounded-lg text-sm hover:bg-gray-800">Terapkan Filter</button>
            <a href="{{ route('cars.index') }}" class="px-5 py-2 rounded-lg text-sm border border-gray-300 hover:bg-gray-50">Reset</a>
        </div>
    </form>

    {{-- ============ GRID KATALOG (FR-05) ============ --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($cars as $i => $car)
            <a href="{{ route('cars.show', $car) }}"
               data-aos="fade-up" data-aos-delay="{{ ($i % 3) * 80 }}"
               class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-shadow overflow-hidden border border-gray-100">
                <div class="aspect-[4/3] bg-gray-200 overflow-hidden">
                    @if($car->primaryImage())
                        <img src="{{ asset('storage/' . $car->primaryImage()->image_path) }}" alt="{{ $car->name }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">Belum ada foto</div>
                    @endif
                    @if($car->status === 'sold')
                        <span class="absolute mt-2 ml-2 bg-red-600 text-white text-xs px-2 py-1 rounded">Terjual</span>
                    @endif
                </div>
                <div class="p-4">
                    <p class="text-xs uppercase tracking-wide text-amber-600 font-semibold">{{ $car->brand->name }} &middot; {{ $car->category->name }}</p>
                    <h3 class="font-semibold text-lg mt-1">{{ $car->name }} {{ $car->model }}</h3>
                    <p class="text-sm text-gray-500">{{ $car->year }} &middot; {{ number_format($car->mileage) }} km &middot; {{ ucfirst($car->transmission) }}</p>
                    <p class="mt-2 font-bold text-gray-900">Rp {{ number_format($car->price, 0, ',', '.') }}</p>
                </div>
            </a>
        @empty
            <p class="text-gray-500 col-span-3">Tidak ada mobil yang cocok dengan filter.</p>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $cars->links() }}
    </div>
</section>
@endsection
