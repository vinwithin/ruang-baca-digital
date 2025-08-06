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
            <form action="/search/dokumen" method="GET">
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
                                @foreach (range(date('Y'), 2020) as $year)
                                    <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
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
        <h3 class="pb-3 fw-bold">{{ $title }}</h3>
        <div class="table-wrapper border rounded-3 overflow-hidden">
            <table class="table align-middle mb-0">
                <thead class="table-light text-start">
                    <tr>
                        <th style="width: 5%;"></th>
                        <th style="width: 35%">Judul</th>
                        <th style="width: 15%">Nama</th>
                        <th style="width: 15%">Program Studi</th>
                        <th style="width: 10%">Jenis Koleksi</th>
                        <th style="width: 5%">Tahun</th>
                        <th style="width: 5%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td style="text-align: center;"><i class="fa-regular fa-star"></i></td>
                            <td>{{ $item->judul }}</td>
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
                            <td>{{ $item->tahun }}</td>
                            <td><a href="/search/dokumen/{{ $item->uuid }}" class="btn btn-primary"><i
                                        class="fa-solid fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
    {{-- </div> --}}

@endsection
