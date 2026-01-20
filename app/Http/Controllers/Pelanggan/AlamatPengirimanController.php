<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pelanggan\AlamatRequest;
use App\Models\Alamat;
use Illuminate\Http\Request;

class AlamatPengirimanController extends Controller
{
    public function store(AlamatRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        // Jika ini alamat pertama, set sebagai default
        if (!auth()->user()->alamats()->exists()) {
            $data['is_default'] = true;
        }

        Alamat::create($data);

        return back()->with('success', 'Alamat berhasil ditambahkan.');
    }

    public function update(AlamatRequest $request, $id)
    {
        $alamat = Alamat::where('user_id', auth()->id())->findOrFail($id);

        $alamat->update($request->validated());

        return back()->with('success', 'Alamat berhasil diupdate.');
    }

    public function destroy($id)
    {
        $alamat = Alamat::where('user_id', auth()->id())->findOrFail($id);

        // Jika alamat adalah default, set alamat lain sebagai default
        if ($alamat->is_default) {
            $nextAlamat = Alamat::where('user_id', auth()->id())
                ->where('id', '!=', $id)
                ->first();

            if ($nextAlamat) {
                $nextAlamat->setAsDefault();
            }
        }

        $alamat->delete();

        return back()->with('success', 'Alamat berhasil dihapus.');
    }

    public function setDefault($id)
    {
        $alamat = Alamat::where('user_id', auth()->id())->findOrFail($id);
        $alamat->setAsDefault();

        return back()->with('success', 'Alamat default berhasil diupdate.');
    }
}
