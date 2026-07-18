<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use App\Models\Category;

class CarController extends Controller
{
    /** Katalog / lihat semua produk + filter & search (FR-05, FR-06) */
    public function index()
    {
        $cars = Car::with(['brand', 'category', 'images'])
            ->filter(request()->only(['brand_id', 'category_id', 'min_price', 'max_price', 'year', 'q']))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $brands = Brand::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('cars.index', compact('cars', 'brands', 'categories'));
    }

    /** Detail mobil (FR-07) */
    public function show(Car $car)
    {
        $car->load(['brand', 'category', 'images']);

        return view('cars.show', compact('car'));
    }
}
