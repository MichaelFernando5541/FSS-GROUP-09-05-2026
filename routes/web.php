<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// DASHBOARD (Semua User yang Login bisa buka)
Route::get('/dashboard', function () {
    $netWorth = \App\Models\Car::where('status', 'Tersedia')
                ->selectRaw('SUM(harga_beli + biaya_operasional) as total')
                ->first()->total ?? 0;
    $soldUnits = \App\Models\Car::where('status', 'Terjual')->count();
    $totalROI = \App\Models\Sale::sum('roi_amount');
    $oldStocks = \App\Models\Car::where('status', 'Tersedia')
                ->where('created_at', '<', now()->subDays(30))
                ->get();
    return view('dashboard', compact('netWorth', 'soldUnits', 'totalROI', 'oldStocks'));
})->middleware(['auth', 'verified'])->name('dashboard');

// GRUP RUTE UNTUK SEMUA YANG SUDAH LOGIN
Route::middleware('auth')->group(function () {
    

    Route::delete('/sales/{sale}', [SaleController::class, 'destroy'])->name('sales.destroy');
    
    // Jika Anda ingin mengizinkan edit juga (poin 8):
    Route::get('/sales/{sale}/edit', [SaleController::class, 'edit'])->name('sales.edit');
    Route::patch('/sales/{sale}', [SaleController::class, 'update'])->name('sales.update');
    // Profil (Breeze Default)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // FITUR YANG BISA DIAKSES ADMIN & KASIR
    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/sales/create', [SaleController::class, 'create'])->name('sales.create');
    Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');
    Route::get('/sales/{id}/print', [SaleController::class, 'print'])->name('sales.print');
    
    // Fitur Data Master Dasar (Biasanya Kasir juga butuh daftar pelanggan)
    Route::resource('customers', CustomerController::class);

    // KHUSUS MASTER ADMIN (Hanya Role Admin yang bisa masuk ke grup ini)
    Route::middleware(['role:admin'])->group(function () {
        // Manajemen Akun Karyawan
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        // Manajemen Stok Mobil & Supplier
        Route::resource('cars', CarController::class);
        Route::resource('suppliers', SupplierController::class);
        
        // Laporan Keuangan & ROI
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/print', [ReportController::class, 'print'])->name('reports.print');
  Route::patch('/sales/{sale}', [SaleController::class, 'update'])->name('sales.update');
Route::get('/sales/{sale}/edit', [SaleController::class, 'edit'])->name('sales.edit');
        });

    
});

require __DIR__.'/auth.php';