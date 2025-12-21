<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TentangKami;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TentangKamiController extends Controller
{
    public function index()
    {
        $tentangKami = TentangKami::first();
        return view('admin.tentang-kami.index', compact('tentangKami'));
    }

    public function edit()
    {
        $tentangKami = TentangKami::first();
        
        if (!$tentangKami) {
            $tentangKami = new TentangKami();
        }
        
        return view('admin.tentang-kami.edit', compact('tentangKami'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $tentangKami = TentangKami::first();
        
        if (!$tentangKami) {
            $tentangKami = new TentangKami();
        }

        $data = $request->only(['judul', 'konten', 'visi', 'misi']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($tentangKami->gambar) {
                Storage::disk('public')->delete($tentangKami->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('tentang-kami', 'public');
        }

        if ($tentangKami->exists) {
            $tentangKami->update($data);
        } else {
            TentangKami::create($data);
        }

        return redirect()->route('admin.tentang-kami.index')->with('success', 'Halaman Tentang Kami berhasil diupdate.');
    }
}
