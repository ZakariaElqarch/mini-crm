<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminEmployeeController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HistoryLogController;
use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home Route
Route::get('/', function () {
    return view('auth.home');
})->name('home');

// Admin Routes
Route::middleware('auth:admin')->group(function () {

    // Admin Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'showDashboard'])->name('admin.dashboard');

    // Profile Management for Admins
    Route::prefix('admin/profile')->name('admin.profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // Company Management Routes
    Route::resource('admin/companies', CompanyController::class)->names('admin.companies');

    // Admin Management Routes
    Route::resource('admin/admins', AdminController::class);

    // Employee Management Routes
    Route::resource('admin/employee', AdminEmployeeController::class);
    Route::post('/admin/invitations/{id}/cancel', [AdminEmployeeController::class, 'cancelInvitation'])->name('admin.invitations.cancel');

    Route::resource('admin/history', HistoryLogController::class);

});

Route::get('/invite/validate/{token}', [InvitationController::class, 'validateInvitation'])->name('invite.validate');
Route::post('/invite/complete/{token}', [InvitationController::class, 'completeProfile'])->name('invite.complete');


// Include the authentication routes for admin
require __DIR__ . '/auth.php';
