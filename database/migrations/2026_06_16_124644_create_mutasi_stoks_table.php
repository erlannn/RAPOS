<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mutasi_stok', function (Blueprint $table) {
            $table->id('MutasiID');
            $table->dateTime('Tanggal');
            $table->unsignedBigInteger('ProdukID');
            $table->unsignedBigInteger('StoreID');
            $table->enum('JenisMutasi', ['PEMBELIAN', 'PENJUALAN', 'RETUR_BELI', 'RETUR_JUAL', 'TRANSFER_MASUK', 'TRANSFER_KELUAR', 'OPNAME', 'ADJUSTMENT']);
            $table->string('ReferensiTabel', 50)->nullable();
            $table->unsignedBigInteger('ReferensiID')->nullable();
            $table->integer('Qty');
            $table->integer('SaldoSebelum');
            $table->integer('SaldoSesudah');
            $table->text('Keterangan')->nullable();
            $table->unsignedBigInteger('UserID');
            $table->timestamp('CreatedAt')->useCurrent()->nullable();

            $table->foreign('ProdukID', 'fk_mutasi_produk')->references('ProdukID')->on('produk')->onDelete('cascade');
            $table->foreign('StoreID', 'fk_mutasi_store')->references('StoreID')->on('store')->onDelete('cascade');
            $table->foreign('UserID', 'fk_mutasi_user')->references('UserID')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mutasi_stok');
    }
};