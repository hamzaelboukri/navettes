<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/register', [AuthController::class, 'show'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [LoginController::class, 'show'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// User Dashboard
Route::get('/user/dashboard', [AuthController::class, 'showUserDashboard'])
    ->middleware('auth')
    ->name('user.dashboard');

// Admin Dashboard
Route::get('/admin/dashboard', [AuthController::class, 'showAdminDashboard'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');

// Admin actions
Route::put('/admin/users/{id}/role', [AuthController::class, 'updateUserRole'])
    ->middleware(['auth', 'admin'])
    ->name('update.user.role');

// Role Management
Route::get('/admin/role', [RoleController::class, 'index'])->name('admin.role.index');
Route::post('/admin/role', [RoleController::class, 'store'])->name('admin.role.store');
Route::get('/admin/role/{id}/edit', [RoleController::class, 'edit'])->name('admin.role.edit');
Route::put('/admin/role/{id}', [RoleController::class, 'update'])->name('admin.role.update');
Route::delete('/admin/role/{id}', [RoleController::class, 'destroy'])->name('admin.role.destroy');

//role permisssion
Route::get('/admin/permission', [PermissionController::class, 'index'])->name('admin.permission.index');
Route::post('/admin/permission', [PermissionController::class, 'store'])->name('admin.permission.store');
Route::delete('/admin/permission/{id}', [PermissionController::class, 'destroy'])->name('admin.permission.destroy');

//announcements
Route::get('/announcements', [AnnouncementController::class, 'index'])->name('user.announcements');
Route::post('/announcements', [AnnouncementController::class, 'store'])->name('user.announcements.store');
Route::delete('/announcements/{id}', [AnnouncementController::class, 'destroy'])->name('user.announcements.destroy');