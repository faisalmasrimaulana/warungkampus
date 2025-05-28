<?php

use App\Http\Controllers\admin\LoginAdminController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardAdminController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\EditUserController;

//INI MENGATUR SETIAP ROUTE DI WEBSITE INI

// GUEST OR ALL
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/loginadmin', [LoginAdminController::class, 'showLoginAdminForm'])->name('admin.login');

Route::post('/loginadmin', [LoginAdminController::class, 'loginadmin'])->name('admin.login.submit');

Route::get('/register', [RegisController::class, 'showRegisterForm'])->name('user.register');

Route::post('/register', [RegisController::class, 'register'])->name('user.register.store');

Route::get('/detailproduk/{id}', [ProductController::class, 'showDetail'])->name('produk.detail')->whereNumber('id');

Route::get('/daftarproduk', [ProductController::class, 'daftarproduk'])->name('produk.list');

Route::get('/produk/filter', [ProductController::class, 'filter'])->name('produk.filter');

Route::get('/produk/cari', [ProductController::class, 'cari'])->name('produk.cari');

Route::get('/cancel', function(){
    return redirect('/');
})->name('cancel');

// USERS OR MAHASISWA
Route::middleware(['auth:web'])->group(function () {


    Route::get('/dashboard', [DashboardUserController::class, 'showUserProduct'])->name('user.dashboard');

    Route::get('/postingproduk', function(){
        return view('posting');
    })->name('user.post');

    Route::post('/postingproduk', [ProductController::class, 'postProduct'])->name('user.product.posting');

    Route::post('/logout', [LoginController::class, 'logout'])->name('user.logout');

    Route::delete('/produk/{id}', [ProductController::class, 'deleteProduct'])->name('user.product.delete');

    Route::get('/produk/{id}/edit', [ProductController::class, 'editProduct'])->name('user.product.edit');
    Route::put('/produk/{id}', [ProductController::class, 'updateProduct'])->name('user.product.update');
    Route::post('/user/product/{id}/mark-sold', [ProductController::class, 'markAsSold'])->name('user.product.markAsSold');
    Route::get('/user/{id}/edit', [EditUserController::class, 'editUser'])->name('user.edit');
    Route::put('/user/{id}', [EditUserController::class, 'updateUser'])->name('user.update');
    Route::post('/password/update/{id}', [EditUserController::class, 'updatePassword'])->name('user.password.update');
});

// ADMINS
Route::prefix('admin')->name('admin.')->middleware(['auth:admins'])->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');
    Route::get('/kelolaUser', [DashboardAdminController::class, 'kelolaUser'])->name('user.kelola');
    Route::put('/verifikasi/{id}', [DashboardAdminController::class, 'verifikasi'])->name('user.verifikasi');
    Route::delete('/hapus/{id}', [DashboardAdminController::class, 'hapus'])->name('user.hapus');
    Route::post('/logout', [LoginAdminController::class, 'logout'])->name('logout');
});

