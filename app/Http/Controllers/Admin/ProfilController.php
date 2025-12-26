<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfilController extends Controller
{
    public function index()
    {
        return view('admin.profil.index');
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telepon' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);
        
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'telepon' => $request->telepon,
        ];
        
        // Upload avatar jika ada
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = 'avatar_' . $user->id . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public/avatar', $avatarName);
            $data['avatar'] = 'avatar/' . $avatarName;
        }
        
        // Update password jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        
        $user->update($data);
        
        return back()->with('success', 'Profil berhasil diupdate.');
    }
}
