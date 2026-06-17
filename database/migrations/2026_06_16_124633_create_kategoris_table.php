<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->id('KategoriID');
            $table->unsignedBigInteger('DepartemenID');
            $table->string('Nama', 100);
            $table->timestamp('CreatedAt')->useCurrent()->nullable();
            $table->timestamp('UpdatedAt')->useCurrent()->useCurrentOnUpdate()->nullable();

            $table->foreign('DepartemenID', 'fk_kategori_departemen')->references('DepartemenID')->on('departemen')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori');
    }
};