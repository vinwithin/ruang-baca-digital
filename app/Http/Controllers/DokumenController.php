<?php

namespace App\Http\Controllers;

use App\Models\JenisDokumen;
use App\Models\LaporanMahasiswa;
use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokumenController extends Controller
{
    public function index()
    {
        return view('laporan.index', [
            'prodi' => ProgramStudi::all(),
            'dospem' => User::role('dosen')->get(),
            'jenis_dokumen' => JenisDokumen::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'program_studi_id' => 'required|string',
            'identifier' => 'required|string|max:20',
            'jenis_dokumen_id' => 'required|string',
            'dospem1' => 'required|string|max:255',
            'dospem2' => 'required|string|max:255',
            'tahun' => 'required|integer|between:2020,2030',
            'judul' => 'required|string|max:500',
            'kata_kunci' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240', // Maksimal 10MB
            'dataConfirmation' => 'accepted', // Checkbox harus dicentang
        ]);

        // Proses upload file
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('dokumen', $fileName);
            $validatedData['file'] = $fileName;
        } else {
            return back()->withErrors(['file' => 'File dokumen wajib diunggah.']);
        }

        // Simpan ke database
        $validatedData['status'] = 'Diproses';
        $validatedData['user_id'] = Auth::user()->id; // Set user_id to the currently authenticated user
        $result = LaporanMahasiswa::create(
            $validatedData
        );
        if ($result) {
            return redirect()->route('informasi-dokumen')->with('success', 'Dokumen berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Gagal Menyimpan Dokumen.');
        }
    }

    public function edit(LaporanMahasiswa $laporanmahasiswa)
    {
        if ($laporanmahasiswa->status !== "Revisi") {
            return redirect()->back()->with('error', 'Tidak dapat mengedit dokumen.');
        }
        return view('laporan.edit', [
            'data' => LaporanMahasiswa::find($laporanmahasiswa->id),
            'prodi' => ProgramStudi::all(),
            'dospem' => User::role('dosen')->get(),
            'jenis_dokumen' => JenisDokumen::all(),
        ]);
    }

    public function update(Request $request, LaporanMahasiswa $laporanmahasiswa)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'program_studi_id' => 'required|string',
            'identifier' => 'required|string|max:20',
            'jenis_dokumen_id' => 'required|string',
            'dospem1' => 'required|string|max:255',
            'dospem2' => 'required|string|max:255',
            'tahun' => 'required|integer|between:2020,2030',
            'judul' => 'required|string|max:500',
            'kata_kunci' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // Maksimal 10MB
            'dataConfirmation' => 'accepted', // Checkbox harus dicentang
        ]);
        unset($validatedData['dataConfirmation']);
        // Proses upload file
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('dokumen', $fileName);
            $validatedData['file'] = $fileName;
        } else {
            return back()->withErrors(['file' => 'File dokumen wajib diunggah.']);
        }

        // Simpan ke database
        $validatedData['status'] = 'Diproses';
        $validatedData['user_id'] = Auth::user()->id; // Set user_id to the currently authenticated user

        $result = LaporanMahasiswa::where('id', $laporanmahasiswa->id)->update(
            $validatedData
        );
        if ($result) {
            return redirect()->route('informasi-dokumen')->with('success', 'Dokumen berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Gagal Menyimpan Dokumen.');
        }
    }
}
