<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model Alamat
 *
 * Model untuk mengelola alamat pengiriman pelanggan.
 * Mendukung multiple alamat per user dengan fitur alamat default.
 *
 * @package App\Models
 * @author  Bearing Shop Team
 * @version 1.0.0
 *
 * @property int    $id
 * @property int    $user_id
 * @property string $label
 * @property string $penerima
 * @property string $telepon
 * @property string $alamat_lengkap
 * @property string $provinsi
 * @property string $kota
 * @property string $kecamatan
 * @property string $kode_pos
 * @property bool   $is_default
 */
class Alamat extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'label',
        'penerima',
        'telepon',
        'alamat_lengkap',
        'provinsi',
        'kota',
        'kecamatan',
        'kode_pos',
        'is_default',
    ];

    /**
     * Atribut yang harus di-cast ke tipe native.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_default' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    /**
     * Mendapatkan user pemilik alamat.
     *
     * @return BelongsTo<User, Alamat>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mendapatkan semua order yang menggunakan alamat ini.
     *
     * @return HasMany<Order>
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /**
     * Scope untuk filter alamat default.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeDefault(Builder $query): Builder
    {
        return $query->where('is_default', true);
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER METHODS
    |--------------------------------------------------------------------------
    */

    /**
     * Menetapkan alamat ini sebagai alamat default.
     * Secara otomatis menghapus status default dari alamat lain.
     *
     * @return void
     */
    public function setAsDefault(): void
    {
        // Hapus status default dari alamat lain milik user yang sama
        static::where('user_id', $this->user_id)
              ->where('id', '!=', $this->id)
              ->update(['is_default' => false]);

        // Set alamat ini sebagai default
        $this->update(['is_default' => true]);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /**
     * Mendapatkan alamat lengkap dalam format yang mudah dibaca.
     *
     * @return string
     */
    public function getAlamatLengkapFormatAttribute(): string
    {
        return "{$this->alamat_lengkap}, {$this->kecamatan}, {$this->kota}, {$this->provinsi} {$this->kode_pos}";
    }
}
