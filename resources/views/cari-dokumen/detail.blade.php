@extends('layout.admin.app')
@section('title', 'Cari Dokumen Bacaan')
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
                                <td>
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
                                <td style="width: 50%;">Nama Admin</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold" style="width: 50%;">Tanggal Input</td>
                                <td style="width: 50%;">{{ $data->created_at->format('d/m/Y') }}</td>

                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row g-2 mt-5">
                    <div class="col-12 col-md-6">
                        @if (!$favorit)
                            <a href="/bookmark/tambah/{{ $data->uuid }}" class="btn btn-outline-primary w-100">
                                Simpan ke favorit <i class="fa-regular fa-star ms-2"></i>
                            </a>
                        @else
                            <a href="/bookmark/hapus/{{ $data->uuid }}" class="btn btn-primary text-white w-100">
                                Hapus ke favorit <i class="fa-regular fa-star ms-2"></i>
                            </a>
                        @endif
                    </div>
                    <div class="col-12 col-md-6">
                        <a href="/dokumen/{{ $data->judul }}" class="btn btn-primary w-100">
                            Baca Dokumen <i class="bi bi-book"></i>
                        </a>
                    </div>
                </div>



                <div class="">
                    <a href="/search/dokumen" class="btn btn-primary">
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
