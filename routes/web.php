<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ApplicationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/register', [RegisterController::class, 'registerForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/login', [LoginController::class, 'loginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/application/create', [ApplicationController::class, 'create'])->name('application.create');
    Route::post('/application/store', [ApplicationController::class, 'store'])->name('application.store');

    Route::get('/applications', [ApplicationController::class, 'index'])->name('application.index');
    Route::get('/applications/data', [ApplicationController::class, 'applicationData']);
    Route::post('/application/check', [ApplicationController::class, 'check']);
});
