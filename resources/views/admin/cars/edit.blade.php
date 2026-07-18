@extends('layouts.admin')
@section('title', 'Edit Mobil')

@section('content')
<form method="POST" action="{{ route('admin.cars.update', $car) }}" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm p-6 max-w-3xl space-y-4">
    @csrf
    @method('PUT')
    @include('admin.cars._form')

    @if($car->images->count())
        <div>
            <label class="text-sm text-gray-600 block mb-2">Foto Saat Ini</label>
            <div class="flex gap-3 flex-wrap">
                @foreach($car->images as $image)
                    <div class="relative w-24 h-20 rounded-lg overflow-hidden border">
                        <img src="{{ asset('storage/' . $image->image_path) }}" class="w-full h-full object-cover">
                        <form action="{{ route('admin.cars.images.destroy', $image) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')"
                              class="absolute top-0 right-0">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white text-xs w-5 h-5 flex items-center justify-center">&times;</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <button type="submit" class="bg-gray-900 text-white px-5 py-2.5 rounded-lg text-sm hover:bg-gray-800">Perbarui Mobil</button>
</form>
@endsection
