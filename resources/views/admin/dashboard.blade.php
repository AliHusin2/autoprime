@extends('layouts.admin')
@section('title', 'Dashboard')

@section('header-actions')
    <a href="{{ route('admin.cars.create') }}" class="adm-btn adm-btn-amber">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Mobil
    </a>
@endsection

@section('content')

{{-- ── Stat Cards ── --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;">

    <div class="adm-card adm-stat-card" style="border-top:3px solid #1d1d1f;">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:16px;">
            <div class="adm-stat-icon" style="background:#f5f5f7;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1d1d1f" stroke-width="2" stroke-linecap="round"><rect x="2" y="8" width="20" height="10" rx="2"/><path d="M6 8V6a2 2 0 012-2h8a2 2 0 012 2v2"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
            </div>
        </div>
        <div class="adm-stat-num">{{ $stats['total_cars'] }}</div>
        <div class="adm-stat-label">Total Mobil</div>
    </div>

    <div class="adm-card adm-stat-card" style="border-top:3px solid #10b981;">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:16px;">
            <div class="adm-stat-icon" style="background:#d1fae5;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="9"/></svg>
            </div>
        </div>
        <div class="adm-stat-num" style="color:#065f46;">{{ $stats['available_cars'] }}</div>
        <div class="adm-stat-label">Tersedia</div>
    </div>

    <div class="adm-card adm-stat-card" style="border-top:3px solid #ef4444;">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:16px;">
            <div class="adm-stat-icon" style="background:#fee2e2;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="9"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
            </div>
        </div>
        <div class="adm-stat-num" style="color:#991b1b;">{{ $stats['sold_cars'] }}</div>
        <div class="adm-stat-label">Terjual</div>
    </div>

    <div class="adm-card adm-stat-card" style="border-top:3px solid #f59e0b;">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:16px;">
            <div class="adm-stat-icon" style="background:rgba(245,158,11,0.1);">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2" stroke-linecap="round"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
            </div>
        </div>
        <div class="adm-stat-num" style="color:#92400e;">{{ $stats['pending_inquiries'] }}</div>
        <div class="adm-stat-label">Inquiry Pending</div>
    </div>

</div>

{{-- ── Bottom Row ── --}}
<div style="display:grid;grid-template-columns:1fr 320px;gap:16px;align-items:start;">

    {{-- Recent Inquiries --}}
    <div class="adm-card" style="overflow:hidden;">
        <div style="padding:18px 20px;border-bottom:1px solid #f5f5f7;display:flex;align-items:center;justify-content:space-between;">
            <div>
                <div style="font-size:14px;font-weight:700;color:#1d1d1f;">Inquiry Terbaru</div>
                <div style="font-size:12px;color:#6e6e73;margin-top:1px;">{{ count($latestInquiries) }} entri terbaru</div>
            </div>
            <a href="{{ route('admin.inquiries.index') }}" style="font-size:12px;color:#f59e0b;text-decoration:none;font-weight:600;">Lihat Semua →</a>
        </div>
        <table class="adm-table">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Mobil</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($latestInquiries as $inquiry)
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div style="width:30px;height:30px;border-radius:50%;background:#f5f5f7;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:#6e6e73;flex-shrink:0;">
                                    {{ strtoupper(substr($inquiry->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div style="font-size:13px;font-weight:600;">{{ $inquiry->user->name }}</div>
                                    <div style="font-size:11px;color:#6e6e73;">{{ $inquiry->phone }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="font-size:13px;">{{ $inquiry->car->name }} {{ $inquiry->car->model }}</td>
                        <td>
                            @if($inquiry->status === 'pending')
                                <span class="badge badge-amber">Pending</span>
                            @elseif($inquiry->status === 'contacted')
                                <span class="badge badge-blue">Dihubungi</span>
                            @else
                                <span class="badge badge-green">Selesai</span>
                            @endif
                        </td>
                        <td style="font-size:12px;color:#6e6e73;white-space:nowrap;">{{ $inquiry->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center;padding:40px;color:#b0b0b8;">
                            <div style="font-size:13px;">Belum ada inquiry masuk.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Quick Actions --}}
    <div style="display:flex;flex-direction:column;gap:16px;">
        <div class="adm-card" style="padding:20px;">
            <div style="font-size:13px;font-weight:700;color:#1d1d1f;margin-bottom:14px;">Aksi Cepat</div>
            <div style="display:flex;flex-direction:column;gap:8px;">
                <a href="{{ route('admin.cars.create') }}" class="adm-btn adm-btn-primary" style="width:100%;justify-content:center;height:40px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Tambah Mobil Baru
                </a>
                <a href="{{ route('admin.inquiries.index') }}" class="adm-btn adm-btn-ghost" style="width:100%;justify-content:center;height:40px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                    Kelola Inquiry
                </a>
                <a href="{{ route('admin.brands.index') }}" class="adm-btn adm-btn-ghost" style="width:100%;justify-content:center;height:40px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82z"/><circle cx="7" cy="7" r="1"/></svg>
                    Kelola Brand
                </a>
            </div>
        </div>

        <div class="adm-card" style="padding:20px;background:#0c0c0e;border-color:#1d1d1f;">
            <div style="font-size:11px;font-weight:600;color:#f59e0b;letter-spacing:0.1em;text-transform:uppercase;margin-bottom:10px;">Ringkasan</div>
            <div style="display:flex;flex-direction:column;gap:10px;">
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:13px;color:rgba(255,255,255,0.5);">Tersedia</span>
                    <span style="font-size:13px;font-weight:700;color:#10b981;">{{ $stats['available_cars'] }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:13px;color:rgba(255,255,255,0.5);">Terjual</span>
                    <span style="font-size:13px;font-weight:700;color:#ef4444;">{{ $stats['sold_cars'] }}</span>
                </div>
                <div style="height:1px;background:rgba(255,255,255,0.06);"></div>
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:13px;color:rgba(255,255,255,0.5);">Conversion Rate</span>
                    <span style="font-size:13px;font-weight:700;color:#fff;">
                        {{ $stats['total_cars'] > 0 ? round(($stats['sold_cars'] / $stats['total_cars']) * 100) : 0 }}%
                    </span>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
