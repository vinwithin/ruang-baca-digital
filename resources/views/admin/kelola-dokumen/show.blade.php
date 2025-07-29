@extends('layout.admin.app')
@section('title', 'Kelola Dokumen')
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
            <div class="container mt-2">
                <h4 class="fw-bold text-center mb-4">
                    {{ $data->judul }}
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
                                <td class="fw-semibold">Nama Dosen Pembimbing</td>
                                <td>{{ $data->dosen1->name }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Jenis Koleksi</td>
                                <td>
                                    <span class="badge bg-primary px-3 py-2">{{ $data->jenis_dokumen->nama }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Program Studi</td>
                                <td>{{ $data->program_studi->nama }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Tahun</td>
                                <td>{{ $data->tahun }}</td>
                            </tr>

                            <tr>
                                <td class="fw-semibold">Kata Kunci</td>
                                <td>{{ $data->kata_kunci }}</td>
                            </tr>

                            <tr>
                                <td class="fw-semibold">Tanggal Upload</td>
                                <td>{{ $data->created_at->format('d/m/Y') }}</td>
                            </tr>

                            <tr>
                                <td class="fw-semibold">Status</td>
                                <td>
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
                                    <span class="badge px-3 py-2 {{ $badgeClass }}"
                                        @if ($data->status === 'Revisi') data-bs-toggle="modal" 
                                            data-bs-target="#modalRevisi-{{ $data->id }}"
                                            style="cursor: pointer" @endif>
                                        {{ $data->status }}
                                        @if ($data->status === 'Revisi')
                                            <i class="fa-solid fa-circle-info"></i>
                                        @endif
                                    </span>

                                    <div class="modal fade" id="modalRevisi-{{ $data->id }}" tabindex="-1"
                                        aria-labelledby="modalRevisiLabel-{{ $data->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalRevisiLabel-{{ $data->id }}">
                                                        Catatan Revisi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Tutup"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{ $data->komentar ?? 'Tidak ada catatan revisi.' }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="container mt-3 pt-5">
                    <a class="btn btn-primary w-100 py-2" href="{{ url('/admin/dokumen/view/' . $data->file) }}"
                        target="_blank">
                        Baca Dokumen <i class="fa-solid fa-book-open"></i>
                    </a>
                </div>


                <div class="d-flex justify-content-between mt-2 flex-wrap gap-2">

                    <div>
                        <a href="/admin/kelola-dokumen" class="btn btn-primary">
                            <i class="fa-solid fa-circle-arrow-left me-2"></i> Kembali
                        </a>
                    </div>
                    <div>

                        <a href="/admin/kelola-dokumen/edit/{{ $data->uuid }}" class="btn btn-warning">Edit</a>
                        <a href="/admin/kelola-dokumen/delete/{{ $data->uuid }}" class="btn btn-outline-danger">Hapus</a>

                    </div>

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
