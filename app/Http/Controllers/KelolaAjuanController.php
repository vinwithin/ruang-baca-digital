<?php

namespace App\Http\Controllers;

use App\Models\JenisDokumen;
use App\Models\LaporanMahasiswa;
use Illuminate\Http\Request;

class KelolaAjuanController extends Controller
{
    public function index(Request $request)
    {
        $jenisDokumen = $request->input('jenis_dokumen');
        $search = $request->input('search');

        $data = LaporanMahasiswa::with('user.roles')
            ->whereHas('user.roles', function ($q) {
                $q->where('name', 'mahasiswa');
            });

        if ($search) {
            $data->where(function ($query) use ($search) {
                $query->where('judul', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%")
                    ->orWhere('identifier', 'like', "%{$search}%")
                    ->orWhere('kata_kunci', 'like', "%{$search}%");
            });
        }

        if ($jenisDokumen) {
            $data->where('jenis_dokumen_id', $jenisDokumen);
        }
        return view('admin.kelola-ajuan.index', [
            'data' => $data->latest()->paginate(10),
            'jenis_dokumen' => JenisDokumen::all(),
        ]);
    }
    public function show($id)
    {
        return view('admin.kelola-ajuan.detail', [
            'data' => LaporanMahasiswa::find($id)
        ]);
    }

    public function approve($id)
    {
        $result = LaporanMahasiswa::where('id', $id)
            ->update(['status' => 'Disetujui']);
        if ($result) {
            return redirect()->back()->with('success', 'Dokumen Berhasil Divalidasi.');
        } else {
            return redirect()->back()->with('error', 'Gagal Menvalidasi Dokumen.');
        }
    }

    public function reject(Request $request, $id)
    {
        $validateData = $request->validate([
            'komentar' => 'required|string|max:255',
        ]);
        $result = LaporanMahasiswa::where('id', $id)
            ->update(['status' => 'Revisi', 'komentar' => $validateData['komentar']]);
        if ($result) {
            return redirect()->back()->with('success', 'Dokumen Berhasil Ditolak.');
        } else {
            return redirect()->back()->with('error', 'Gagal Menolak Dokumen.');
        }
    }
    public function view($filename)
    {
        $path = storage_path('app/private/dokumen/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }
}
