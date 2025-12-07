<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;

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

    protected $casts = [
        'is_default' => 'boolean',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Order
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Scope untuk alamat default
     */
    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }

    /**
     * Set alamat ini sebagai default
     */
    public function setAsDefault()
    {
        // Unset semua alamat default user ini
        static::where('user_id', $this->user_id)
              ->where('id', '!=', $this->id)
              ->update(['is_default' => false]);
        
        // Set alamat ini sebagai default
        $this->update(['is_default' => true]);
    }

    /**
     * Get formatted alamat lengkap
     */
    public function getAlamatLengkapFormatAttribute()
    {
        return "{$this->alamat_lengkap}, {$this->kecamatan}, {$this->kota}, {$this->provinsi} {$this->kode_pos}";
    }
}
