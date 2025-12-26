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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('restrict');
            $table->foreignId('merk_id')->constrained('merks')->onDelete('restrict');
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->text('deskripsi')->nullable();
            
            // Pricing & Stock
            $table->decimal('harga', 15, 2);
            $table->decimal('harga_diskon', 15, 2)->nullable();
            $table->integer('stok')->default(0);
            $table->integer('min_stok')->default(5);
            $table->decimal('berat', 8, 2); // dalam gram
            $table->string('unit')->default('pcs');
            
            // Status
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            
            // Spesifikasi Teknis Bearing
            $table->decimal('inner_diameter', 8, 2)->nullable()->comment('mm');
            $table->decimal('outer_diameter', 8, 2)->nullable()->comment('mm');
            $table->decimal('width', 8, 2)->nullable()->comment('mm');
            $table->string('material')->nullable()->comment('Steel, Ceramic, Stainless');
            $table->string('seal_type')->nullable()->comment('Open, Sealed, Shielded');
            $table->string('cage_type')->nullable()->comment('Steel, Brass, Nylon');
            
            // Metrics
            $table->integer('views')->default(0);
            $table->integer('sold_count')->default(0);
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('slug');
            $table->index('sku');
            $table->index('kategori_id');
            $table->index('merk_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
