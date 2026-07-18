@extends('layouts.admin')
@section('title', 'Edit — ' . $car->name . ' ' . $car->model)

@section('header-actions')
    <a href="{{ route('admin.cars.index') }}" class="adm-btn adm-btn-ghost">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
        Kembali
    </a>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.cars.update', $car) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    @include('admin.cars._form')
</form>

{{-- Existing photos --}}
@if($car->images->count())
<div style="margin-top:24px;">
    <div class="adm-card" style="padding:24px;max-width:calc(100% - 344px);">
        <div style="font-size:13px;font-weight:700;color:#1d1d1f;margin-bottom:16px;padding-bottom:12px;border-bottom:1px solid #f5f5f7;">
            Foto Saat Ini ({{ $car->images->count() }})
        </div>
        <div style="display:flex;flex-wrap:wrap;gap:12px;">
            @foreach($car->images as $image)
                <div style="position:relative;width:120px;height:90px;border-radius:12px;overflow:hidden;border:1px solid #e8e8ed;flex-shrink:0;">
                    <img src="{{ asset('storage/' . $image->image_path) }}"
                         alt="foto" style="width:100%;height:100%;object-fit:cover;">
                    @if($image->is_primary)
                        <div style="position:absolute;bottom:4px;left:4px;background:#f59e0b;color:#000;font-size:9px;font-weight:700;padding:2px 6px;border-radius:4px;letter-spacing:0.05em;">UTAMA</div>
                    @endif
                    <form action="{{ route('admin.cars.images.destroy', $image) }}" method="POST"
                          onsubmit="return confirm('Hapus foto ini?')">
                        @csrf @method('DELETE')
                        <button type="submit"
                            style="position:absolute;top:4px;right:4px;width:22px;height:22px;background:rgba(0,0,0,0.7);color:#fff;border:none;border-radius:50%;font-size:13px;cursor:pointer;display:flex;align-items:center;justify-content:center;line-height:1;">
                            &times;
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

@endsection
