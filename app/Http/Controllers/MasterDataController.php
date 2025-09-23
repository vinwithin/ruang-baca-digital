<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MasterDataController extends Controller
{
    public function index()
    {
        return view('admin.master.index', [
            'data' => User::latest()->paginate(10),
        ]);
    }
    public function create()
    {
        return view('admin.master.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validateData = $request->validate([
            'identifier' => ['required', 'string', 'unique:' . User::class],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed'],
        ]);
        $validateData['department'] = 'Fakultas Sains dan Teknologi';
        // $validateData['progam_studi_id'] = 13;
        $validateData['password'] = Hash::make($validateData['password']);
        try {

            $user = User::create($validateData);
            $user->assignRole('mahasiswa');
            event(new Registered($user));

            return redirect()->route('kelola-pengguna.index')
                ->with('success', 'Pengguna berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menambahkan pengguna. Silakan coba lagi.');
        }
    }
    public function edit($id)
    {
        return view('admin.master.edit', [
            'data' => User::findOrFail($id)
        ]);
    }
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'identifier' => ['required', 'string', 'unique:users,identifier,' . $id],
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $id],
            'password' => ['required', 'string', 'confirmed'],
        ]);

        $validateData['password'] = Hash::make($validateData['password']);
        try {

            User::where('id', $id)->update($validateData);
            return redirect()->route('kelola-pengguna.index')
                ->with('success', 'Pengguna berhasil diedit');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat mengedit pengguna. Silakan coba lagi.');
        }
    }
    public function active($id)
    {
        // $oldStatus = $seller->status;

        User::where('id', $id)->update([
            'status' => 'Aktif',
        ]);

        return redirect()->back()->with('success', 'Berhasil mengupdate status pengguna!');
    }
    public function nonactive($id)
    {
        User::where('id', $id)->update([
            'status' => 'Tidak aktif',
        ]);

        return redirect()->back()->with('success', 'Berhasil mengupdate status pengguna!');
    }
}
