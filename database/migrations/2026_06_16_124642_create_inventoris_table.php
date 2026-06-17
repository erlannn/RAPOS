<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventori', function (Blueprint $table) {
            $table->id('InventoriID');
            $table->unsignedBigInteger('ProdukID');
            $table->unsignedBigInteger('StoreID');
            $table->integer('StokSaatIni')->default(0);
            $table->integer('MinimumStok')->default(0);
            $table->bigInteger('HargaBeliTerakhir')->default(0);
            $table->bigInteger('HargaJual')->default(0);
            $table->timestamp('CreatedAt')->useCurrent()->nullable();
            $table->timestamp('UpdatedAt')->useCurrent()->useCurrentOnUpdate()->nullable();

            $table->unique(['ProdukID', 'StoreID'], 'uk_produk_store');
            
            $table->foreign('ProdukID', 'fk_inventori_produk')->references('ProdukID')->on('produk')->onDelete('cascade');
            $table->foreign('StoreID', 'fk_inventori_store')->references('StoreID')->on('store')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventori');
    }
};