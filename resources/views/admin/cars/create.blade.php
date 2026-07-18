@extends('layouts.admin')
@section('title', 'Tambah Mobil')

@section('header-actions')
    <a href="{{ route('admin.cars.index') }}" class="adm-btn adm-btn-ghost">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
        Kembali
    </a>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.cars.store') }}" enctype="multipart/form-data">
    @csrf
    @include('admin.cars._form')
</form>
@endsection
