<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminEmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminCompanyController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ColleaguesController;
use App\Http\Controllers\AdminHistoryLogController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeDashboardController;
use App\Http\Controllers\EmployeeProfileController;
use App\Http\Controllers\InvitationController;
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
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'showDashboard'])->name('admin.dashboard');

    // Profile Management for Admins
    Route::prefix('admin/profile')->name('admin.profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // Company Management Routes
    Route::resource('admin/companies', AdminCompanyController::class)->names('admin.companies');

    // Admin Management Routes
    Route::resource('admin/admins', AdminController::class);

    // Employee Management Routes
    Route::resource('admin/employee', AdminEmployeeController::class);
    Route::post('/admin/invitations/{id}/cancel', [AdminEmployeeController::class, 'cancelInvitation'])->name('admin.invitations.cancel');

    Route::resource('admin/history', AdminHistoryLogController::class);

    Route::get('admin/profile/', [AdminProfileController::class, 'show'])->name('admin.profile.show');
    Route::get('admin/profile/edit', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('admin/profile/update', [AdminProfileController::class, 'update'])->name('admin.profile.update');
});

Route::get('/invite/validate/{token}', [InvitationController::class, 'validateInvitation'])->name('invite.validate');
Route::post('/invite/complete/{token}', [InvitationController::class, 'completeProfile'])->name('invite.complete');

Route::middleware('auth:employee')->group(function () {

    // Employee Dashboard
    Route::get('/employee/dashboard', [EmployeeDashboardController::class, 'showDashboard'])->name('employee.dashboard');

    // Route for displaying the list of colleagues (index)
    Route::get('employee/colleagues', [ColleaguesController::class, 'index'])->name('employee.colleagues.index');

    // Route for displaying a specific colleague's details (show)
    Route::get('employee/colleagues/{id}', [ColleaguesController::class, 'show'])->name('employee.colleagues.show');
    Route::get('employee/Company/', [CompanyController::class, 'show'])->name('employee.Company.show');

    Route::get('employee/profile/', [EmployeeProfileController::class, 'show'])->name('employee.profile.show');
    Route::get('employee/profile/edit', [EmployeeProfileController::class, 'edit'])->name('employee.profile.edit');
    Route::put('employee/profile/update', [EmployeeProfileController::class, 'update'])->name('employee.profile.update');

});

// Include the authentication routes for admin
require __DIR__ . '/auth.php';


Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
