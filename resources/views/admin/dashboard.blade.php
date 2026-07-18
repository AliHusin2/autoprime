@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-5">
        <p class="text-sm text-gray-500">Total Mobil</p>
        <p class="text-2xl font-bold">{{ $stats['total_cars'] }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-5">
        <p class="text-sm text-gray-500">Tersedia</p>
        <p class="text-2xl font-bold text-green-600">{{ $stats['available_cars'] }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-5">
        <p class="text-sm text-gray-500">Terjual</p>
        <p class="text-2xl font-bold text-red-600">{{ $stats['sold_cars'] }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-5">
        <p class="text-sm text-gray-500">Inquiry Pending</p>
        <p class="text-2xl font-bold text-amber-600">{{ $stats['pending_inquiries'] }}</p>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm p-5">
    <h2 class="font-semibold mb-4">Inquiry Terbaru</h2>
    <table class="w-full text-sm">
        <thead class="text-left text-gray-500 border-b">
            <tr><th class="pb-2">Customer</th><th class="pb-2">Mobil</th><th class="pb-2">Status</th><th class="pb-2">Tanggal</th></tr>
        </thead>
        <tbody>
            @forelse($latestInquiries as $inquiry)
                <tr class="border-b last:border-0">
                    <td class="py-2">{{ $inquiry->user->name }}</td>
                    <td class="py-2">{{ $inquiry->car->name }} {{ $inquiry->car->model }}</td>
                    <td class="py-2 capitalize">{{ $inquiry->status }}</td>
                    <td class="py-2">{{ $inquiry->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="py-4 text-gray-400 text-center">Belum ada inquiry.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
