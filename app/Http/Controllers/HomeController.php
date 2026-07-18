<?php

namespace App\Http\Controllers;

use App\Models\Car;

class HomeController extends Controller
{
    /** Homepage: showcase mobil unggulan (FR-03) */
    public function index()
    {
        $featuredCars = Car::with(['brand', 'category', 'images'])
            ->where('is_featured', true)
            ->where('status', 'available')
            ->latest()
            ->take(6)
            ->get();

        // fallback: kalau belum ada yang ditandai featured, tampilkan mobil terbaru
        if ($featuredCars->isEmpty()) {
            $featuredCars = Car::with(['brand', 'category', 'images'])
                ->where('status', 'available')
                ->latest()
                ->take(6)
                ->get();
        }

        return view('home.index', compact('featuredCars'));
    }
}
