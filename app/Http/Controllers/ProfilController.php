<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        return view('profil.index', [
            'data' => User::where('id', Auth::user()->id)->firstOrFail(),
        ]);
    }

    public function profile(Request $request)
    {
        return view('profil.profile.index', [
            'data' => User::where('id', Auth::user()->id)->firstOrFail(),
        ]);
    }
    public function storeProfile(Request $request)
    {
        $validateData = $request->validate([
            'identifier' => 'required|string|max:255|unique:users,identifier,' . Auth::user()->id,
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('foto_profil')) {
            $foto_name = time() . '_' . $request->foto_profil->getClientOriginalName();
            $path = $request->foto_profil->storeAs('foto_profil', $foto_name, 'public');
            $validateData['foto_profil'] = $path;
        }
        $user = User::where('id', Auth::user()->id)->firstOrFail();
        $result = $user->update($validateData);
        if (!$result) {
            return redirect()->back()->with('error', 'Gagal mengupdate foto profil.');
        } else {
            return redirect()->route('profil')->with('success', 'Foto profil berhasil diupdate.');
        }
    }
    public function password(Request $request)
    {
        return view('profil.password.index', [
            'data' => User::where('id', Auth::user()->id)->firstOrFail(),
        ]);
    }
    public function storePassword(Request $request)
    {
        $validateData = $request->validate([
            'old_password' => 'required|string|min:8',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('id', Auth::user()->id)->firstOrFail();

        if (!Hash::check($validateData['old_password'], $user->password)) {
            return redirect()->back()->with('error', 'Kata sandi lama tidak sesuai.');
        }

        $user->password = Hash::make($validateData['password']);
        $result = $user->save();

        if (!$result) {
            return redirect()->back()->with('error', 'Gagal mengupdate kata sandi.');
        } else {
            return redirect()->route('profil')->with('success', 'Kata sandi berhasil diganti.');
        }
    }
}
