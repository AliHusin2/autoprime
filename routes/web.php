<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public / Customer routes (wajib login - lihat middleware 'auth')
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/katalog', [CarController::class, 'index'])->name('cars.index');
    Route::get('/katalog/{car}', [CarController::class, 'show'])->name('cars.show');
    Route::post('/katalog/{car}/inquiry', [InquiryController::class, 'store'])->name('inquiries.store');
});

/*
|--------------------------------------------------------------------------
| Admin routes (wajib login + role admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('cars', AdminCarController::class)->except(['show']);
    Route::delete('cars/images/{image}', [AdminCarController::class, 'destroyImage'])->name('cars.images.destroy');

    Route::get('brands', [BrandController::class, 'index'])->name('brands.index');
    Route::post('brands', [BrandController::class, 'store'])->name('brands.store');
    Route::put('brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
    Route::delete('brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');

    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('inquiries', [AdminInquiryController::class, 'index'])->name('inquiries.index');
    Route::put('inquiries/{inquiry}', [AdminInquiryController::class, 'updateStatus'])->name('inquiries.update');
});

require __DIR__.'/auth.php';
