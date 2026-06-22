<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SubKategoriController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\InventoriController;
use App\Http\Controllers\MutasiStokController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/403', function () {
    return view('errors403');
})->name('403');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::resource('/master-data/brand', BrandController::class)->except(['show']);
    Route::resource('/master-data/departemen', DepartemenController::class)->except(['show']);
    Route::resource('/master-data/kategori', KategoriController::class)->except(['show']);
    Route::resource('/master-data/subkategori', SubKategoriController::class)->except(['show']);
    Route::resource('/master-data/store', StoreController::class)->except(['show']);
    Route::resource('/master-data/produk', ProdukController::class)->except(['show']);
    Route::resource('/master-data/supplier', SupplierController::class)->except(['show']);
});

Route::middleware(['auth', 'role:Admin|Gudang'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/inventory/inventori', InventoriController::class)->except(['show']);
    Route::resource('/inventory/mutasistok', MutasiStokController::class)->except(['show']);

    Route::view('/inventory/stok', 'inventory.stock')->name('inventory.stock');
    Route::view('/inventory/barang-masuk', 'inventory.incoming')->name('inventory.incoming');
    Route::view('/inventory/barang-keluar', 'inventory.outgoing')->name('inventory.outgoing');
});

require __DIR__.'/auth.php';
