<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ongkir extends Model
{
    protected $fillable = [
        'provinsi',
        'tarif',
        'estimasi_hari_min',
        'estimasi_hari_max',
        'is_active',
    ];

    protected $casts = [
        'tarif' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get ongkir by provinsi
     */
    public static function getByProvinsi($provinsi)
    {
        return self::where('provinsi', $provinsi)
            ->where('is_active', true)
            ->first();
    }

    /**
     * Calculate ongkir - jika tidak ada di database, gunakan default
     */
    public static function hitungOngkir($provinsi)
    {
        $ongkir = self::getByProvinsi($provinsi);

        if ($ongkir) {
            return [
                'tarif' => $ongkir->tarif,
                'estimasi' => $ongkir->estimasi_hari_min . '-' . $ongkir->estimasi_hari_max . ' hari',
            ];
        }

        // Default ongkir jika provinsi tidak ada di database
        return self::getDefaultOngkir($provinsi);
    }

    /**
     * Default ongkir berdasarkan zona wilayah
     */
    public static function getDefaultOngkir($provinsi)
    {
        // Zona 1: Pulau Jawa (termurah)
        $zona1 = ['DKI JAKARTA', 'JAWA BARAT', 'JAWA TENGAH', 'DI YOGYAKARTA', 'JAWA TIMUR', 'BANTEN'];

        // Zona 2: Sumatera & Bali
        $zona2 = [
            'ACEH',
            'SUMATERA UTARA',
            'SUMATERA BARAT',
            'RIAU',
            'JAMBI',
            'SUMATERA SELATAN',
            'BENGKULU',
            'LAMPUNG',
            'KEPULAUAN BANGKA BELITUNG',
            'KEPULAUAN RIAU',
            'BALI'
        ];

        // Zona 3: Kalimantan & Sulawesi
        $zona3 = [
            'KALIMANTAN BARAT',
            'KALIMANTAN TENGAH',
            'KALIMANTAN SELATAN',
            'KALIMANTAN TIMUR',
            'KALIMANTAN UTARA',
            'SULAWESI UTARA',
            'SULAWESI TENGAH',
            'SULAWESI SELATAN',
            'SULAWESI TENGGARA',
            'GORONTALO',
            'SULAWESI BARAT'
        ];

        // Zona 4: NTB, NTT, Maluku, Papua (termahal)
        $zona4 = [
            'NUSA TENGGARA BARAT',
            'NUSA TENGGARA TIMUR',
            'MALUKU',
            'MALUKU UTARA',
            'PAPUA BARAT',
            'PAPUA BARAT DAYA',
            'PAPUA',
            'PAPUA SELATAN',
            'PAPUA TENGAH',
            'PAPUA PEGUNUNGAN'
        ];

        $provinsiUpper = strtoupper($provinsi);

        if (in_array($provinsiUpper, $zona1)) {
            return ['tarif' => 15000, 'estimasi' => '2-4 hari'];
        } elseif (in_array($provinsiUpper, $zona2)) {
            return ['tarif' => 25000, 'estimasi' => '3-5 hari'];
        } elseif (in_array($provinsiUpper, $zona3)) {
            return ['tarif' => 35000, 'estimasi' => '4-7 hari'];
        } elseif (in_array($provinsiUpper, $zona4)) {
            return ['tarif' => 50000, 'estimasi' => '5-10 hari'];
        }

        // Default jika tidak dikenali
        return ['tarif' => 30000, 'estimasi' => '3-7 hari'];
    }
}
