<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\EmployeeAuthController;
use Illuminate\Support\Facades\Route;

// Admin authentication routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

// Employee authentication routes
Route::prefix('employee')->group(function () {
    Route::get('/login', [EmployeeAuthController::class, 'showLoginForm'])->name('employee.login');
    Route::post('/login', [EmployeeAuthController::class, 'login'])->name('employee.login');
    Route::post('/logout', [EmployeeAuthController::class, 'logout'])->name('employee.logout');
});
