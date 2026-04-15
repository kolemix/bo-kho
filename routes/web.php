<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminSanPhamController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SanPhamController;

// Trang chủ
Route::get('/', [HomeController::class, 'index']);


    //
// Trang Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// Route cho trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('caycanh/theloai/{id}', function ($id) {
    return redirect('/?category_id=' . $id);
});



// Giỏ hàng
Route::get('/gio-hang', [CartController::class, 'index'])->name('cart.index');
Route::post('/gio-hang/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/gio-hang/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

// Đăng ký
Route::post('/register', function (Request $request) {
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect('/login'); // sau khi đăng ký quay về login
})->name('register');

// Đăng nhập
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect('/'); // sau khi đăng nhập quay về home
    }

    return back()->withErrors([
        'email' => 'Thông tin đăng nhập không đúng.',
    ]);
})->name('login');

// Admin routes - không cần middleware auth để tránh conflict với phần các bạn khác làm
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/san-pham',         [AdminSanPhamController::class, 'index'])   ->name('san-pham.index');
    Route::get('/san-pham/create',  [AdminSanPhamController::class, 'create'])  ->name('san-pham.create');
    Route::post('/san-pham',        [AdminSanPhamController::class, 'store'])   ->name('san-pham.store');

    Route::delete('/san-pham/{id}', [AdminSanPhamController::class, 'destroy']) ->name('san-pham.destroy');
});

// Đăng xuất
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/'); // sau khi logout quay về home
})->name('logout');
// --- CÂU 3: CHI TIẾT SẢN PHẨM & GIỎ HÀNG ---
Route::get('/san-pham/{id}', [ProductController::class, 'show'])->name('san-pham.show');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

// --- CÂU 5: TÌM KIẾM (Sửa lỗi POST bằng cách chấp nhận cả GET và POST) ---
Route::match(['get', 'post'], '/timkiem', [ProductController::class, 'search'])->name('san-pham.search');

require __DIR__.'/auth.php';
