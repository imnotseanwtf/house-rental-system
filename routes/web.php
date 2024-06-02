<?php

use App\Http\Controllers\HouseController;
use App\Http\Controllers\HouseTypeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
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

    // TENANT PAYMENTS
    Route::get('tenant-payments/{tenant}', [TenantPaymentsController::class, 'index'])->name('tenantPayments.index');

    // REPORT
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');

    // MONTHLY REPORT
    Route::get('report-payments', [ReportController::class, 'monthlyPaymentsReport'])->name('monthlyPayments.index');
    Route::get('report-balances', [ReportController::class, 'monthlyBalancesReport'])->name('monthlyBalances.index');

    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
