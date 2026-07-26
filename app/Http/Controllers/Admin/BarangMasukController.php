<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BarangMasuk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangMasuks = BarangMasuk::with('produk')->latest('tanggal')->latest('id')->paginate(10);
        return view('admin.barang-masuk.index', compact('barangMasuks'));
    }

    public function create()
    {
        $produks = Produk::orderBy('nama')->get();
        return view('admin.barang-masuk.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string|max:500',
        ]);

        DB::transaction(function () use ($request) {
            // Catat barang masuk
            BarangMasuk::create([
                'produk_id' => $request->produk_id,
                'tanggal' => $request->tanggal,
                'jumlah' => $request->jumlah,
                'keterangan' => $request->keterangan,
            ]);

            // Update stok produk
            $produk = Produk::find($request->produk_id);
            $produk->incrementStok($request->jumlah);
        });

        return redirect()->route('admin.barang-masuk.index')->with('success', 'Barang masuk berhasil dicatat dan stok telah bertambah.');
    }
}
