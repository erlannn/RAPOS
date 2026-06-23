<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ProdukID');
            $table->unsignedBigInteger('SupplierID');
            $table->integer('JumlahBeli');
            $table->integer('IsiKardus')->default(1);
            $table->decimal('HargaSatuan', 15, 2);
            $table->decimal('TotalHarga', 15, 2);
            $table->string('Status')->default('Pending'); // Pending, Diterima
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ProdukID')->references('ProdukID')->on('produk')->onDelete('cascade');
            $table->foreign('SupplierID')->references('SupplierID')->on('supplier')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
?>
