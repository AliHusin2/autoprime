<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Car;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun default
        User::create([
            'name' => 'Admin Showroom',
            'email' => 'admin@autoprime.test',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'phone' => '081234567890',
        ]);

        User::create([
            'name' => 'Customer Demo',
            'email' => 'customer@autoprime.test',
            'password' => bcrypt('password'),
            'role' => 'customer',
            'phone' => '081298765432',
        ]);

        // Master data
        $brands = collect(['Toyota', 'Honda', 'Mitsubishi', 'Suzuki', 'Daihatsu'])
            ->map(fn ($name) => Brand::create(['name' => $name]));

        $categories = collect(['SUV', 'Sedan', 'MPV', 'Hatchback', 'Sport'])
            ->map(fn ($name) => Category::create(['name' => $name]));

        // Contoh data mobil (tanpa foto - upload foto dilakukan lewat panel admin)
        $samples = [
            ['Toyota', 'SUV', 'Fortuner', 'GR Sport', 2023, 585000000, true],
            ['Toyota', 'MPV', 'Avanza', 'Veloz', 2022, 235000000, true],
            ['Honda', 'Sedan', 'Civic', 'RS Turbo', 2023, 555000000, true],
            ['Honda', 'Hatchback', 'Brio', 'RS', 2022, 195000000, false],
            ['Mitsubishi', 'SUV', 'Pajero Sport', 'Dakar', 2023, 620000000, true],
            ['Suzuki', 'MPV', 'Ertiga', 'GX', 2022, 245000000, false],
            ['Daihatsu', 'Hatchback', 'Sirion', 'X', 2021, 175000000, false],
            ['Toyota', 'Sport', 'GR86', 'Standard', 2023, 750000000, true],
        ];

        foreach ($samples as [$brandName, $categoryName, $name, $model, $year, $price, $featured]) {
            Car::create([
                'brand_id' => $brands->firstWhere('name', $brandName)->id,
                'category_id' => $categories->firstWhere('name', $categoryName)->id,
                'name' => $name,
                'model' => $model,
                'year' => $year,
                'price' => $price,
                'transmission' => 'automatic',
                'fuel_type' => 'bensin',
                'mileage' => rand(0, 20000),
                'description' => "{$name} {$model} tahun {$year}, kondisi prima, siap pakai.",
                'status' => 'available',
                'is_featured' => $featured,
            ]);
        }
    }
}
