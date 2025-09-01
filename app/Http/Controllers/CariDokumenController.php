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
        $keyword = $request->input('keyword');
        $prodi = $request->input('prodi');
        $koleksi = $request->input('koleksi');
        $tahun = $request->input('tahun');

        // Query builder dasar
        $query = LaporanMahasiswa::query()->where('status', 'Disetujui');
        $judul = null;
        // Filter berdasarkan input (jika ada)
        if ($keyword) {
            $query->where('judul', 'like', '%' . $keyword . '%');
            $judul = 'Hasil Pencarian Anda';
        }

        if ($prodi) {
            $query->where('program_studi_id', $prodi);
            $judul = 'Hasil Pencarian Anda';
        }

        if ($koleksi) {
            $query->where('jenis_dokumen_id', $koleksi);
            $judul = 'Hasil Pencarian Anda';
        }

        if ($tahun) {
            $query->where('tahun', $tahun); // Atau gunakan field 'tahun_terbit' jika ada
            $judul = 'Hasil Pencarian Anda';
        }
        $title = $judul ? $judul : 'Daftar skripsi dan laporan magang terbaru di Fakultas Sains dan Teknologi';

        // Eksekusi query
        $data = $query->latest()->get();
        return view('cari-dokumen.index', [
            'data' => $data,
            'title' => $title,
            'prodi' => ProgramStudi::all(),
            'jenis_dokumen' => JenisDokumen::all()
        ]);
    }
    public function show(LaporanMahasiswa $laporanmahasiswa)
    {
        return view('cari-dokumen.detail', [
            'data' => $laporanmahasiswa,
            'favorit' => Favorit::where([
                'laporan_id' => $laporanmahasiswa->uuid,
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

    public function view(LaporanMahasiswa $laporanmahasiswa)
    {
        return view('cari-dokumen.view', [
            'data' => $laporanmahasiswa
        ]);
    }

    public function stream(LaporanMahasiswa $laporanmahasiswa)
    {

        $path = storage_path('app/private/dokumen/' . $laporanmahasiswa->file);

        if (!file_exists($path)) {
            abort(404);
        }
        $sessionKey = 'viewed_laporan_' . $laporanmahasiswa->id;

        if (!session()->has($sessionKey)) {
            $laporanmahasiswa->increment('view_count');
            session()->put($sessionKey, true);
        }

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $laporanmahasiswa->file . '"',
            'X-Frame-Options' => 'SAMEORIGIN',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ]);
    }
}
