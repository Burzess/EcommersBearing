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
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('harga', 15, 2); // snapshot harga saat ditambah
            $table->timestamps();
            
            // Unique constraint: satu user tidak bisa menambah produk yang sama lebih dari sekali
            $table->unique(['user_id', 'produk_id']);
            
            $table->index('user_id');
            $table->index('produk_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjangs');
    }
};
