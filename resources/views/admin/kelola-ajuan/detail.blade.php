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

                <div class="container mt-3 pt-5">
                    <a class="btn btn-primary w-100 py-2" href="{{ url('/admin/dokumen/view/' . $data->file) }}">
                        Baca Dokumen <i class="bi bi-book"></i>
                    </a>
                </div>


                <div class="d-flex justify-content-between mt-2 flex-wrap gap-2">

                    <div>
                        <a href="/admin/dokumen" class="btn btn-primary">
                            <i class="bi bi-arrow-left-circle"></i> Kembali
                        </a>
                    </div>
                    <div>
                        <a href="javascript:void(0);" class="btn btn-sm btn-outline-warning text-dark"
                            data-bs-toggle="modal" data-bs-target="#revisiModal">
                            Kirim Revisi
                        </a>

                        <!-- Komponen modal -->
                        <x-reject-with-modal id="revisiModal" title="Kirim Revisi" action="{{ url('/dokumen/reject/' . $data->id) }}"
                            buttonText="Kirim" buttonClass="btn-warning">
                            <div class="mb-3">
                                <label for="komentar" class="form-label">Komentar Revisi</label>
                                <textarea name="komentar" id="komentar" class="form-control" rows="4" required></textarea>
                            </div>
                        </x-reject-with-modal>



                        <a class="btn btn-sm btn-primary" href="/dokumen/approve/{{ $data->id }}">Terima</a>
                    </div>

                </div>


            </div>


        </div>
    </div>

@endsection
