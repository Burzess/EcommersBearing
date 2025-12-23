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
        Schema::create('ongkirs', function (Blueprint $table) {
            $table->id();
            $table->string('provinsi', 100);
            $table->decimal('tarif', 12, 2)->default(0);
            $table->integer('estimasi_hari_min')->default(1);
            $table->integer('estimasi_hari_max')->default(3);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->unique('provinsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ongkirs');
    }
};
