<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('store', function (Blueprint $table) {
            $table->id('StoreID');
            $table->string('KodeStore', 20)->unique();
            $table->string('NamaStore', 100);
            $table->enum('TipeLokasi', ['GUDANG', 'TOKO']);
            $table->text('Alamat')->nullable();
            $table->string('NoTelp', 30)->nullable();
            $table->boolean('StatusAktif')->default(1);
            $table->timestamp('CreatedAt')->useCurrent()->nullable();
            $table->timestamp('UpdatedAt')->useCurrent()->useCurrentOnUpdate()->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('store');
    }
};
