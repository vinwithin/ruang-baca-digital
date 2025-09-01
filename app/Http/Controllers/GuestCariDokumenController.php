<?php

namespace App\Http\Controllers;

use App\Models\JenisDokumen;
use App\Models\LaporanMahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class GuestCariDokumenController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        $keyword = $request->input('keyword');
        $prodi = $request->input('prodi');
        $koleksi = $request->input('koleksi');
        $tahun = $request->input('tahun');

        // Query builder dasar
        $query = LaporanMahasiswa::query()->where('status', 'Disetujui')
            ->when($keyword, fn($q) => $q->where('judul', 'like', "%$keyword%"))
            ->when($prodi, fn($q) => $q->where('program_studi_id', $prodi))
            ->when($koleksi, fn($q) => $q->where('jenis_dokumen_id', $koleksi))
            ->when($tahun, fn($q) => $q->where('tahun', $tahun));

        $data = $query->latest()->get();

        return view('guest.pencarian.index', [
            'data' => $data,
            'prodi' => ProgramStudi::all(),
            'jenis' => JenisDokumen::all()
        ]);
    }
}
