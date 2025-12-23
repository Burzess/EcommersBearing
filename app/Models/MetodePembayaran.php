<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
        'tipe',
        'bank_nama',
        'bank_rekening',
        'bank_atas_nama',
        'logo',
        'instruksi',
        'is_active',
        'urutan',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope untuk metode pembayaran aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk urutan
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan')->orderBy('nama');
    }

    /**
     * Get semua metode pembayaran aktif
     */
    public static function getActive()
    {
        return self::active()->ordered()->get();
    }

    /**
     * Get metode pembayaran berdasarkan tipe
     */
    public static function getByTipe($tipe)
    {
        return self::active()->where('tipe', $tipe)->ordered()->get();
    }

    /**
     * Get label tipe
     */
    public function getTipeLabelAttribute()
    {
        return match($this->tipe) {
            'transfer' => 'Transfer Bank',
            'cod' => 'Bayar di Tempat (COD)',
            'ewallet' => 'E-Wallet',
            default => $this->tipe,
        };
    }
}
