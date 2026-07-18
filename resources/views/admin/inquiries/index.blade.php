@extends('layouts.admin')
@section('title', 'Inquiry & Test Drive')

@section('content')

<div class="adm-card" style="overflow:hidden;">
    <table class="adm-table">
        <thead>
            <tr>
                <th>Customer</th>
                <th>No. HP</th>
                <th>Kendaraan</th>
                <th>Pesan</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inquiries as $inquiry)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:34px;height:34px;border-radius:50%;background:#f5f5f7;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;color:#6e6e73;flex-shrink:0;">
                                {{ strtoupper(substr($inquiry->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-size:13px;font-weight:600;">{{ $inquiry->user->name }}</div>
                                <div style="font-size:11px;color:#6e6e73;">{{ $inquiry->user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $inquiry->phone) }}" target="_blank"
                           style="font-size:13px;color:#1d1d1f;text-decoration:none;display:flex;align-items:center;gap:4px;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="#10b981" stroke="none"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M11.99 0C5.374 0 .003 5.371.003 11.988c0 2.117.554 4.1 1.523 5.822L.001 24l6.335-1.652a11.956 11.956 0 005.654 1.437C18.606 23.785 24 18.414 24 11.798 24 5.183 18.606 0 11.99 0z"/></svg>
                            {{ $inquiry->phone }}
                        </a>
                    </td>
                    <td>
                        <div style="font-size:13px;font-weight:600;">{{ $inquiry->car->name }}</div>
                        <div style="font-size:11px;color:#6e6e73;">{{ $inquiry->car->model }}</div>
                    </td>
                    <td style="max-width:200px;">
                        <div style="font-size:12px;color:#6e6e73;line-height:1.5;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;">
                            {{ $inquiry->message ?: '—' }}
                        </div>
                    </td>
                    <td>
                        <form action="{{ route('admin.inquiries.update', $inquiry) }}" method="POST">
                            @csrf @method('PUT')
                            <select name="status" onchange="this.form.submit()"
                                    style="height:30px;padding:0 28px 0 10px;border-radius:8px;border:1.5px solid #e8e8ed;font-size:12px;font-weight:600;font-family:inherit;background:#fff;cursor:pointer;outline:none;appearance:none;background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='%236e6e73' stroke-width='2.5'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E\");background-repeat:no-repeat;background-position:right 8px center;">
                                <option value="pending" @selected($inquiry->status === 'pending')>⏳ Pending</option>
                                <option value="contacted" @selected($inquiry->status === 'contacted')>📞 Dihubungi</option>
                                <option value="done" @selected($inquiry->status === 'done')>✓ Selesai</option>
                            </select>
                        </form>
                    </td>
                    <td style="font-size:12px;color:#6e6e73;white-space:nowrap;">
                        {{ $inquiry->created_at->format('d M Y') }}<br>
                        <span style="color:#b0b0b8;">{{ $inquiry->created_at->format('H:i') }}</span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center;padding:60px;color:#b0b0b8;">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="margin:0 auto 12px;display:block;"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                        <div style="font-size:14px;font-weight:600;color:#6e6e73;margin-bottom:4px;">Belum ada inquiry</div>
                        <div style="font-size:13px;">Inquiry dari pelanggan akan muncul di sini.</div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($inquiries->hasPages())
    <div style="margin-top:20px;">{{ $inquiries->links() }}</div>
@endif

@endsection
