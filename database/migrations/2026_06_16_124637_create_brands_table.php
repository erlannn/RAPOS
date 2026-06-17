<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brand', function (Blueprint $table) {
            $table->id('BrandID');
            $table->string('NamaBrand', 100)->unique();
            $table->boolean('StatusAktif')->default(1);
            $table->timestamp('CreatedAt')->useCurrent()->nullable();
            $table->timestamp('UpdatedAt')->useCurrent()->useCurrentOnUpdate()->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brand');
    }
};