<?php

use Illuminate\Support\Facades\Route;
use App\Enum\Identity\IdentityRole;
use App\Enum\Customer\CustomerProfileType;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Customer\CustomerProfileController;
use App\Http\Controllers\Customer\PersonalProfile\CustomerPersonalDashboardController;
use App\Http\Controllers\Customer\PersonalProfile\CustomerPersonalProfileController;


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
    Route::get('/', [CustomerProfileController::class, 'index'])->name('customer.index');
    // Gestione profili
    Route::get('/profile/select', [CustomerProfileController::class, 'select'])->name('customer.profile.select');
    // Area customer personal
    Route::middleware([
        'customer.personal.profile'
    ])->group(function () {
        Route::get('/profile/personal/create', [CustomerPersonalProfileController::class, 'create_personal_profile'])->name('customer.personal.profile.create');
        Route::post('/profile/personal/store', [CustomerPersonalProfileController::class, 'store_personal_profile'])->name('customer.personal.profile.store');
    });
    // Area con contesto customer attivo
    Route::middleware([
        'customer.profile.exists',
        'customer.profile.active',
    ])->group(function () {
        Route::middleware([
            'customer.profile.type:' . CustomerProfileType::personal->name,
        ])->group(function () {
            Route::get('/dashboard/personal/profile', [CustomerPersonalDashboardController::class, 'index_personal_profile'])->name('customer.dashboard.personal');
            Route::get('/dashboard/personal/profile-info', [CustomerPersonalDashboardController::class, 'show_personal_info'])->name('customer.dashboard.info.personal');
            Route::get('/dashboard/personal/addresses', [CustomerPersonalDashboardController::class, 'show_personal_addresses'])->name('customer.dashboard.addresses.personal');
        });
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
