@extends('layouts.admin')
@section('title', 'Inquiry / Test Drive')

@section('content')
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left text-gray-500">
            <tr>
                <th class="px-4 py-3">Customer</th>
                <th class="px-4 py-3">No. HP</th>
                <th class="px-4 py-3">Mobil</th>
                <th class="px-4 py-3">Pesan</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inquiries as $inquiry)
                <tr class="border-b last:border-0 align-top">
                    <td class="px-4 py-3">{{ $inquiry->user->name }}</td>
                    <td class="px-4 py-3">{{ $inquiry->phone }}</td>
                    <td class="px-4 py-3">{{ $inquiry->car->name }} {{ $inquiry->car->model }}</td>
                    <td class="px-4 py-3 max-w-xs">{{ $inquiry->message ?: '-' }}</td>
                    <td class="px-4 py-3">
                        <form action="{{ route('admin.inquiries.update', $inquiry) }}" method="POST">
                            @csrf @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="rounded-lg border-gray-300 text-xs">
                                <option value="pending" @selected($inquiry->status === 'pending')>Pending</option>
                                <option value="contacted" @selected($inquiry->status === 'contacted')>Dihubungi</option>
                                <option value="done" @selected($inquiry->status === 'done')>Selesai</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $inquiry->created_at->format('d M Y H:i') }}</td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-4 py-6 text-center text-gray-400">Belum ada inquiry.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $inquiries->links() }}</div>
@endsection
