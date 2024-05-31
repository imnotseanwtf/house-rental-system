<?php

use App\Http\Controllers\HouseController;
use App\Http\Controllers\HouseTypeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\TenantPaymentsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {

    // RESOURCES
    Route::resources([
        'house-type' => HouseTypeController::class,
        'house' => HouseController::class,
        'tenant' => TenantController::class,
        'payment' => PaymentController::class,
    ]);

    Route::get('tenant-payments/{tenant}', [TenantPaymentsController::class, 'index'])->name('tenantPayments.index');

    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
