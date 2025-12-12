<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{slug}', [HomeController::class, 'filterCategory'])->name('front.category');
Route::get('/product/{slug}', [HomeController::class, 'details'])->name('front.details');
Route::get('/store/{slug}', [HomeController::class, 'store'])->name('front.store');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [HomeController::class, 'processCheckout'])->name('checkout.process');

    Route::get('/wallet/topup', [HomeController::class, 'topup'])->name('front.topup');
    Route::post('/wallet/topup', [HomeController::class, 'postTopup'])->name('front.topup.post');

    Route::get('/payment', [HomeController::class, 'payment'])->name('front.payment');
    Route::post('/payment', [HomeController::class, 'paymentPost'])->name('front.payment.post');

    Route::get('/my-orders', [HomeController::class, 'orders'])->name('front.orders');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================
// ROUTE KHUSUS ADMIN
// ==========================
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return "Halaman Admin Dashboard";
    })->name('admin.dashboard');
});

require __DIR__.'/auth.php';