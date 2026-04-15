<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminSanPhamController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

// ==================== TRANG CHỦ ====================
Route::get('/', [HomeController::class, 'index'])->name('home');

// Lọc theo danh mục
Route::get('caycanh/theloai/{id}', [HomeController::class, 'filterByCategory'])->name('category.filter');

// ==================== CHI TIẾT SẢN PHẨM ====================
Route::get('/san-pham/{id}', [ProductController::class, 'show'])->name('san-pham.show');

// ==================== TÌM KIẾM ====================
Route::match(['get', 'post'], '/timkiem', [ProductController::class, 'search'])->name('san-pham.search');

// ==================== GIỎ HÀNG ====================
Route::get('/gio-hang', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

// ==================== ĐĂNG KÝ ====================
Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Sau khi đăng ký quay về trang đăng nhập
    return redirect('/login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
})->name('register');

// ==================== ĐĂNG NHẬP ====================
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        // Sau khi đăng nhập quay về trang chủ
        return redirect('/')->with('success', 'Đăng nhập thành công!');
    }

    return back()->withErrors([
        'email' => 'Thông tin đăng nhập không đúng.',
    ]);
})->name('login');

// ==================== ĐĂNG XUẤT ====================
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/')->with('success', 'Đã đăng xuất!');
})->name('logout');

// ==================== ADMIN ====================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/san-pham', [AdminSanPhamController::class, 'index'])->name('san-pham.index');
    Route::get('/san-pham/create', [AdminSanPhamController::class, 'create'])->name('san-pham.create');
Route::post('/san-pham', [AdminSanPhamController::class, 'store'])->name('san-pham.store');
    Route::delete('/san-pham/{id}', [AdminSanPhamController::class, 'destroy'])->name('san-pham.destroy');
});

require __DIR__.'/auth.php';
