<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Dashboard\Management\RoleController;
use App\Http\Controllers\Dashboard\Management\UserController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard.index')->with('title', 'Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard2', function () {
    return view('dashboard.index')->with('title', 'Dashboard 2');
})->middleware(['auth', 'verified'])->name('dashboard2');

Route::middleware('auth')->group(function () {
    Route::resource('profiles', ProfileController::class);
    // index
    // create
    // store
    // edit
    // update
    // destroy
    // show
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('users/exportPdf', [UserController::class, 'exportPdf'])->name('users.exportPdf');
    Route::get('users/exportExcel', [UserController::class, 'exportExcel'])->name('users.exportExcel');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
});

Route::controller(GoogleController::class)->group(function () {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});

require __DIR__ . '/auth.php';
