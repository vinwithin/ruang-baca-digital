<?php

namespace App\Http\Controllers;

use App\Models\LaporanMahasiswa;
use Illuminate\Http\Request;

class LaporanValidasiController extends Controller
{
    public function index($uuid)
    {
        $data = LaporanMahasiswa::where('uuid', $uuid)->where('status', 'Disetujui')->first();
        if (!$data) {
            return view('guest.validasi.index', [
                'valid' => false,
                'message' => 'Laporan tidak ditemukan atau belum disetujui'
            ]);
        }
        return view('guest.validasi.index', [
            'valid' => true,
            'data' => $data,
            'message' => 'Laporan tervalidasi dengan benar'
        ]);
    }
}
