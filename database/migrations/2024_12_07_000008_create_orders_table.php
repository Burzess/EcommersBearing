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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique(); // ORD-YYYYMMDD-XXXX
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('alamat_id')->constrained('alamats')->onDelete('restrict');
            
            // Alamat Snapshot (untuk history)
            $table->string('alamat_penerima');
            $table->string('alamat_telepon');
            $table->text('alamat_lengkap');
            $table->string('alamat_provinsi');
            $table->string('alamat_kota');
            $table->string('alamat_kecamatan');
            $table->string('alamat_kode_pos');
            
            // Pricing
            $table->decimal('subtotal', 15, 2);
            $table->decimal('ongkir', 15, 2)->default(0);
            $table->decimal('total', 15, 2);
            
            // Shipping
            $table->string('kurir')->nullable(); // JNE, JNT, SiCepat, dll
            $table->string('resi')->nullable();
            $table->date('estimasi_sampai')->nullable();
            
            // Payment
            $table->string('metode_pembayaran')->nullable(); // Transfer BCA, Midtrans, dll
            $table->string('bukti_pembayaran')->nullable();
            $table->timestamp('paid_at')->nullable();
            
            // Status
            $table->enum('status', ['pending', 'paid', 'processing', 'shipped', 'delivered', 'cancelled'])->default('pending');
            $table->text('cancelled_reason')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            
            // Notes
            $table->text('catatan')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('order_number');
            $table->index('user_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
