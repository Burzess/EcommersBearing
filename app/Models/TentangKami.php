<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TentangKami extends Model
{
    protected $table = 'tentang_kamis';

    protected $fillable = [
        'judul',
        'konten',
        'gambar',
        'visi',
        'misi',
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
