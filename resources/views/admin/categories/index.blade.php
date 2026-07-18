@extends('layouts.admin')
@section('title', 'Kelola Kategori')

@section('content')

<div style="display:grid;grid-template-columns:1fr 2fr;gap:20px;align-items:start;">

    {{-- Add form --}}
    <div class="adm-card" style="padding:24px;">
        <div style="font-size:13px;font-weight:700;color:#1d1d1f;margin-bottom:16px;">Tambah Kategori Baru</div>
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            <div style="margin-bottom:12px;">
                <label class="adm-label">Nama Kategori</label>
                <input type="text" name="name" required class="adm-input" placeholder="cth. SUV, Sedan, MPV, Sport...">
            </div>
            <button type="submit" class="adm-btn adm-btn-primary" style="width:100%;justify-content:center;height:40px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Tambah Kategori
            </button>
        </form>
    </div>

    {{-- List --}}
    <div class="adm-card" style="overflow:hidden;">
        <table class="adm-table">
            <thead>
                <tr>
                    <th>Nama Kategori</th>
                    <th>Jumlah Mobil</th>
                    <th style="text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>
                            <form action="{{ route('admin.categories.update', $category) }}" method="POST" id="cat-form-{{ $category->id }}">
                                @csrf @method('PUT')
                                <input type="text" name="name" value="{{ $category->name }}" class="adm-input" style="max-width:200px;height:34px;padding:6px 12px;">
                            </form>
                        </td>
                        <td>
                            <span class="badge badge-gray">{{ $category->cars_count }} mobil</span>
                        </td>
                        <td>
                            <div style="display:flex;gap:8px;justify-content:flex-end;">
                                <button type="submit" form="cat-form-{{ $category->id }}" class="adm-btn adm-btn-amber adm-btn-sm">Simpan</button>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                      onsubmit="return confirm('Hapus kategori {{ $category->name }}?')" style="margin:0;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align:center;padding:40px;color:#b0b0b8;font-size:13px;">Belum ada kategori. Tambahkan yang pertama.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if($categories->hasPages())
            <div style="padding:16px 20px;border-top:1px solid #f5f5f7;">{{ $categories->links() }}</div>
        @endif
    </div>

</div>

@endsection
