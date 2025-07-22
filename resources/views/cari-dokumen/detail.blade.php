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

        .btn {
            position: static !important;
        }
    </style>
    <div class="w-100">
        <div class="card p-5 border rounded-3 shadow-sm">
            <div class="container-fluid mt-2 clearfix">
                <h4 class="fw-bold text-center mb-4">
                    Analisis Kesesuaian Tugas Sistem Informasi Akademik (SIAKAD) terhadap Kinerja Dosen <br>
                    Menggunakan Metode Task Technology Fit (Studi Kasus Universitas Jambi)
                </h4>

                <div class="table-responsive rounded-4 border mb-5">
                    <table class="table table-bordered mb-0">
                        <tbody>
                            <tr>
                                <td class="fw-semibold">Penulis</td>
                                <td>{{ $data->nama }}</td>
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
                                <td class="fw-semibold">Petugas Input/Edit</td>
                                <td>Nama Admin</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Tanggal Input</td>
                                <td>{{ $data->created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row g-2 mt-5">
                    <div class="col-12 col-md-6">
                        @if (!$favorit)
                            <a href="/bookmark/tambah/{{ $data->uuid }}" class="btn btn-outline-primary w-100">
                                Simpan ke favorit <i class="fa-solid fa-star"></i>
                            </a>
                        @else
                            <a href="/bookmark/hapus/{{ $data->uuid }}" class="btn btn-outline-primary w-100">
                                Hapus ke favorit <i class="fa-solid fa-star"></i>
                            </a>
                        @endif
                    </div>
                    <div class="col-12 col-md-6">
                        <a href="/dokumen/{{ $data->judul }}" class="btn btn-primary w-100">
                            Baca Dokumen <i class="bi bi-book"></i>
                        </a>
                    </div>
                </div>



                <div class="mt-4">
                    <a href="/search/dokumen" class="btn btn-dark">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </a>
                </div>
            </div>


        </div>
    </div>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33',
            });
        @endif
    </script>
@endsection
