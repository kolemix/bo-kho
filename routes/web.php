<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SanPhamController;

// Trang chủ
Route::get('/', [HomeController::class, 'index']);

// Trang Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// Route cho trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('caycanh/theloai/{id}', function ($id) {
    return redirect('/?category_id=' . $id);
});

// --- CÂU 3: CHI TIẾT SẢN PHẨM & GIỎ HÀNG ---
Route::get('/san-pham/{id}', [ProductController::class, 'show'])->name('san-pham.show');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

// --- CÂU 5: TÌM KIẾM (Sửa lỗi POST bằng cách chấp nhận cả GET và POST) ---
Route::match(['get', 'post'], '/timkiem', [ProductController::class, 'search'])->name('san-pham.search');

require __DIR__.'/auth.php';