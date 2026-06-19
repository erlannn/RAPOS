<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/app', function () {
    return view('components.app-layout');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::view('/master-data/produk', 'Master-data.Produk.Produk')->name('master-data.produk');
    Route::view('/master-data/produk/tambah', 'Master-data.Produk.Tambah')->name('master-data.produk.tambah');
    Route::view('/master-data/produk/edit', 'Master-data.Produk.Edit')->name('master-data.produk.edit');
    Route::view('/master-data/supplier', 'Master-data.Supplier.Supplier')->name('master-data.supplier');
    Route::view('/master-data/supplier/tambah', 'Master-data.Supplier.Tambah')->name('master-data.supplier.tambah');
    Route::view('/master-data/supplier/edit', 'Master-data.Supplier.Edit')->name('master-data.supplier.edit');

    Route::view('/inventory/stok', 'inventory.stock')->name('inventory.stock');
    Route::view('/inventory/barang-masuk', 'inventory.incoming')->name('inventory.incoming');
    Route::view('/inventory/barang-keluar', 'inventory.outgoing')->name('inventory.outgoing');
});

require __DIR__.'/auth.php';
