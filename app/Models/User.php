<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'telepon',
        'avatar',
        'is_active',
        'notifikasi_email',
        'notifikasi_order',
        'notifikasi_promo',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'notifikasi_email' => 'boolean',
            'notifikasi_order' => 'boolean',
            'notifikasi_promo' => 'boolean',
            'last_login_at' => 'datetime',
        ];
    }

    /**
     * Relasi ke Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relasi ke Alamat
     */
    public function alamats()
    {
        return $this->hasMany(Alamat::class);
    }

    /**
     * Relasi ke Keranjang
     */
    public function keranjangs()
    {
        return $this->hasMany(Keranjang::class);
    }

    /**
     * Relasi ke Order
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Check apakah user adalah admin
     */
    public function isAdmin()
    {
        return $this->role && $this->role->name === 'admin';
    }

    /**
     * Check apakah user adalah pelanggan
     */
    public function isPelanggan()
    {
        return $this->role && $this->role->name === 'pelanggan';
    }

    /**
     * Get alamat default
     */
    public function getDefaultAlamat()
    {
        return $this->alamats()->where('is_default', true)->first()
            ?? $this->alamats()->first();
    }

    /**
     * Update last login timestamp
     */
    public function updateLastLogin()
    {
        $this->update(['last_login_at' => now()]);
    }
}
