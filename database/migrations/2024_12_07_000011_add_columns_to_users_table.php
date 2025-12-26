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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->default(2)->after('id')->constrained('roles')->onDelete('restrict'); // 1=admin, 2=pelanggan
            $table->string('telepon')->nullable()->after('email');
            $table->string('avatar')->nullable()->after('telepon');
            $table->boolean('is_active')->default(true)->after('avatar');
            $table->boolean('notifikasi_email')->default(true)->after('is_active');
            $table->boolean('notifikasi_order')->default(true)->after('notifikasi_email');
            $table->boolean('notifikasi_promo')->default(true)->after('notifikasi_order');
            $table->timestamp('last_login_at')->nullable()->after('notifikasi_promo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn([
                'role_id',
                'telepon',
                'avatar',
                'is_active',
                'notifikasi_email',
                'notifikasi_order',
                'notifikasi_promo',
                'last_login_at'
            ]);
        });
    }
};
