<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supplier', function (Blueprint $table) {
            $table->id('SupplierID');
            $table->string('KodeSupplier', 20)->unique();
            $table->string('NamaSupplier', 150);
            $table->string('PIC', 100)->nullable();
            $table->string('NoTelp', 30)->nullable();
            $table->string('Email', 100)->nullable();
            $table->text('Alamat')->nullable();
            $table->boolean('StatusAktif')->default(1);
            $table->timestamp('CreatedAt')->useCurrent()->nullable();
            $table->timestamp('UpdatedAt')->useCurrent()->useCurrentOnUpdate()->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supplier');
    }
};