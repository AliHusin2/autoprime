@extends('layouts.admin')
@section('title', 'Tambah Mobil')

@section('content')
<form method="POST" action="{{ route('admin.cars.store') }}" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm p-6 max-w-3xl space-y-4">
    @csrf
    @include('admin.cars._form')
    <button type="submit" class="bg-gray-900 text-white px-5 py-2.5 rounded-lg text-sm hover:bg-gray-800">Simpan Mobil</button>
</form>
@endsection
