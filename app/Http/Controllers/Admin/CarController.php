<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarRequest;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarImage;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /** CRUD data mobil oleh Admin (FR-08) */
    public function index()
    {
        $cars = Car::with(['brand', 'category'])->latest()->paginate(10);

        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        $brands = Brand::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('admin.cars.create', compact('brands', 'categories'));
    }

    public function store(StoreCarRequest $request)
    {
        $car = Car::create($request->safe()->except('images'));

        $this->storeImages($request, $car);

        return redirect()->route('admin.cars.index')->with('success', 'Data mobil berhasil ditambahkan.');
    }

    public function edit(Car $car)
    {
        $car->load('images');
        $brands = Brand::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('admin.cars.edit', compact('car', 'brands', 'categories'));
    }

    public function update(StoreCarRequest $request, Car $car)
    {
        $car->update($request->safe()->except('images'));

        $this->storeImages($request, $car);

        return redirect()->route('admin.cars.index')->with('success', 'Data mobil berhasil diperbarui.');
    }

    public function destroy(Car $car)
    {
        foreach ($car->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $car->delete();

        return back()->with('success', 'Data mobil berhasil dihapus.');
    }

    public function destroyImage(CarImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $carId = $image->car_id;
        $image->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }

    private function storeImages(StoreCarRequest $request, Car $car): void
    {
        if (! $request->hasFile('images')) {
            return;
        }

        $hasPrimary = $car->images()->where('is_primary', true)->exists();

        foreach ($request->file('images') as $index => $file) {
            $path = $file->store('cars', 'public');

            CarImage::create([
                'car_id' => $car->id,
                'image_path' => $path,
                'is_primary' => ! $hasPrimary && $index === 0,
            ]);
        }
    }
}
