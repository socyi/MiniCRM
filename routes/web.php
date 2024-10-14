<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

//Dashboard route
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Profile route
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Client CRUD route
Route::middleware('auth')->group(function () {
   Route::resource('clients', ClientController::class);
});

//Transaction CRUD route
Route::middleware('auth')->group(function () {
    Route::resource('transactions',TransactionController::class);
});

require __DIR__.'/auth.php';
