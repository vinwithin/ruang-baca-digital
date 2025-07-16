@extends('layout.admin.app')
@section('title', 'Informasi Status Upload')
@section('content')
    <style>
        .search-box {
            background-color: white;
            border-radius: 1rem;
        }

        .search-box input::placeholder {
            color: #aaa;
        }
    </style>
    <div class="w-100">
        <div class="card p-3 border rounded-3 shadow-sm">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="container mt-2">
                <h4 class="fw-bold text-center mb-4">
                    Analisis Kesesuaian Tugas Sistem Informasi Akademik (SIAKAD) terhadap Kinerja Dosen <br>
                    Menggunakan Metode Task Technology Fit (Studi Kasus Universitas Jambi)
                </h4>

                <div class="table-responsive rounded-4 border overflow-hidden">
                    <table class="table table-bordered mb-0">
                        <tbody>
                            <tr>
                                <td class="fw-semibold">Nama Mahasiswa</td>
                                <td>{{ $data->nama }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">NIM</td>
                                <td>{{ $data->identifier }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Kontributor/Dosen Pembimbing</td>
                                <td>{{ $data->dospem1 }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Jenis Koleksi</td>
                                <td><span class="badge text-bg-warning">{{ $data->jenis_dokumen->nama }}</span></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Tahun</td>
                                <td>{{ $data->tahun }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Program Studi</td>
                                <td>{{ $data->program_studi->nama }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Kata Kunci</td>
                                <td>{{ $data->kata_kunci }}</td>
                            </tr>

                            <tr>
                                <td class="fw-semibold">Tanggal Input</td>
                                <td>{{ $data->created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <a class="btn btn-primary px-4" href="{{ url('/dokumen/view/' . $data->file) }}">
                    Baca Dokumen <i class="bi bi-book"></i>
                </a>


                <div class="d-flex justify-content-between mt-4 flex-wrap gap-2">

                    <div>
                        <a href="#" class="btn btn-dark">
                            <i class="bi bi-arrow-left-circle"></i> Kembali
                        </a>
                    </div>
                    <div>
                        <a class="btn btn-sm btn-outline-warning text-dark"
                            href="/dokumen/reject/{{ $data->id }}">Kirim Revisi</a>
                        <a class="btn btn-sm btn-primary" href="/dokumen/approve/{{ $data->id }}">Terima</a>
                    </div>

                </div>


            </div>


        </div>
    </div>

@endsection
