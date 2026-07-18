<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Inquiry;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_cars' => Car::count(),
            'available_cars' => Car::where('status', 'available')->count(),
            'sold_cars' => Car::where('status', 'sold')->count(),
            'pending_inquiries' => Inquiry::where('status', 'pending')->count(),
        ];

        $latestInquiries = Inquiry::with(['user', 'car'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestInquiries'));
    }
}
