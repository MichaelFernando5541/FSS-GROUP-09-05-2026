<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PurchaseController; 
use App\Http\Controllers\SaleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// This group requires the user to be logged in
Route::middleware('auth')->group(function () {
    
    // The Breeze Profile routes (This fixes your error!)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Your Master Data routes
    Route::resource('items', ItemController::class);
    Route::resource('suppliers', SupplierController::class); // Tambahkan ini
    Route::resource('customers', CustomerController::class); // Tambahkan ini
    Route::resource('purchases', PurchaseController::class); // Tambahkan baris ini
    Route::resource('sales', SaleController::class);
});

// Loads the Breeze login/register routes
require __DIR__.'/auth.php';