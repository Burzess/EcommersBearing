<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('produks')->onDelete('restrict');
            
            // Snapshot Produk (untuk history)
            $table->string('produk_nama');
            $table->string('produk_sku');
            $table->string('produk_image')->nullable();
            
            // Pricing
            $table->decimal('harga', 15, 2); // harga satuan saat order
            $table->integer('quantity');
            $table->decimal('subtotal', 15, 2); // harga * quantity
            
            $table->timestamps();
            
            $table->index('order_id');
            $table->index('produk_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
