@extends('layouts.admin')
@section('title', 'Kelola Brand')

@section('content')
<form method="POST" action="{{ route('admin.brands.store') }}" class="bg-white rounded-xl shadow-sm p-5 mb-6 flex gap-3">
    @csrf
    <input type="text" name="name" placeholder="Nama brand baru (mis. Toyota)" required class="flex-1 rounded-lg border-gray-300 text-sm">
    <button type="submit" class="bg-gray-900 text-white px-5 py-2 rounded-lg text-sm hover:bg-gray-800">Tambah</button>
</form>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left text-gray-500">
            <tr><th class="px-4 py-3">Nama Brand</th><th class="px-4 py-3">Jumlah Mobil</th><th class="px-4 py-3">Aksi</th></tr>
        </thead>
        <tbody>
            @forelse($brands as $brand)
                <tr class="border-b last:border-0">
                    <form action="{{ route('admin.brands.update', $brand) }}" method="POST" class="contents">
                        @csrf @method('PUT')
                        <td class="px-4 py-3"><input type="text" name="name" value="{{ $brand->name }}" class="rounded-lg border-gray-300 text-sm w-full"></td>
                        <td class="px-4 py-3">{{ $brand->cars_count }}</td>
                        <td class="px-4 py-3 space-x-2">
                            <button type="submit" class="text-amber-600 hover:underline">Simpan</button>
                    </form>
                            <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" class="inline" onsubmit="return confirm('Hapus brand ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                </tr>
            @empty
                <tr><td colspan="3" class="px-4 py-6 text-center text-gray-400">Belum ada brand.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $brands->links() }}</div>
@endsection
