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

    public function skripsi()
    {
        return view('guest.jenis-koleksi.skripsi');
    }
}
