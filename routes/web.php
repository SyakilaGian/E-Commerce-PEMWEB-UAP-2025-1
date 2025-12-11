<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardRedirectorController;
use App\Http\Controllers\Admin\AdminVerificationController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\StoreController;
use App\Http\Controllers\Seller\OrderController;
use App\Http\Controllers\Seller\BalanceController;

// --- Root diarahkan ke login ---
Route::get('/', fn() => redirect()->route('login'));

// --- Dashboard universal (redirector berdasarkan role) ---
Route::get('/dashboard', [DashboardRedirectorController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ====================================================================
// --- PROFILE UMUM (USER) ---
// ====================================================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Registrasi Toko (user biasa)
    Route::get('/register-store', [ProfileController::class, 'showStoreRegistrationForm'])
        ->name('store.register.form');
    Route::post('/register-store', [ProfileController::class, 'submitStoreRegistration'])
        ->name('store.register.submit');
});

// --- ADMIN ROUTES ---
Route::middleware(['auth', 'is.admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');

    Route::get('/verification', [AdminVerificationController::class, 'index'])->name('admin.verification.index');
    Route::patch('/verification/{store}/approve', [AdminVerificationController::class, 'approve'])->name('admin.verification.approve');
    Route::delete('/verification/{store}/reject', [AdminVerificationController::class, 'reject'])->name('admin.verification.reject');

    Route::get('/users', [\App\Http\Controllers\Admin\UserManagementController::class, 'index'])->name('admin.users.index');
    Route::delete('/users/{user}', [\App\Http\Controllers\Admin\UserManagementController::class, 'destroy'])->name('admin.users.destroy');
});

// ====================================================================
// --- CUSTOMER / USER ROUTES ---
// ====================================================================
Route::middleware('auth')->prefix('user')->group(function () {
    Route::get('/home', fn() => view('user.home'))->name('user.home');
});

// ====================================================================
// --- SELLER ROUTES ---
// ====================================================================
Route::middleware(['auth', 'is.seller'])->prefix('seller')->group(function () {
    // Dashboard Seller
    Route::get('/dashboard', fn() => view('seller.dashboard'))->name('seller.dashboard');

    // CRUD Produk
    Route::resource('products', ProductController::class)
        ->names('seller.products')
        ->except(['show']);

    // Profil Toko (edit/update untuk seller)
    Route::get('/profile', [StoreController::class, 'edit'])->name('seller.store.edit');
    Route::patch('/profile', [StoreController::class, 'update'])->name('seller.store.update');

    // Pesanan
    Route::resource('orders', OrderController::class)
        ->names('seller.orders')
        ->except(['create', 'store']);

    // Saldo & Withdraw
    Route::get('/balance', [BalanceController::class, 'index'])->name('seller.balance.index');
    Route::get('/withdraw', [BalanceController::class, 'createWithdrawal'])->name('seller.withdraw.form');
    Route::post('/withdraw', [BalanceController::class, 'storeWithdrawal'])->name('seller.withdraw.store');
});

// --- Profil Toko Publik (customer bisa lihat) ---
Route::get('/store/{store}', [StoreController::class, 'show'])->name('store.show');

// --- Auth routes (login, register, forgot password, dll) ---
require __DIR__ . '/auth.php';
