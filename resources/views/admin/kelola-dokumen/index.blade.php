@extends('layout.admin.app')
@section('title', 'Kelola Dokumen')
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
                <h5 class="fw-bold">Daftar Dokumen</h5>
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#filterSection"
                    aria-expanded="false" aria-controls="filterSection">
                    <i class="fas fa-filter me-2"></i>Filter
                </button>

            </div>
            <div class="collapse mt-3" id="filterSection">
                <div class="card card-body border shadow-sm">
                    <form method="GET" action="{{ route('admin.kelola-dokumen') }}">
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
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-filter me-1"></i> Terapkan Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-header d-flex justify-content-between align-items-center">
                <a class="btn btn-primary" href="{{ route('admin.kelola-dokumen.unggah') }}"><i
                        class="fa-solid fa-plus me-2"></i>Tambah
                    Dokumen</a>
                <form action="{{ route('admin.kelola-dokumen') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari kegiatan..."
                            value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search"></i> Cari
                        </button>
                        <a href="{{ route('admin.kelola-dokumen') }}" class="btn btn-primary ms-2">Atur Ulang</a>

                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-wrapper border rounded-3 overflow-hidden">

                    <table class="table align-middle  overflow-hidden">
                        <thead class="table-light text-start">
                            <tr>
                                <th>No</th>
                                <th>Tanggal Input</th>
                                <th>Judul</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th>Jenis Koleksi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->created_at->format('d/m/Y') }}</td>


                                    <td style="max-width: 300px;">
                                        {{ $item->judul }}
                                    </td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->program_studi->nama }}</td>
                                    <td>
                                        <span class="badge bg-primary px-4 py-2">{{ $item->jenis_dokumen->nama }}</span>
                                    </td>

                                    <td>
                                        <a href="/admin/kelola-dokumen/detail/{{ $item->uuid }}"
                                            class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                                        <a href="/admin/kelola-dokumen/edit/{{ $item->uuid }}"
                                            class="btn btn-outline-warning"><i class="fa-solid fa-pen-to-square"
                                                style="color: #FFD43B;"></i></a>
                                        <a href="/admin/kelola-dokumen/delete/{{ $item->uuid }}"
                                            class="btn btn-outline-danger"><i class="fa-solid fa-trash-can"
                                                style="color: #ff2600;"></i></a>

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
