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
        Schema::table('metode_pembayarans', function (Blueprint $table) {
            if (!Schema::hasColumn('metode_pembayarans', 'deskripsi')) {
                $table->string('deskripsi', 255)->nullable()->after('nama');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('metode_pembayarans', function (Blueprint $table) {
            if (Schema::hasColumn('metode_pembayarans', 'deskripsi')) {
                $table->dropColumn('deskripsi');
            }
        });
    }
};
