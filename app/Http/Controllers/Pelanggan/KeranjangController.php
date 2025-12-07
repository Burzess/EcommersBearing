<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjangs = Keranjang::with('produk.images')
            ->where('user_id', auth()->id())
            ->get();
        
        $subtotal = Keranjang::getGrandTotal(auth()->id());
        
        return view('pelanggan.keranjang.index', compact('keranjangs', 'subtotal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'quantity' => 'required|integer|min:1',
        ]);
        
        $produk = Produk::findOrFail($request->produk_id);
        
        // Check stok
        if ($produk->stok < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi. Stok tersedia: ' . $produk->stok);
        }
        
        // Check jika produk sudah ada di keranjang
        $keranjang = Keranjang::where('user_id', auth()->id())
            ->where('produk_id', $request->produk_id)
            ->first();
        
        if ($keranjang) {
            // Update quantity
            $newQuantity = $keranjang->quantity + $request->quantity;
            
            if ($produk->stok < $newQuantity) {
                return back()->with('error', 'Stok tidak mencukupi. Stok tersedia: ' . $produk->stok);
            }
            
            $keranjang->update(['quantity' => $newQuantity]);
        } else {
            // Buat baru
            Keranjang::create([
                'user_id' => auth()->id(),
                'produk_id' => $request->produk_id,
                'quantity' => $request->quantity,
                'harga' => $produk->harga_diskon ?? $produk->harga,
            ]);
        }
        
        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, $id)
    {
        $keranjang = Keranjang::where('user_id', auth()->id())->findOrFail($id);
        
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        
        // Check stok
        if ($keranjang->produk->stok < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi. Stok tersedia: ' . $keranjang->produk->stok);
        }
        
        $keranjang->update(['quantity' => $request->quantity]);
        
        return back()->with('success', 'Keranjang berhasil diupdate.');
    }

    public function destroy($id)
    {
        $keranjang = Keranjang::where('user_id', auth()->id())->findOrFail($id);
        $keranjang->delete();
        
        return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    public function clear()
    {
        Keranjang::where('user_id', auth()->id())->delete();
        
        return back()->with('success', 'Keranjang berhasil dikosongkan.');
    }
}
