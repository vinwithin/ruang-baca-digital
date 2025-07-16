<?php

namespace App\Http\Controllers;

use App\Models\LaporanMahasiswa;
use Illuminate\Http\Request;

class KelolaAjuanController extends Controller
{
    public function index()
    {
        return view('admin.kelola-ajuan.index', [
            'data' => LaporanMahasiswa::all(),
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

    public function reject($id)
    {
        $result = LaporanMahasiswa::where('id', $id)
            ->update(['status' => 'Revisi']);
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
