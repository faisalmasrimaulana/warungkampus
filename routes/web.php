<?php

use App\Http\Controllers\admin\LoginAdminController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardAdminController;

//INI MENGATUR SETIAP ROUTE DI WEBSITE INI

Route::get('/', function () {
    return view('home');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/regis', [RegisController::class, 'showRegisterForm'])->name('register');

Route::post('/regis', [RegisController::class, 'register'])->name('register.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});

Route::get('/cancel', function(){
    return redirect('/');
})->name('cancel');

Route::get('/loginadmin', [LoginAdminController::class, 'showLoginAdminForm'])->name('loginadmin');

Route::post('/loginadmin', [LoginAdminController::class, 'loginadmin'])->name('loginadmin.submit');

Route::middleware(['auth:admins'])->group(function () {
    Route::get('/dashboardadmin', [DashboardAdminController::class, 'index'])->name('dashboardadmin');
    Route::get('/admin/verifikasi-user', [DashboardAdminController::class, 'showUnverifiedUsers'])->name('admin.verifikasi-user');
    Route::put('/admin/verifikasi/{id}', [DashboardAdminController::class, 'verifikasi'])->name('admin.verifikasi');
    Route::delete('/admin/hapus/{id}', [DashboardAdminController::class, 'hapus'])->name('admin.hapus');
});

Route::post('/logoutadmin', [LoginAdminController::class, 'logout'])->name('logoutadmin');