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
use App\Http\Controllers\PurchaseOrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/404', function () {
    return view('errors404');
})->name('404');

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
    
    // Purchase Order CRUD
    Route::resource('/inventory/purchase-order', PurchaseOrderController::class)->except(['show']);
});

Route::middleware(['auth', 'role:Admin|Gudang'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/inventory/inventori', InventoriController::class)->except(['show']);
    Route::resource('/inventory/mutasistok', MutasiStokController::class)->except(['show']);

    Route::get('/inventory/stok', [InventoriController::class, 'stock'])->name('inventory.stock');
    Route::get('/inventory/barang-masuk', [PurchaseOrderController::class, 'incoming'])->name('inventory.incoming');
    Route::post('/inventory/barang-masuk/{id}/receive', [PurchaseOrderController::class, 'receive'])->name('inventory.incoming.receive');
    
    Route::get('/inventory/barang-keluar', [MutasiStokController::class, 'outgoing'])->name('inventory.outgoing');
    Route::post('/inventory/barang-keluar/process', [MutasiStokController::class, 'processOutgoing'])->name('inventory.outgoing.process');
});



require __DIR__.'/auth.php';
