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
        Schema::table('orders', function (Blueprint $table) {
            $table->index('created_at');
            $table->index(['status', 'created_at']);
        });

        Schema::table('produks', function (Blueprint $table) {
            $table->index('stok');
            $table->index(['is_active', 'is_featured', 'stok']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
            $table->dropIndex(['status', 'created_at']);
        });

        Schema::table('produks', function (Blueprint $table) {
            $table->dropIndex(['stok']);
            $table->dropIndex(['is_active', 'is_featured', 'stok']);
        });
    }
};
