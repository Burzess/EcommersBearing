<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfilController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $alamats = $user->alamats;

        return view('pelanggan.profil.index', compact('user', 'alamats'));
    }

    public function updatePribadi(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telepon' => 'nullable|string|max:20',
        ]);

        $user->update($request->only(['name', 'email', 'telepon']));

        return back()->with('success', 'Informasi pribadi berhasil diupdate.');
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Validate current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password berhasil diupdate.');
    }

    public function updateAvatar(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = 'avatar_' . $user->id . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public/avatar', $avatarName);

            $user->update(['avatar' => 'avatar/' . $avatarName]);

            return back()->with('success', 'Avatar berhasil diupdate.');
        }

        return back()->with('error', 'Gagal upload avatar.');
    }

    public function updateNotifikasi(Request $request)
    {
        $user = auth()->user();

        $user->update([
            'notifikasi_email' => $request->has('notifikasi_email'),
            'notifikasi_order' => $request->has('notifikasi_order'),
            'notifikasi_promo' => $request->has('notifikasi_promo'),
        ]);

        return back()->with('success', 'Pengaturan notifikasi berhasil diupdate.');
    }
}
