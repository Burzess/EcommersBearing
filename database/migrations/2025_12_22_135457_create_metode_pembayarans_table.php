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
        Schema::create('metode_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100); // Transfer Bank BCA, COD, etc
            $table->enum('tipe', ['transfer', 'cod', 'ewallet'])->default('transfer');
            $table->string('bank_nama', 100)->nullable(); // BCA, BNI, Mandiri, etc
            $table->string('bank_rekening', 50)->nullable();
            $table->string('bank_atas_nama', 100)->nullable();
            $table->string('logo')->nullable();
            $table->text('instruksi')->nullable(); // Instruksi pembayaran
            $table->boolean('is_active')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metode_pembayarans');
    }
};
