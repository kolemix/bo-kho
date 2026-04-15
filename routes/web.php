<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SanPhamController;

// Route cho trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('caycanh/theloai/{id}', function ($id) {
    return redirect('/?category_id=' . $id);
});



require __DIR__.'/auth.php';
