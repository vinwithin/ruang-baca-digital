<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth/register');
    }

    public function store(Request $request)
    {
        // try {
            $validateData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'identifier' => ['required', 'string'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'string', 'confirmed']
            ]);
            $validateData['department'] = 'Fakultas Sains dan Teknologi';
            $validateData['progam_studi_id'] = 13;
            $validateData['password'] = Hash::make($validateData['password']);

            $user = User::create($validateData);
            $user->assignRole('mahasiswa');

            return redirect()->route('login')
                ->with('success', 'Registrasi berhasil! Silakan login.');
        // } catch (\Exception $e) {
        //     return redirect()->back()
        //         ->withInput()
        //         ->with('error', 'Terjadi kesalahan saat registrasi. Silakan coba lagi.');
        // }
    }
}
