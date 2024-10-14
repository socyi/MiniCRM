<?php

use App\Http\Controllers\ClientController;
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

//Client CRUD route
Route::middleware('auth')->group(function () {
   Route::resource('clients', ClientController::class);
});

//Transaction CRUD route
Route::middleware('auth')->group(function () {
    Route::resource('transactions',TransactionController::class);
});

require __DIR__.'/auth.php';
