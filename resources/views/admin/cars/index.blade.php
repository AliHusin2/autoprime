@extends('layouts.admin')
@section('title', 'Kelola Mobil')

@section('header-actions')
    <a href="{{ route('admin.cars.create') }}" class="adm-btn adm-btn-amber">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Mobil
    </a>
@endsection

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
    <div style="font-size:13px;color:#6e6e73;">
        Menampilkan <strong style="color:#1d1d1f;">{{ $cars->total() }}</strong> kendaraan
    </div>
</div>

<div class="adm-card" style="overflow:hidden;">
    <table class="adm-table">
        <thead>
            <tr>
                <th style="width:60px;">Foto</th>
                <th>Kendaraan</th>
                <th>Brand / Kategori</th>
                <th>Tahun</th>
                <th>Harga</th>
                <th>Status</th>
                <th style="text-align:right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cars as $car)
                <tr>
                    <td>
                        <div style="width:52px;height:40px;border-radius:8px;overflow:hidden;background:#f5f5f7;flex-shrink:0;">
                            @if($car->primaryImage())
                                <img src="{{ asset('storage/' . $car->primaryImage()->image_path) }}"
                                     alt="{{ $car->name }}"
                                     style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#c0c0c8" stroke-width="1.5"><rect x="2" y="8" width="20" height="10" rx="2"/><path d="M6 8V6a2 2 0 012-2h8a2 2 0 012 2v2"/></svg>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div style="font-size:14px;font-weight:600;color:#1d1d1f;">{{ $car->name }}</div>
                        <div style="font-size:12px;color:#6e6e73;">{{ $car->model }} &middot; {{ number_format($car->mileage) }} km &middot; {{ ucfirst($car->transmission) }}</div>
                    </td>
                    <td>
                        <div style="font-size:13px;font-weight:500;">{{ $car->brand->name }}</div>
                        <div style="font-size:12px;color:#6e6e73;">{{ $car->category->name }}</div>
                    </td>
                    <td style="font-size:13px;">{{ $car->year }}</td>
                    <td>
                        <div style="font-size:13px;font-weight:700;color:#1d1d1f;">Rp {{ number_format($car->price, 0, ',', '.') }}</div>
                    </td>
                    <td>
                        @if($car->status === 'available')
                            <span class="badge badge-green">Tersedia</span>
                        @else
                            <span class="badge badge-red">Terjual</span>
                        @endif
                        @if($car->is_featured)
                            <span class="badge badge-amber" style="margin-left:4px;">Unggulan</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex;align-items:center;gap:8px;justify-content:flex-end;">
                            <a href="{{ route('admin.cars.edit', $car) }}" class="adm-btn adm-btn-ghost adm-btn-sm">Edit</a>
                            <form action="{{ route('admin.cars.destroy', $car) }}" method="POST"
                                  onsubmit="return confirm('Hapus {{ $car->name }} {{ $car->model }}?')" style="margin:0;">
                                @csrf @method('DELETE')
                                <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:60px;color:#b0b0b8;">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="margin:0 auto 12px;display:block;"><rect x="2" y="8" width="20" height="10" rx="2"/><path d="M6 8V6a2 2 0 012-2h8a2 2 0 012 2v2"/></svg>
                        <div style="font-size:14px;font-weight:600;color:#6e6e73;margin-bottom:4px;">Belum ada data mobil</div>
                        <div style="font-size:13px;">
                            <a href="{{ route('admin.cars.create') }}" style="color:#f59e0b;text-decoration:none;font-weight:600;">Tambah mobil pertama →</a>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($cars->hasPages())
    <div style="margin-top:20px;">{{ $cars->links() }}</div>
@endif

@endsection
