<?php

namespace App\Http\Controllers;

use App\Models\Favorit;
use App\Models\JenisDokumen;
use App\Models\LaporanMahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CariDokumenController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->input('search');
        $prodi = $request->input('prodi');
        $koleksi = $request->input('koleksi');
        $tahun = $request->input('tahun');

        // Query builder dasar
        $query = LaporanMahasiswa::query();

        // Filter berdasarkan input (jika ada)
        if ($keyword) {
            $query->where('judul', 'like', '%' . $keyword . '%');
        }

        if ($prodi) {
            $query->where('program_studi_id', $prodi);
        }

        if ($koleksi) {
            $query->where('jenis_dokumen_id', $koleksi);
        }

        if ($tahun) {
            $query->whereYear('created_at', $tahun); // Atau gunakan field 'tahun_terbit' jika ada
        }

        // Eksekusi query
        $data = $query->latest()->get();
        return view('cari-dokumen.index', [
            'data' => $data,
            'prodi' => ProgramStudi::all(),
            'jenis_dokumen' => JenisDokumen::all()
        ]);
    }
    public function show($id)
    {
        return view('cari-dokumen.detail', [
            'data' => LaporanMahasiswa::find($id),
            'favorit' => Favorit::where([
                'laporan_id' => $id,
                'user_id' => Auth::user()->id
            ])->exists()

        ]);
    }
    public function store($id)
    {
        $result = Favorit::create([
            'user_id' => Auth::user()->id,
            'laporan_id' => $id
        ]);
        if ($result) {
            return redirect()->back()->with('success', 'Dokumen Berhasil Disimpan ke Favorit.');
        } else {
            return redirect()->back()->with('error', 'Gagal Menyimpan Dokumen ke Favorit.');
        }
    }
    public function destroy($id)
    {
        $result = Favorit::where([
            'user_id' => Auth::user()->id,
            'laporan_id' => $id
        ])->delete();
        if ($result) {
            return redirect()->back()->with('success', 'Dokumen Berhasil Dihapus ke Favorit.');
        } else {
            return redirect()->back()->with('error', 'Gagal Menghapus Dokumen dari Favorit.');
        }
    }
}
