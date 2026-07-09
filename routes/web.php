<?php

use App\Enum\Identity\IdentityRole;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Customer\CustomerProfileController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// rotte pubbliche
Route::get('/', [PublicController::class, 'index'])->name('home.index');

// rotte customer
Route::middleware([
    'auth',
    'role:' . IdentityRole::CUSTOMER->value,
])
    ->prefix('customer/profile')
    ->group(function () {
        Route::get('/create', [CustomerProfileController::class, 'create'])->name('customer.profile.create');
        Route::get('/select', [CustomerProfileController::class, 'select'])->name('customer.profile.select');
    });

Route::middleware([
    'auth',
    'role:' . IdentityRole::CUSTOMER->value,
    'customer.profile.exists',
    'customer.profile.active',
])
    ->prefix('customer')
    ->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
        Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
    });

// rotte manager
Route::middleware([
    'auth',
    'role:' . IdentityRole::MANAGER->value
])->group(function () {
    Route::get('/manager', [ManagerController::class, 'index'])->name('manager.index');
});

// rotte admin
Route::middleware([
    'auth',
    'role:' . IdentityRole::ADMIN->value
])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});
