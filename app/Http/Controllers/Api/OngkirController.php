<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\Ongkir;
use Illuminate\Http\Request;

class OngkirController extends Controller
{
    /**
     * Hitung ongkir berdasarkan alamat_id
     */
    public function hitungByAlamat(Request $request)
    {
        $request->validate([
            'alamat_id' => 'required|exists:alamats,id'
        ]);

        $alamat = Alamat::find($request->alamat_id);
        
        if (!$alamat) {
            return response()->json([
                'success' => false,
                'message' => 'Alamat tidak ditemukan'
            ], 404);
        }

        $ongkir = Ongkir::hitungOngkir($alamat->provinsi);

        return response()->json([
            'success' => true,
            'data' => [
                'provinsi' => $alamat->provinsi,
                'tarif' => $ongkir['tarif'],
                'tarif_formatted' => 'Rp ' . number_format($ongkir['tarif'], 0, ',', '.'),
                'estimasi' => $ongkir['estimasi'],
            ]
        ]);
    }

    /**
     * Hitung ongkir berdasarkan nama provinsi
     */
    public function hitungByProvinsi(Request $request)
    {
        $request->validate([
            'provinsi' => 'required|string'
        ]);

        $ongkir = Ongkir::hitungOngkir($request->provinsi);

        return response()->json([
            'success' => true,
            'data' => [
                'provinsi' => $request->provinsi,
                'tarif' => $ongkir['tarif'],
                'tarif_formatted' => 'Rp ' . number_format($ongkir['tarif'], 0, ',', '.'),
                'estimasi' => $ongkir['estimasi'],
            ]
        ]);
    }
}
