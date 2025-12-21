<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KebijakanPrivasi extends Model
{
    protected $table = 'kebijakan_privasis';

    protected $fillable = [
        'judul',
        'konten',
        'tanggal_berlaku',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'tanggal_berlaku' => 'date',
    ];

    /**
     * Scope untuk yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Mendapatkan data yang aktif
     */
    public static function getActive()
    {
        return self::active()->first();
    }
}
