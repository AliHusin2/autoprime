<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /** CRUD master data brand oleh Admin (FR-09) */
    public function index()
    {
        $brands = Brand::withCount('cars')->orderBy('name')->paginate(10);

        return view('admin.brands.index', compact('brands'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:255', 'unique:brands,name']]);

        Brand::create($data);

        return back()->with('success', 'Brand berhasil ditambahkan.');
    }

    public function update(Request $request, Brand $brand)
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:255', 'unique:brands,name,' . $brand->id]]);

        $brand->update($data);

        return back()->with('success', 'Brand berhasil diperbarui.');
    }

    public function destroy(Brand $brand)
    {
        if ($brand->cars()->exists()) {
            return back()->with('error', 'Brand tidak bisa dihapus karena masih memiliki data mobil.');
        }

        $brand->delete();

        return back()->with('success', 'Brand berhasil dihapus.');
    }
}
