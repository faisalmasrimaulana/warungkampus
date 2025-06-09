<?php

use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardAdminController;
use App\Http\Controllers\Admin\ManageController;
use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\EditUserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MidtransWebhookController;
use App\Models\Product;

//INI MENGATUR SETIAP ROUTE DI WEBSITE INI

// =======================
// ROUTE UNTUK TANPA AUTENTIKASI
// =======================

//REGULAR
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/cancel', function(){
    return redirect('/');
})->name('cancel');

Route::get('/bantuan', function(){
    return view('user.bantuan');
})->name('bantuan');

Route::get('/userprofile/{user}', [DashboardUserController::class, 'showPublic'])->name('user.publicprofile');

// AUTH
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/loginadmin', [AdminAuthController::class, 'showLoginAdminForm'])->name('admin.login');

Route::post('/loginadmin', [AdminAuthController::class, 'loginAdmin'])->name('admin.login.submit');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('user.register');

Route::post('/register', [RegisterController::class, 'register'])->name('user.register.store');

//PRODUCT
Route::get('/detailproduk/{product}', [ProductController::class, 'show'])->name('produk.detail')->whereNumber('product');

Route::get('/daftarproduk', [ProductController::class, 'index'])->name('produk.list');

Route::get('/produk/filter', [ProductController::class, 'filter'])->name('produk.filter');

Route::get('/produk/cari', [ProductController::class, 'cari'])->name('produk.cari');

// PAYMENT
Route::post('/checkout', [PaymentController::class, 'process'])->name('payment.process');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');

// =======================
// ROUTE UNTUK USER/MAHASISWA
// =======================
Route::middleware(['auth:web'])->group(function () {
    Route::get('/dashboard', [DashboardUserController::class, 'index'])->name('user.dashboard');

    Route::get('/postingproduk', function(){
        return view('product.posting');
    })->name('user.post');

    Route::post('/postingproduk', [ProductController::class, 'store'])->name('user.product.posting');

    Route::post('/logout', [LoginController::class, 'logout'])->name('user.logout');

    Route::delete('/produk/{product}', [ProductController::class, 'destroy'])->name('user.product.delete');

    Route::get('/produk/{product}/edit', [ProductController::class, 'edit'])->name('user.product.edit');
    Route::put('/produk/{product}', [ProductController::class, 'update'])->name('user.product.update');
    Route::post('/user/product/{product}/mark-sold', [ProductController::class, 'markAsSold'])->name('user.product.markAsSold');
    Route::post('/product/{product}/unmark', [ProductController::class, 'unmarkAsSold'])->name('user.product.unmarkAsSold');

    Route::get('/user/edit/{user}', [EditUserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{user}', [EditUserController::class, 'update'])->name('user.update');
    Route::put('/password/update/{user}', [EditUserController::class, 'updatePassword'])->name('user.password.update');

    Route::get('/produksubscribe', [ProductController::class , 'modalProduk'])->name('user.langganan');
    Route::post('/weekly-subscription-process', [PaymentController::class, 'weeklySubscriptionProcess']);
    Route::get('/weeklysub/success', [PaymentController::class, 'weeklySubSuccess'])->name('weeklysub.success');
    Route::post('/monthly-subscription-process', [PaymentController::class, 'monthlySubscriptionProcess']);
    Route::get('/monthlysub/success', [PaymentController::class, 'monthlySubSuccess'])->name('monthlysub.success');
});

// =======================
// ROUTE UNTUK ADMIN
// =======================
Route::prefix('admin')->name('admin.')->middleware(['auth:admins'])->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/kelolaUser', [DashboardAdminController::class, 'kelolaUser'])->name('user.kelola');
    Route::get('/kelolaPostingan', [DashboardAdminController::class, 'kelolaPostingan'])->name('product.kelola');
    Route::put('/verifikasi/{user}', [DashboardAdminController::class, 'verifikasi'])->name('user.verifikasi');
    Route::put('/blokir/{user}', [DashboardAdminController::class, 'block'])->name('user.blokir');
    Route::put('/bukablokir/{user}', [DashboardAdminController::class, 'unblock'])->name('user.bukablokir');
    Route::delete('/hapus/{user}', [DashboardAdminController::class, 'destroy'])->name('user.hapus');
    Route::get('/produk/filter', [ManageController::class, 'filterProduct'])->name('product.filter');
    Route::get('/user/filter', [ManageController::class, 'filterUser'])->name('user.filter');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::delete('/produkdelete/{product}', [ProductController::class, 'destroy'])->name('product.delete');
});

