@extends('layouts.admin')
@section('title', 'Kelola Brand')

@section('content')

<div style="display:grid;grid-template-columns:1fr 2fr;gap:20px;align-items:start;">

    {{-- Add form --}}
    <div class="adm-card" style="padding:24px;">
        <div style="font-size:13px;font-weight:700;color:#1d1d1f;margin-bottom:16px;">Tambah Brand Baru</div>
        <form method="POST" action="{{ route('admin.brands.store') }}">
            @csrf
            <div style="margin-bottom:12px;">
                <label class="adm-label">Nama Brand</label>
                <input type="text" name="name" required class="adm-input" placeholder="cth. Toyota, BMW, Honda...">
            </div>
            <button type="submit" class="adm-btn adm-btn-primary" style="width:100%;justify-content:center;height:40px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Tambah Brand
            </button>
        </form>
    </div>

    {{-- List --}}
    <div class="adm-card" style="overflow:hidden;">
        <table class="adm-table">
            <thead>
                <tr>
                    <th>Nama Brand</th>
                    <th>Jumlah Mobil</th>
                    <th style="text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($brands as $brand)
                    <tr>
                        <td>
                            <form action="{{ route('admin.brands.update', $brand) }}" method="POST" id="brand-form-{{ $brand->id }}">
                                @csrf @method('PUT')
                                <input type="text" name="name" value="{{ $brand->name }}" class="adm-input" style="max-width:200px;height:34px;padding:6px 12px;">
                            </form>
                        </td>
                        <td>
                            <span class="badge badge-gray">{{ $brand->cars_count }} mobil</span>
                        </td>
                        <td>
                            <div style="display:flex;gap:8px;justify-content:flex-end;">
                                <button type="submit" form="brand-form-{{ $brand->id }}" class="adm-btn adm-btn-amber adm-btn-sm">Simpan</button>
                                <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST"
                                      onsubmit="return confirm('Hapus brand {{ $brand->name }}? Ini akan mempengaruhi {{ $brand->cars_count }} mobil.')" style="margin:0;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align:center;padding:40px;color:#b0b0b8;font-size:13px;">Belum ada brand. Tambahkan yang pertama.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if($brands->hasPages())
            <div style="padding:16px 20px;border-top:1px solid #f5f5f7;">{{ $brands->links() }}</div>
        @endif
    </div>

</div>

@endsection
