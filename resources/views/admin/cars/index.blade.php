@extends('layouts.admin')
@section('title', 'Kelola Mobil')

@section('content')
<div class="flex justify-between items-center mb-4">
    <p class="text-sm text-gray-500">Total {{ $cars->total() }} mobil</p>
    <a href="{{ route('admin.cars.create') }}" class="bg-gray-900 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-800">+ Tambah Mobil</a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left text-gray-500">
            <tr>
                <th class="px-4 py-3">Nama</th>
                <th class="px-4 py-3">Brand</th>
                <th class="px-4 py-3">Kategori</th>
                <th class="px-4 py-3">Tahun</th>
                <th class="px-4 py-3">Harga</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cars as $car)
                <tr class="border-b last:border-0">
                    <td class="px-4 py-3 font-medium">{{ $car->name }} {{ $car->model }}</td>
                    <td class="px-4 py-3">{{ $car->brand->name }}</td>
                    <td class="px-4 py-3">{{ $car->category->name }}</td>
                    <td class="px-4 py-3">{{ $car->year }}</td>
                    <td class="px-4 py-3">Rp {{ number_format($car->price, 0, ',', '.') }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded text-xs {{ $car->status === 'available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $car->status === 'available' ? 'Tersedia' : 'Terjual' }}
                        </span>
                    </td>
                    <td class="px-4 py-3 space-x-2 whitespace-nowrap">
                        <a href="{{ route('admin.cars.edit', $car) }}" class="text-amber-600 hover:underline">Edit</a>
                        <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data mobil ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="px-4 py-6 text-center text-gray-400">Belum ada data mobil.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $cars->links() }}</div>
@endsection
