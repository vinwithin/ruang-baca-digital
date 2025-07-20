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
        <div class="card my-4">
            <form action="/cari-dokumen" method="GET">
                <div class="search-box shadow p-3 rounded-4 bg-white d-flex flex-column gap-3">

                    {{-- Baris atas: Search input + Tombol --}}
                    <div class="d-flex flex-column flex-md-row align-items-stretch gap-2">
                        <div class="flex-grow-1 d-flex align-items-center border-bottom">
                            <i class="fa-solid fa-magnifying-glass me-2"></i>
                            <input type="text" name="keyword" class="form-control border-0 shadow-none"
                                placeholder="Cari dokumen...">
                        </div>
                        <button type="submit" class="btn btn-primary rounded-4">Cari</button>
                    </div>

                    {{-- Baris bawah: Filter Dropdowns --}}
                    <div class="filter d-flex gap-3 flex-wrap justify-content-start justify-content-md-start">
                        <!-- Program Studi -->
                        <div class="dropdown d-flex align-items-center gap-2">
                            <i class="fa-solid fa-graduation-cap"></i>
                            <select class="form-select" name="prodi">
                                <option value="">Program Studi</option>
                                @foreach ($prodi as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>


                        <!-- Koleksi -->
                        <div class="dropdown d-flex align-items-center gap-2">
                            <i class="fa-solid fa-file-lines"></i>
                            <select class="form-select" name="koleksi">
                                <option value="">Koleksi</option>
                                @foreach ($jenis_dokumen as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tahun -->
                        <div class="dropdown d-flex align-items-center gap-2">
                            <i class="fa-solid fa-calendar"></i>
                            <select class="form-select" name="tahun">
                                <option value="">Tahun</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                            </select>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>
    {{-- <div class="w-100 "> --}}
    <div class="card p-5 border rounded-3 shadow-sm">
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
        <h3 class="pb-3 fw-bold">Hasil pencarian anda</h3>
        <div class="table-wrapper border rounded-3 overflow-hidden">
            <table class="table align-middle mb-0">
                <thead class="table-light text-start">
                    <tr>
                        <th>Judul</th>
                        <th>Nama</th>
                        <th>Program Studi</th>
                        <th>Jenis Koleksi</th>
                        <th>Tahun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td style="max-width: 300px;">{{ $item->judul }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->program_studi->nama }}</td>
                            <td><span class="badge bg-warning text-dark">{{ $item->jenis_dokumen->nama }}</span></td>
                            <td><span class="badge bg-primary">{{ $item->tahun }}</span></td>
                            <td><a href="/dokumen/detail/{{ $item->id }}" class="btn btn-sm btn-primary">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
    {{-- </div> --}}

@endsection
