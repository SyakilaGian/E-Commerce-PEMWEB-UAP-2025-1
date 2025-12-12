<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/category/{slug}', [HomeController::class, 'filterCategory'])->name('front.category');
Route::get('/product/{slug}', [HomeController::class, 'details'])->name('front.details');

Route::get('/checkout', [HomeController::class, 'checkout'])
    ->middleware(['auth', 'verified'])
    ->name('checkout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// ==========================
// ROUTE USER LOGIN (PROFILE)
// ==========================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/wallet/topup', [HomeController::class, 'topup'])->name('front.topup');
    Route::post('/wallet/topup', [HomeController::class, 'postTopup'])->name('front.topup.post');

    Route::get('/payment', [HomeController::class, 'payment'])->name('front.payment');
    Route::post('/payment', [HomeController::class, 'paymentPost'])->name('front.payment.post');
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

