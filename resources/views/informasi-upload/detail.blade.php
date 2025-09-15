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
                                <td style="width: 50%;">Nama Admin</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold" style="width: 50%;">Tanggal Upload</td>
                                <td style="width: 50%;">{{ $data->created_at->format('d/m/Y') }}</td>

                            </tr>
                            <tr>
                                <td class="fw-semibold" style="width: 50%;">Status</td>
                                <td style="width: 50%;">
                                    @php
                                        $badgeClass = 'bg-secondary'; // default

                                        if ($data->status === 'Diproses') {
                                            $badgeClass = 'bg-warning';
                                        } elseif ($data->status === 'Disetujui') {
                                            $badgeClass = 'bg-success';
                                        } elseif ($data->status === 'Revisi') {
                                            $badgeClass = 'bg-danger';
                                        }
                                    @endphp
                                    <span class="badge {{ $badgeClass }}" @if ($data->status === 'Revisi')  @endif>
                                        {{ $data->status }}
                                    </span>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row g-2 mt-5">
                    <div class="col-12 col-md-12">
                        <a href="/informasi/dokumen/view/{{$data->file}}" class="btn btn-primary w-100" target="_blank">
                            Baca Dokumen <i class="bi bi-book"></i>
                        </a>
                    </div>
                </div>

                <div class="row g-2">
                    <div class="col-12 col-md-12">
                        @php
                            $borderClass = match ($data->status) {
                                'Revisi' => 'border-danger',
                                'Diproses' => 'border-warning',
                                'Disetujui' => 'border-success',
                                default => 'border-secondary',
                            };
                        @endphp

                        <div class="card p-3 border {{ $borderClass }}">
                            @if ($data->status === 'Revisi')
                                <p class="fw-bold text-danger">Pesan Revisi!</p>
                                <p>{{ $data->komentar }}</p>
                            @elseif($data->status === 'Diproses')
                                <p class="fw-bold text-warning">Dokumen Sedang Diproses</p>
                                <p>Harap menunggu dokumen diproses oleh admin</p>
                            @else
                                <p class="fw-bold text-success">Dokumen Disetujui</p>
                                <p>Silakan cetak surat keterangan</p>
                            @endif
                        </div>

                    </div>
                </div>



                <div class="d-flex justify-content-between">
                    <a href="/informasi/dokumen" class="btn btn-primary">
                        <i class="fa-solid fa-circle-arrow-left me-2"></i> Kembali
                    </a>
                    @if ($data->status === 'Revisi')
                        <a href="/dokumen/edit/{{ $data->uuid }}" class="btn btn-outline-warning">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    @elseif($data->status === 'Disetujui')
                        <a class="btn btn-outline-success" href="/dokumen/{{ $data->uuid }}"><i class="fa-solid fa-print"></i></a>
                    @endif


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
