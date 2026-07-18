@extends('layouts.app')
@section('title', $car->name)

@section('content')
<section class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 lg:grid-cols-2 gap-10">

    {{-- ============ GALERI FOTO (FR-07) ============ --}}
    <div x-data="{ active: 0, images: {{ $car->images->pluck('image_path')->map(fn($p) => asset('storage/'.$p))->toJson() }} }">
        <div class="aspect-[4/3] bg-gray-200 rounded-2xl overflow-hidden">
            <template x-if="images.length">
                <img :src="images[active]" class="w-full h-full object-cover">
            </template>
            <template x-if="!images.length">
                <div class="w-full h-full flex items-center justify-center text-gray-400">Belum ada foto</div>
            </template>
        </div>
        <div class="flex gap-2 mt-3 overflow-x-auto">
            <template x-for="(img, i) in images" :key="i">
                <button @click="active = i" class="w-20 h-16 rounded-lg overflow-hidden border-2 flex-shrink-0"
                        :class="active === i ? 'border-amber-500' : 'border-transparent'">
                    <img :src="img" class="w-full h-full object-cover">
                </button>
            </template>
        </div>
    </div>

    {{-- ============ SPESIFIKASI & FORM INQUIRY (FR-07, FR-10) ============ --}}
    <div>
        <p class="text-xs uppercase tracking-wide text-amber-600 font-semibold">{{ $car->brand->name }} &middot; {{ $car->category->name }}</p>
        <h1 class="text-3xl font-bold mt-1">{{ $car->name }} {{ $car->model }}</h1>
        <p class="text-2xl font-bold text-gray-900 mt-3">Rp {{ number_format($car->price, 0, ',', '.') }}</p>

        <div class="grid grid-cols-2 gap-4 mt-6 text-sm">
            <div class="bg-white rounded-xl p-4 shadow-sm"><span class="text-gray-500 block">Tahun</span><span class="font-semibold">{{ $car->year }}</span></div>
            <div class="bg-white rounded-xl p-4 shadow-sm"><span class="text-gray-500 block">Transmisi</span><span class="font-semibold">{{ ucfirst($car->transmission) }}</span></div>
            <div class="bg-white rounded-xl p-4 shadow-sm"><span class="text-gray-500 block">Bahan Bakar</span><span class="font-semibold">{{ ucfirst($car->fuel_type) }}</span></div>
            <div class="bg-white rounded-xl p-4 shadow-sm"><span class="text-gray-500 block">Kilometer</span><span class="font-semibold">{{ number_format($car->mileage) }} km</span></div>
        </div>

        @if($car->description)
            <div class="mt-6">
                <h2 class="font-semibold mb-2">Deskripsi</h2>
                <p class="text-gray-600 text-sm leading-relaxed">{{ $car->description }}</p>
            </div>
        @endif

        <div class="mt-8 bg-white rounded-2xl shadow-sm p-6">
            @if($car->status === 'sold')
                <p class="text-red-600 font-semibold">Mobil ini sudah terjual.</p>
            @else
                <h2 class="font-semibold mb-4">Ajukan Test Drive / Inquiry</h2>
                <form method="POST" action="{{ route('inquiries.store', $car) }}" class="space-y-3">
                    @csrf
                    <div>
                        <label class="text-sm text-gray-600">Nomor HP/WhatsApp</label>
                        <input type="text" name="phone" required value="{{ old('phone') }}"
                               class="w-full rounded-lg border-gray-300 text-sm focus:ring-amber-500 focus:border-amber-500">
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Pesan (opsional)</label>
                        <textarea name="message" rows="3"
                                  class="w-full rounded-lg border-gray-300 text-sm focus:ring-amber-500 focus:border-amber-500">{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="w-full bg-amber-500 text-gray-900 font-semibold py-2.5 rounded-lg hover:bg-amber-400 transition-colors">
                        Kirim Pengajuan
                    </button>
                </form>
            @endif
        </div>
    </div>
</section>
@endsection
