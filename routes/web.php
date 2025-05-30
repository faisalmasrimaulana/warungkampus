<?php

use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardAdminController;
use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\EditUserController;

//INI MENGATUR SETIAP ROUTE DI WEBSITE INI

// =======================
// ROUTE UNTUK TANPA AUTENTIKASI
// =======================
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/loginadmin', [AdminAuthController::class, 'showLoginAdminForm'])->name('admin.login');

Route::post('/loginadmin', [AdminAuthController::class, 'loginAdmin'])->name('admin.login.submit');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('user.register');

Route::post('/register', [RegisterController::class, 'register'])->name('user.register.store');

Route::get('/detailproduk/{id}', [ProductController::class, 'show'])->name('produk.detail')->whereNumber('id');

Route::get('/daftarproduk', [ProductController::class, 'index'])->name('produk.list');

Route::get('/produk/filter', [ProductController::class, 'filter'])->name('produk.filter');

Route::get('/produk/cari', [ProductController::class, 'cari'])->name('produk.cari');

Route::get('/cancel', function(){
    return redirect('/');
})->name('cancel');

// =======================
// ROUTE UNTUK USER/MAHASISWA
// =======================
Route::middleware(['auth:web'])->group(function () {
    Route::get('/dashboard', [DashboardUserController::class, 'index'])->name('user.dashboard');

    Route::get('/postingproduk', function(){
        return view('posting');
    })->name('user.post');

    Route::get('langganan', function(){
        return view('user.langganan');
    })->name('user.langganan');

    Route::post('/postingproduk', [ProductController::class, 'store'])->name('user.product.posting');

    Route::post('/logout', [LoginController::class, 'logout'])->name('user.logout');

    Route::delete('/produk/{id}', [ProductController::class, 'destroy'])->name('user.product.delete');

    Route::get('/produk/{id}/edit', [ProductController::class, 'edit'])->name('user.product.edit');
    Route::put('/produk/{id}', [ProductController::class, 'update'])->name('user.product.update');
    Route::post('/user/product/{id}/mark-sold', [ProductController::class, 'markAsSold'])->name('user.product.markAsSold');

    Route::get('/user/{user}/edit', [EditUserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{user}', [EditUserController::class, 'update'])->name('user.update');
    Route::put('/password/update/{user}', [EditUserController::class, 'updatePassword'])->name('user.password.update');
});

// =======================
// ROUTE UNTUK ADMIN
// =======================
Route::prefix('admin')->name('admin.')->middleware(['auth:admins'])->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/kelolaUser', [DashboardAdminController::class, 'kelolaUser'])->name('user.kelola');
    Route::put('/verifikasi/{user}', [DashboardAdminController::class, 'verifikasi'])->name('user.verifikasi');
    Route::delete('/hapus/{user}', [DashboardAdminController::class, 'destroy'])->name('user.hapus');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

