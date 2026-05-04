<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WilayahController extends Controller
{
    protected string $baseUrl = 'https://wilayah.id/api';

    /**
     * Transform API response from wilayah.id shape to [{kode, nama}].
     */
    private function transformResponse(array $data): array
    {
        $items = $data['data'] ?? [];

        if (! is_array($items)) {
            return [];
        }

        $result = [];
        foreach ($items as $item) {
            if (! is_array($item) || ! isset($item['code'], $item['name'])) {
                continue;
            }
            $result[] = [
                'kode' => $item['code'],
                'nama' => $item['name'],
            ];
        }

        return $result;
    }

    /**
     * Get list of provinces
     */
    public function provinsi()
    {
        $cacheKey = 'wilayah_provinsi';

        $data = Cache::remember($cacheKey, 60 * 60 * 24, function () {
            $response = Http::timeout(10)->get("{$this->baseUrl}/provinces.json");

            if (! $response->successful()) {
                return [];
            }

            return $this->transformResponse($response->json());
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

        $cacheKey = "wilayah_kota_{$provinsiKode}";

        $data = Cache::remember($cacheKey, 60 * 60 * 24, function () use ($provinsiKode) {
            $response = Http::timeout(10)->get("{$this->baseUrl}/regencies/{$provinsiKode}.json");

            if (! $response->successful()) {
                return [];
            }

            return $this->transformResponse($response->json());
        });

        return response()->json($data);
    }

    /**
     * Get list of kecamatan by province and city code
     */
    public function kecamatan(Request $request)
    {
        $kotaKode = $request->query('kab');
        
        if (! $kotaKode) {
            return response()->json(['error' => 'Kode kota diperlukan'], 400);
        }

        $cacheKey = "wilayah_kecamatan_{$kotaKode}";

        $data = Cache::remember($cacheKey, 60 * 60 * 24, function () use ($kotaKode) {
            $response = Http::timeout(10)->get("{$this->baseUrl}/districts/{$kotaKode}.json");

            if (! $response->successful()) {
                return [];
            }

            return $this->transformResponse($response->json());
        });

        return response()->json($data);
    }
}
