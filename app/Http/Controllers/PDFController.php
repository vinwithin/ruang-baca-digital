<?php

namespace App\Http\Controllers;

use App\Models\LaporanMahasiswa;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\LaravelPdf\Enums\Format;

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
            'evaluasi' => [
                'komunikasi' => '',
                'inisiatif' => '',
                'kerjasama' => '',
                'publikasi_media' => ''
            ],
            'penilaian' => [
                'tanda_tangan' => '',
                'prodi_signature' => '',
                'pembimbing' => '',
                'perpustakaan_edukasi' => ''
            ],
            'nama_penerna' => [
                'no_1' => '',
                'no_2' => '',
                'no_3' => ''
            ],
            'informasi' => [
                'nama_pembimbing' => 'Pembimbing',
                'perpustakaan_edukasi' => 'Perpustakaan Edukasi',
                'catatan' => 'Demikian bukti penyerahan ini dibuat untuk dapat dipergunakan sebagaimana mestinya'
            ],
            'tanggal' => [
                'tempat' => 'Jambi',
                'program_studi' => 'Program Studi',
                'ketua_program' => $dataLaporan->program_studi->nama,
                'nama_ketua' => '',
                'nip' => 'NIP. '
            ]
        ];
        if ($dataLaporan->jenis_dokumen->nama === "Skripsi") {
            $pdf = Pdf::view('pdf.surat', ['data' => $data])
                ->format(Format::A4);
        } else {
            $pdf = Pdf::view('pdf.laporan', ['data' => $data])
                ->format(Format::A4);
        }


        return $pdf;
    }
}
