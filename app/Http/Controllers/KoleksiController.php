<?php

namespace App\Http\Controllers;

use App\Models\JenisDokumen;
use App\Models\LaporanMahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class KoleksiController extends Controller
{
    public function index(JenisDokumen $jenisdokumen)
    {
        return view('guest.jenis-koleksi.index', [
            'data' => LaporanMahasiswa::where('jenis_dokumen_id', $jenisdokumen->id)
                ->where('status', 'Disetujui')
                ->get(),
            'title' => JenisDokumen::findOrFail($jenisdokumen->id),
            'prodi' => ProgramStudi::all(),
            'jenis' => JenisDokumen::all()
        ]);
    }

    public function koleksi(ProgramStudi $programstudi)
    {
        return view('guest.prodi.index', [
            'data_skripsi' => LaporanMahasiswa::with('jenis_dokumen')
                ->where('program_studi_id', $programstudi->id)
                ->where('status', 'Disetujui')
                ->whereHas('jenis_dokumen', function ($q) {
                    $q->where('nama', 'Skripsi');
                })
                ->paginate(10),
            'data_laporan' => LaporanMahasiswa::with('jenis_dokumen')
                ->where('program_studi_id', $programstudi->id)
                ->where('status', 'Disetujui')
                ->whereHas('jenis_dokumen', function ($q) {
                    $q->where('nama', 'Laporan Magang');
                })
                ->paginate(10),
            'title' => ProgramStudi::findOrFail($programstudi->id),
            'prodi' => ProgramStudi::all(),
            'jenis' => JenisDokumen::all()
        ]);
    }
    public function detail(LaporanMahasiswa $laporanmahasiswa)
    {
        return view('guest.jenis-koleksi.detail', [
            'data' => LaporanMahasiswa::where('id', $laporanmahasiswa->id)
                ->get(),
            'prodi' => ProgramStudi::all(),
            'jenis' => JenisDokumen::all()
        ]);
    }
}
