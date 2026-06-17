<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_kategori', function (Blueprint $table) {
            $table->id('SubKategoriID');
            $table->unsignedBigInteger('KategoriID');
            $table->string('Nama', 100);
            $table->timestamp('CreatedAt')->useCurrent()->nullable();
            $table->timestamp('UpdatedAt')->useCurrent()->useCurrentOnUpdate()->nullable();

            $table->foreign('KategoriID', 'fk_subkategori_kategori')->references('KategoriID')->on('kategori')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_kategori');
    }
};