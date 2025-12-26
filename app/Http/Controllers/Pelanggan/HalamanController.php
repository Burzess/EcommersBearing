<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\KebijakanPrivasi;
use App\Models\Kontak;
use App\Models\TentangKami;

class HalamanController extends Controller
{
    public function tentangKami()
    {
        $tentangKami = TentangKami::active()->first();
        
        if (!$tentangKami) {
            abort(404);
        }
        
        return view('pelanggan.halaman.tentang-kami', compact('tentangKami'));
    }

    public function kontak()
    {
        $kontak = Kontak::active()->first();
        
        if (!$kontak) {
            abort(404);
        }
        
        return view('pelanggan.halaman.kontak', compact('kontak'));
    }

    public function kebijakanPrivasi()
    {
        $kebijakanPrivasi = KebijakanPrivasi::active()->first();
        
        if (!$kebijakanPrivasi) {
            abort(404);
        }
        
        return view('pelanggan.halaman.kebijakan-privasi', compact('kebijakanPrivasi'));
    }
}
