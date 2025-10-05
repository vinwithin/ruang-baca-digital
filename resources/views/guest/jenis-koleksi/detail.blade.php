@extends('layout.index')
@section('content')
    <style>
        h4 {
            color: #043471;
            text-align: center;
            font-family: "Plus Jakarta Sans";
            font-size: 24px;
            font-style: normal;
            font-weight: 700;
            line-height: 32px;
        }

        table td {
            width: 50%;
        }
    </style>
    <section id="koleksi" class="">
        <div class="container-fluid mt-2 ">
            <h4 class="fw-bold text-center mt-5 mb-5">
                {{ $data->judul }}
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
                            <td>{{$data->admin->name ?? "Admin Ruang Baca Fakultas Sains dan Teknologi"}}</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Tanggal Input</td>
                            <td>{{ $data->created_at->format('d/m/Y') }}</td>

                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end align-items-center pt-3">

                <div class="col-12 col-md-6">
                    <a href="/dokumen/{{ $data->judul }}" class="btn btn-primary w-100">
                        Baca Dokumen <i class="bi bi-book"></i>
                    </a>
                </div>
            </div>

        </div>


    </section>
@endsection
