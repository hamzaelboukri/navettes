<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\loginController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'show'])->name('index');
Route::post('/login/create', [LoginController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'show'])->name('show');
Route::post('/register', [AuthController::class, 'register'])->name('register');


