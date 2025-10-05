@extends('layout.admin.app')
@section('title', 'Dokumen Favorit')
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

        p {
            font-style: italic;
        }
    </style>
    <div class="w-100">
        <div class="card p-5 border rounded-3 shadow-sm">
            <div class="container-fluid mt-2 clearfix">
                <h4 class="fw-bold text-center mb-4">
                    {{ $data->judul }}
                </h4>

                <div class="table-responsive rounded-4 border mb-5">
                    <table class="table table-bordered mb-0">
                        <tbody>
                            <tr>
                                <td class="fw-semibold" style="width: 50%;">Penulis</td>
                                <td style="width: 50%;">{{ $data->nama }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold" style="width: 50%;">Kontributor/Dosen Pembimbing</td>
                                <td style="width: 50%;">{{ $data->dospem1 }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold" style="width: 50%;">Jenis Koleksi</td>
                                <td style="width: 50%;">
                                    @php
                                        $jenisNama = $data->jenis_dokumen->nama;
                                        $badgeClass = 'bg-info'; // default

                                        if ($jenisNama === 'Skripsi') {
                                            $badgeClass = 'bg-secondary';
                                        } elseif ($jenisNama === 'Laporan Magang') {
                                            $badgeClass = 'bg-info';
                                        }
                                    @endphp

                                    <span class="badge {{ $badgeClass }}">{{ $jenisNama }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-semibold" style="width: 50%;">Tahun</td>
                                <td style="width: 50%;">{{ $data->tahun }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold" style="width: 50%;">Program Studi</td>
                                <td style="width: 50%;">{{ $data->program_studi->nama }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold" style="width: 50%;">Kata Kunci</td>
                                <td style="width: 50%;">{{ $data->kata_kunci }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold" style="width: 50%;">Petugas Input/Edit</td>
                                <td style="width: 50%;">
                                    {{ $data->admin->name ?? 'Admin Ruang Baca Fakultas Sains dan Teknologi' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold" style="width: 50%;">Tanggal Upload</td>
                                <td style="width: 50%;">{{ $data->created_at->format('d/m/Y') }}</td>

                            </tr>

                        </tbody>
                    </table>
                </div>

                <div class="row g-2 mt-5">
                    <div class="col-12 col-md-6">

                    </div>
                    <div class="col-12 col-md-6">
                        <a href="/dokumen/{{ $data->judul }}" class="btn btn-primary w-100" target="_blank">
                            Baca Dokumen <i class="fa-regular fa-book-open ms-2"></i>
                        </a>
                    </div>
                </div>




                <div class="d-flex justify-content-between">
                    <a href="/bookmarks" class="btn btn-primary">
                        <i class="fa-solid fa-circle-arrow-left me-2"></i> Kembali
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
