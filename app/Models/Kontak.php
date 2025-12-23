<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Kontak
 *
 * Model untuk mengelola informasi kontak perusahaan.
 * Menyimpan alamat, telepon, email, dan tautan media sosial.
 *
 * @package App\Models
 * @author  Bearing Shop Team
 * @version 1.0.0
 *
 * @property int         $id
 * @property string      $nama_perusahaan
 * @property string      $alamat
 * @property string      $telepon
 * @property string|null $whatsapp
 * @property string      $email
 * @property string|null $jam_operasional
 * @property string|null $google_maps_embed
 * @property string|null $facebook
 * @property string|null $instagram
 * @property string|null $twitter
 * @property bool        $is_active
 */
class Kontak extends Model
{
    /**
     * Nama tabel yang digunakan model.
     *
     * @var string
     */
    protected $table = 'kontaks';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
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

    /**
     * Atribut yang harus di-cast ke tipe native.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /**
     * Scope untuk filter data yang aktif.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /*
    |--------------------------------------------------------------------------
    | STATIC METHODS
    |--------------------------------------------------------------------------
    */

    /**
     * Mendapatkan data kontak yang aktif.
     *
     * @return Kontak|null
     */
    public static function getActive(): ?self
    {
        return self::active()->first();
    }
}
