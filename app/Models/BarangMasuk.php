<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $fillable = [
        'produk_id',
        'tanggal',
        'jumlah',
        'keterangan',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
