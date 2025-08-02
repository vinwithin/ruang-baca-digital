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
                ->take(5)
                ->get(),
            'data_laporan' => LaporanMahasiswa::with('jenis_dokumen')
                ->where('program_studi_id', $programstudi->id)
                ->where('status', 'Disetujui')
                ->whereHas('jenis_dokumen', function ($q) {
                    $q->where('nama', 'Laporan Magang');
                })
                ->take(5)
                ->get(),
            'title' => ProgramStudi::findOrFail($programstudi->id),
            'prodi' => ProgramStudi::all(),
            'jenis' => JenisDokumen::all()
        ]);
    }
    // public function detail(JenisDokumen $jenisdokumen)
    // {
    //     return view('guest.produ.detail', [
    //         'data' => LaporanMahasiswa::where('jenis_dokumen_id', $jenisdokumen->id)
    //             ->where('status', 'Disetujui')
    //             ->paginate(10),
    //         'title' => JenisDokumen::findOrFail($jenisdokumen->id),
    //         'prodi' => ProgramStudi::all(),
    //         'jenis' => JenisDokumen::all()
    //     ]);
    // }
    public function show(LaporanMahasiswa $laporanmahasiswa)
    {
        // dd($laporanmahasiswa->id);
        return view('guest.jenis-koleksi.detail', [
            'data' => $laporanmahasiswa,
            'prodi' => ProgramStudi::all(),
            'jenis' => JenisDokumen::all()
        ]);
    }
}
