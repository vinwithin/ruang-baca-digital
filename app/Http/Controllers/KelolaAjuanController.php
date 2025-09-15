<?php

namespace App\Http\Controllers;

use App\Models\JenisDokumen;
use App\Models\LaporanMahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class KelolaAjuanController extends Controller
{
    public function index(Request $request)
    {
        $jenisDokumen = $request->input('jenis_dokumen');
        $prodi = $request->input('prodi');
        $search = $request->input('search');
        $status = $request->input('status');

        // Inisialisasi query dengan eager loading
        $data = LaporanMahasiswa::with('user.roles')
            ->whereHas('user.roles', function ($q) {
                $q->where('name', 'mahasiswa');
            });

        // Filter pencarian
        if (!empty($search)) {
            $data->where(function ($query) use ($search) {
                $query->where('judul', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%")
                    ->orWhere('identifier', 'like', "%{$search}%")
                    ->orWhere('kata_kunci', 'like', "%{$search}%");
            });
        }

        // Filter jenis dokumen
        if (!empty($jenisDokumen)) {
            $data->where('jenis_dokumen_id', $jenisDokumen);
        }

        // Filter program studi
        if (!empty($prodi)) {
            $data->where('program_studi_id', $prodi);
        }

        // Filter status
        if (!empty($status)) {
            $data->where('status', $status);
        }
        // dd($data->toSql(), $data->getBindings());

        $data = $data->latest()->paginate(10);
        return view('admin.kelola-ajuan.index', [
            'data' => $data,
            'jenis_dokumen' => JenisDokumen::all(),
            'prodi' => ProgramStudi::all()
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
