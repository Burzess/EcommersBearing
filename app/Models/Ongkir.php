<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Ongkir
 *
 * Model untuk mengelola tarif ongkos kirim berdasarkan provinsi.
 * Mendukung tarif kustom dan tarif default berdasarkan zona wilayah.
 *
 * @package App\Models
 * @author  Bearing Shop Team
 * @version 1.0.0
 *
 * @property int    $id
 * @property string $provinsi
 * @property float  $tarif
 * @property int    $estimasi_hari_min
 * @property int    $estimasi_hari_max
 * @property bool   $is_active
 */
class Ongkir extends Model
{
    private const SURABAYA_CITY_NAMES = ['SURABAYA', 'KOTA SURABAYA'];
    private const FREE_SHIPPING_THRESHOLD = 150000;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'provinsi',
        'tarif',
        'estimasi_hari_min',
        'estimasi_hari_max',
        'is_active',
    ];

    /**
     * Atribut yang harus di-cast ke tipe native.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tarif' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | STATIC METHODS
    |--------------------------------------------------------------------------
    */

    /**
     * Mendapatkan data ongkir berdasarkan nama provinsi.
     *
     * @param string $provinsi Nama provinsi
     * @return Ongkir|null
     */
    public static function getByProvinsi(string $provinsi): ?self
    {
        return self::where('provinsi', $provinsi)
            ->where('is_active', true)
            ->first();
    }

    /**
     * Menghitung ongkir berdasarkan provinsi.
     * Jika tidak ada di database, gunakan tarif default.
     *
     * @param string $provinsi Nama provinsi
     * @return array{tarif: float, estimasi: string}
     */
    public static function hitungOngkir(string $provinsi): array
    {
        return self::hitungOngkirDenganSubtotal($provinsi, null, null);
    }

    /**
     * Menghitung ongkir berdasarkan provinsi, kota, dan subtotal.
     *
     * @param string $provinsi
     * @param string|null $kota
     * @param float|int|null $subtotal
     * @return array{tarif: float, estimasi: string, is_free_shipping: bool}
     */
    public static function hitungOngkirDenganSubtotal(string $provinsi, ?string $kota = null, float|int|null $subtotal = null): array
    {
        if (self::isGratisSurabaya($kota, $subtotal)) {
            return [
                'tarif' => 0.0,
                'estimasi' => '2-4 hari',
                'is_free_shipping' => true,
            ];
        }

        $ongkir = self::getByProvinsi($provinsi);

        if ($ongkir) {
            return [
                'tarif' => (float) $ongkir->tarif,
                'estimasi' => $ongkir->estimasi_hari_min . '-' . $ongkir->estimasi_hari_max . ' hari',
                'is_free_shipping' => false,
            ];
        }

        // Default ongkir jika provinsi tidak ada di database
        $default = self::getDefaultOngkir($provinsi);
        $default['is_free_shipping'] = false;

        return $default;
    }

    /**
     * Mendapatkan tarif ongkir default berdasarkan zona wilayah Indonesia.
     *
     * Zona 1: Pulau Jawa (termurah)
     * Zona 2: Sumatera & Bali
     * Zona 3: Kalimantan & Sulawesi
     * Zona 4: NTB, NTT, Maluku, Papua (termahal)
     *
     * @param string $provinsi Nama provinsi
     * @return array{tarif: float, estimasi: string}
     */
    public static function getDefaultOngkir(string $provinsi): array
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
            return ['tarif' => 15000.0, 'estimasi' => '2-4 hari'];
        } elseif (in_array($provinsiUpper, $zona2)) {
            return ['tarif' => 25000.0, 'estimasi' => '3-5 hari'];
        } elseif (in_array($provinsiUpper, $zona3)) {
            return ['tarif' => 35000.0, 'estimasi' => '4-7 hari'];
        } elseif (in_array($provinsiUpper, $zona4)) {
            return ['tarif' => 50000.0, 'estimasi' => '5-10 hari'];
        }

        // Default jika provinsi tidak dikenali
        return ['tarif' => 30000.0, 'estimasi' => '3-7 hari'];
    }

    private static function isGratisSurabaya(?string $kota, float|int|null $subtotal): bool
    {
        if ($subtotal === null || (float) $subtotal < self::FREE_SHIPPING_THRESHOLD) {
            return false;
        }

        if (! is_string($kota) || trim($kota) === '') {
            return false;
        }

        $kotaUpper = strtoupper(trim($kota));

        return in_array($kotaUpper, self::SURABAYA_CITY_NAMES, true) || str_contains($kotaUpper, 'SURABAYA');
    }
}
