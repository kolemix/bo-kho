<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminSanPhamController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    //
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin routes - không cần middleware auth để tránh conflict với phần các bạn khác làm
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/san-pham',         [AdminSanPhamController::class, 'index'])   ->name('san-pham.index');
    Route::get('/san-pham/create',  [AdminSanPhamController::class, 'create'])  ->name('san-pham.create');
    Route::post('/san-pham',        [AdminSanPhamController::class, 'store'])   ->name('san-pham.store');

    Route::delete('/san-pham/{id}', [AdminSanPhamController::class, 'destroy']) ->name('san-pham.destroy');
});
require __DIR__.'/auth.php';