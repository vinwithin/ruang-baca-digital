<?php

namespace App\Http\Controllers;

use App\Models\LaporanMahasiswa;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;


class PDFController extends Controller
{
    public function generateReport(LaporanMahasiswa $laporanmahasiswa)
    {
        // dd($laporanmahasiswa);
        $dataLaporan = LaporanMahasiswa::with(['user', 'jenis_dokumen', 'program_studi.jurusan'])
            ->findOrFail($laporanmahasiswa->id);
        // Sample data - replace with actual data from your database
        $data = [
            'header' => [
                'kementerian' => 'KEMENTERIAN PENDIDIKAN, KEBUDAYAAN,',
                'riset' => 'RISET, DAN TEKNOLOGI',
                'universitas' => 'UNIVERSITAS JAMBI',
                'fakultas' => 'FAKULTAS DAN TEKNOLOGI INFORMASI',
                'jurusan' => $dataLaporan->program_studi->jurusan->nama,
                'program_studi' => $dataLaporan->program_studi->nama,
                'alamat' => 'Jalan Raya Jambi - Muara Bulian Km.15 Mendalo Darat',
                'kode_pos' => 'Kode Pos 36361',
                'website' => 'https://fst.unja.ac.id'
            ],
            'title' => [
                'nama' => $dataLaporan->jenis_dokumen->nama
            ],
            'form_data' => [
                'nama' => $dataLaporan->nama,
                'nomor_mahasiswa' => $dataLaporan->identifier,
                'prodi' => $dataLaporan->program_studi->nama,
                'judul' => $dataLaporan->judul
            ],
            'signature' => [
                'tanggal' => now(),
                'validator' => $dataLaporan->admin->name,
                'nip' => $dataLaporan->admin->identifier,
                'qr_code' => $dataLaporan->qr_code,
            ],

        ];

        $pdf = Pdf::loadView('pdf.laporan', ['data' => $data])
            ->setPaper('a4', 'portrait');


        return $pdf->download('surat.pdf');
    }
}
