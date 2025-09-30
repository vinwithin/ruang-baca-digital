<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth/register');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'identifier' => ['required', 'string', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed'],
            'confirm' => 'required|accepted',
        ]);
        $validateData['department'] = 'Fakultas Sains dan Teknologi';
        $validateData['progam_studi_id'] = 13;
        $validateData['password'] = Hash::make($validateData['password']);
        try {
           DB::beginTransaction();
            $user = User::create($validateData);
            $user->assignRole('mahasiswa');
            DB::commit();
            event(new Registered($user));

            return redirect()->route('login')
                ->with('success', 'Registrasi berhasil! Silakan cek email untuk verifikasi sebelum login.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat registrasi. Silakan coba lagi.');
        }
    }
}
