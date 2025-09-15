@extends('layout.admin.app')
@section('title', 'Kelola Ajuan Mahasiswa')
@section('content')
    <style>
        .table-wrapper {
            border: 5px solid #dee2e6;
            border-radius: 0.75rem;
            /* rounded-3 */
            overflow: hidden;
        }

        .table td,
        .table th {
            border: none !important;
        }
    </style>
    <div class="w-100">
        <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold">Daftar seluruh ajuan dari Mahasiswa</h5>
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#filterSection"
                    aria-expanded="false" aria-controls="filterSection">
                    <i class="fas fa-filter me-2"></i>Filter
                </button>

            </div>
            <div class="collapse mt-3" id="filterSection">
                <div class="card card-body border shadow-sm">
                    <form method="GET" action="{{ route('admin-dokumen') }}">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-4">
                                <label for="jenis_dokumen" class="form-label text-dark fw-semibold">Jenis Dokumen</label>
                                <select name="jenis_dokumen" id="jenis_dokumen" class="form-select">
                                    <option value="">Pilih Dokumen</option>
                                    @foreach ($jenis_dokumen as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="prodi" class="form-label text-dark fw-semibold">Program Studi</label>
                                <select name="prodi" id="prodi" class="form-select">
                                    <option value="">Pilih Program Studi</option>
                                    @foreach ($prodi as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="status" class="form-label text-dark fw-semibold">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="Status">Status</option>
                                    <option value="Diproses">Diproses</option>
                                    <option value="Revisi">Revisi</option>
                                    <option value="Disetujui">Disetujui</option>
                                   
                                </select>
                            </div>
                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-filter me-1"></i> Terapkan Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-header d-flex justify-content-end align-items-end">

                <form action="{{ route('admin-dokumen') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari kegiatan..."
                            value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search"></i> Cari
                        </button>
                        <a href="{{ route('admin-dokumen') }}" class="btn btn-primary ms-2">Atur Ulang</a>

                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-wrapper border rounded-3 overflow-scroll">

                    <table class="table align-middle  overflow-hidden">
                        <thead class="table-light text-start">
                            <tr>
                                <th style="text-align: center;">No</th>
                                <th>Tanggal Ajuan</th>
                                <th>Judul</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th>Jenis Koleksi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                                    <td>{{ $item->created_at->format('d/m/Y') }}</td>


                                    <td style="max-width: 300px;">
                                        {{ $item->judul }}
                                    </td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->program_studi->nama }}</td>
                                    <td>
                                        @php
                                            $jenisNama = $item->jenis_dokumen->nama;
                                            $badgeClass = 'bg-info'; // default

                                            if ($jenisNama === 'Skripsi') {
                                                $badgeClass = 'bg-secondary';
                                            } elseif ($jenisNama === 'Laporan Magang') {
                                                $badgeClass = 'bg-info';
                                            }
                                        @endphp

                                        <span class="badge {{ $badgeClass }}">{{ $jenisNama }}</span>
                                    </td>
                                    <td>
                                        @php
                                            $badgeClass = 'bg-secondary'; // default

                                            if ($item->status === 'Diproses') {
                                                $badgeClass = 'bg-warning';
                                            } elseif ($item->status === 'Disetujui') {
                                                $badgeClass = 'bg-success-subtle ';
                                            } elseif ($item->status === 'Revisi') {
                                                $badgeClass = 'bg-secondary-subtle';
                                            }
                                        @endphp
                                        <span class="badge {{ $badgeClass }}"
                                            @if ($item->status === 'Revisi') data-bs-toggle="modal" 
                                            data-bs-target="#modalRevisi-{{ $item->id }}"
                                            style="cursor: pointer" @endif>
                                            {{ $item->status }}
                                            @if ($item->status === 'Revisi')
                                                <i class="fa-solid fa-circle-info ms-2"></i>
                                            @endif
                                        </span>

                                        <div class="modal fade" id="modalRevisi-{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="modalRevisiLabel-{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalRevisiLabel-{{ $item->id }}">
                                                            Catatan Revisi</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Tutup"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ $item->komentar ?? 'Tidak ada catatan revisi.' }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-dismiss="modal">Oke</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="/admin/dokumen/{{ $item->id }}"><i
                                                class="fa-solid fa-eye"></i></a>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
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
