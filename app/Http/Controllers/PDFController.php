<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generateReport(Request $request)
    {
        // Sample data - replace with actual data from your database
        $data = [
            'header' => [
                'kementerian' => 'KEMENTERIAN PENDIDIKAN, KEBUDAYAAN,',
                'riset' => 'RISET, DAN TEKNOLOGI',
                'universitas' => 'UNIVERSITAS JAMI NURUL ULM',
                'fakultas' => 'FAKULTAS DAN TEKNOLOGI INFORMASI',
                'jurusan' => 'JURUSAN TEKNIK ELEKTRO DAN INFORMATIKA',
                'program_studi' => 'PROGRAM STUDI SISTEM INFORMASI',
                'alamat' => 'Jalan Raya Jambi - Muara Bulian Km.15 Mendalo Darat',
                'kode_pos' => 'Kode Pos 36361',
                'website' => 'http://fst.uinjambi.ac.id'
            ],
            'form_data' => [
                'nama' => $request->input('nama', 'Nama Mahasiswa'),
                'nomor_mahasiswa' => $request->input('nomor_mahasiswa', '123456'),
                'prodi' => $request->input('prodi', 'Sistem Informasi'),
                'judul_magang' => $request->input('judul_magang', 'Magang Teknologi Informasi')
            ],
            'evaluasi' => [
                'komunikasi' => $request->input('komunikasi', ''),
                'inisiatif' => $request->input('inisiatif', ''),
                'kerjasama' => $request->input('kerjasama', ''),
                'publikasi_media' => $request->input('publikasi_media', '')
            ],
            'penilaian' => [
                'tanda_tangan' => $request->input('tanda_tangan', ''),
                'prodi_signature' => $request->input('prodi_signature', ''),
                'pembimbing' => $request->input('pembimbing', ''),
                'perpustakaan_edukasi' => $request->input('perpustakaan_edukasi', '')
            ],
            'nama_penerna' => [
                'no_1' => $request->input('no_1', ''),
                'no_2' => $request->input('no_2', ''),
                'no_3' => $request->input('no_3', '')
            ],
            'informasi' => [
                'nama_pembimbing' => 'Pembimbing',
                'perpustakaan_edukasi' => 'Perpustakaan Edukasi',
                'catatan' => 'Demikian bukti penyerahan ini dibuat untuk dapat dipergunakan sebagaimana mestinya'
            ],
            'tanggal' => [
                'tempat' => 'Jambi',
                'program_studi' => 'Program Studi',
                'ketua_program' => 'Ketua Program Informasi',
                'nama_ketua' => 'Reni Apriyanti, S.Kom, M.SI',
                'nip' => 'NIP. 198012201350420'
            ]
        ];

        $pdf = Pdf::loadView('pdf.report-template', compact('data'))
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
                'defaultFont' => 'sans-serif'
            ]);

        return $pdf->download('laporan-evaluasi.pdf');
    }

    public function showForm()
    {
        return view('pdf.form');
    }
}
