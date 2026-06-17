<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id('ProdukID');
            $table->unsignedBigInteger('BrandID');
            $table->unsignedBigInteger('KategoriID');
            $table->unsignedBigInteger('SubKategoriID')->nullable();
            $table->string('SKU', 50)->unique();
            $table->string('Barcode', 100)->unique();
            $table->string('NamaProduk', 255);
            $table->string('Satuan', 30);
            $table->text('Deskripsi')->nullable();
            $table->boolean('StatusAktif')->default(1);
            $table->timestamp('CreatedAt')->useCurrent()->nullable();
            $table->timestamp('UpdatedAt')->useCurrent()->useCurrentOnUpdate()->nullable();

            $table->foreign('BrandID', 'fk_produk_brand')->references('BrandID')->on('brand')->onDelete('cascade');
            $table->foreign('KategoriID', 'fk_produk_kategori')->references('KategoriID')->on('kategori')->onDelete('cascade');
            $table->foreign('SubKategoriID', 'fk_produk_subkategori')->references('SubKategoriID')->on('sub_kategori')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};