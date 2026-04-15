<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    //return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

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

// Đăng xuất
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/'); // sau khi logout quay về home
})->name('logout');
