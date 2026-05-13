<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            KategoriSeeder::class,
            MerkSeeder::class,
            ProdukSeeder::class,
            TentangKamiSeeder::class,
            KontakSeeder::class,
            KebijakanPrivasiSeeder::class,
            MetodePembayaranSeeder::class,
            BudiPembelianSeeder::class,
        ]);

        $this->syncSqliteAutoIncrement();
    }

    /**
     * Sinkronkan sqlite_sequence agar auto-increment selalu lanjut
     * setelah seeder (terutama saat data id diisi manual/legacy import).
     */
    private function syncSqliteAutoIncrement(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            return;
        }

        $hasSqliteSequenceTable = DB::table('sqlite_master')
            ->where('type', 'table')
            ->where('name', 'sqlite_sequence')
            ->exists();

        if (! $hasSqliteSequenceTable) {
            return;
        }

        $tables = collect(DB::select("
            SELECT name
            FROM sqlite_master
            WHERE type = 'table'
              AND name NOT LIKE 'sqlite_%'
              AND name NOT IN ('migrations')
        "))->pluck('name');

        foreach ($tables as $table) {
            if (! Schema::hasColumn($table, 'id')) {
                continue;
            }

            $maxId = (int) (DB::table($table)->max('id') ?? 0);

            DB::table('sqlite_sequence')->updateOrInsert(
                ['name' => $table],
                ['seq' => $maxId]
            );
        }
    }
}
