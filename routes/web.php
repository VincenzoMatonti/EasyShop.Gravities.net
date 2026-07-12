<?php

use App\Enum\Identity\IdentityRole;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Customer\CustomerProfileController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;


/// ========================
// PUBLIC
// ========================
Route::get('/', [PublicController::class, 'index'])->name('home.index');


// ========================
// CUSTOMER PROFILE
// ========================
Route::middleware([
    'auth',
    'role:' . IdentityRole::CUSTOMER->value,
])->prefix('customer')->group(function () {
    // Entry point customer
    Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
    // Gestione profili
    Route::get('/profile/select', [CustomerProfileController::class, 'select'])->name('customer.profile.select');
    // Area customer personal
    Route::middleware([
        'customer.personal.profile'
    ])->group(function () {
        Route::get('/profile/personal/create', [CustomerProfileController::class, 'create_personal_profile'])->name('customer.personal.profile.create');
        Route::post('/profile/personal/store', [CustomerProfileController::class, 'store_personal_profile'])->name('customer.personal.profile.store');
    });
    // Area con contesto customer attivo
    Route::middleware([
        'customer.profile.exists',
        'customer.profile.active',
    ])->group(function () {
        Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
    });
});

// ========================
// MANAGER
// ========================
Route::middleware([
    'auth',
    'role:' . IdentityRole::MANAGER->value
])->group(function () {
    Route::get('/manager', [ManagerController::class, 'index'])->name('manager.index');
});

// ========================
// ADMIN
// ========================
Route::middleware([
    'auth',
    'role:' . IdentityRole::ADMIN->value
])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});
