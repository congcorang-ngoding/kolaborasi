<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
});

require __DIR__ . '/auth.php';
