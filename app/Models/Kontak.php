<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $table = 'kontaks';

    protected $fillable = [
        'nama_perusahaan',
        'alamat',
        'telepon',
        'whatsapp',
        'email',
        'jam_operasional',
        'google_maps_embed',
        'facebook',
        'instagram',
        'twitter',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
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
