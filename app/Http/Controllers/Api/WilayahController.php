<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WilayahController extends Controller
{
    protected $baseUrl = 'https://sipedas.pertanian.go.id/api/wilayah';
    protected $tahun = 2025;

    /**
     * Transform API response from {kode: nama} to [{kode, nama}]
     */
    private function transformResponse($data, $isNested = false)
    {
        // Jika response nested (kota/kecamatan), ambil dari key 'output'
        if ($isNested && isset($data['output'])) {
            $data = $data['output'];
        }

        if (!is_array($data)) {
            return [];
        }

        $result = [];
        foreach ($data as $kode => $nama) {
            // Skip jika bukan data wilayah (misalnya key metadata)
            if (!is_string($nama)) {
                continue;
            }
            $result[] = [
                'kode' => $kode,
                'nama' => $nama
            ];
        }
        return $result;
    }

    /**
     * Get list of provinces
     */
    public function provinsi()
    {
        $cacheKey = "wilayah_provinsi_{$this->tahun}";

        $data = Cache::remember($cacheKey, 60 * 60 * 24, function () {
            $response = Http::timeout(10)->get("{$this->baseUrl}/list_pro", [
                'tahun' => $this->tahun
            ]);

            if ($response->successful()) {
                return $this->transformResponse($response->json(), false);
            }

            return [];
        });

        return response()->json($data);
    }

    /**
     * Get list of cities/kabupaten by province code
     */
    public function kota(Request $request)
    {
        $provinsiKode = $request->query('pro');

        if (!$provinsiKode) {
            return response()->json(['error' => 'Kode provinsi diperlukan'], 400);
        }

        $cacheKey = "wilayah_kota_{$this->tahun}_{$provinsiKode}";

        $data = Cache::remember($cacheKey, 60 * 60 * 24, function () use ($provinsiKode) {
            $response = Http::timeout(10)->get("{$this->baseUrl}/list_kab", [
                'tahun' => $this->tahun,
                'pro' => $provinsiKode
            ]);

            if ($response->successful()) {
                return $this->transformResponse($response->json(), true);
            }

            return [];
        });

        return response()->json($data);
    }

    /**
     * Get list of kecamatan by province and city code
     */
    public function kecamatan(Request $request)
    {
        $provinsiKode = $request->query('pro');
        $kotaKode = $request->query('kab');

        if (!$provinsiKode || !$kotaKode) {
            return response()->json(['error' => 'Kode provinsi dan kota diperlukan'], 400);
        }

        $cacheKey = "wilayah_kecamatan_{$this->tahun}_{$provinsiKode}_{$kotaKode}";

        $data = Cache::remember($cacheKey, 60 * 60 * 24, function () use ($provinsiKode, $kotaKode) {
            $response = Http::timeout(10)->get("{$this->baseUrl}/list_kec", [
                'tahun' => $this->tahun,
                'pro' => $provinsiKode,
                'kab' => $kotaKode
            ]);

            if ($response->successful()) {
                return $this->transformResponse($response->json(), true);
            }

            return [];
        });

        return response()->json($data);
    }
}
