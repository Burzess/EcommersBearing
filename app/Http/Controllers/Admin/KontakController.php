<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $kontak = Kontak::first();
        return view('admin.kontak.index', compact('kontak'));
    }

    public function edit()
    {
        $kontak = Kontak::first();
        
        if (!$kontak) {
            $kontak = new Kontak();
        }
        
        return view('admin.kontak.edit', compact('kontak'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'jam_operasional' => 'nullable|string|max:255',
            'google_maps_embed' => 'nullable|string',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'is_active' => 'boolean',
        ]);

        $kontak = Kontak::first();
        
        if (!$kontak) {
            $kontak = new Kontak();
        }

        $data = $request->only([
            'nama_perusahaan', 'alamat', 'telepon', 'whatsapp', 'email',
            'jam_operasional', 'google_maps_embed', 'facebook', 'instagram', 'twitter'
        ]);
        $data['is_active'] = $request->boolean('is_active');

        if ($kontak->exists) {
            $kontak->update($data);
        } else {
            Kontak::create($data);
        }

        return redirect()->route('admin.kontak.index')->with('success', 'Informasi Kontak berhasil diupdate.');
    }
}
