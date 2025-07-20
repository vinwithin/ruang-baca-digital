@extends('layout.admin.app')
@section('title', 'Informasi Status Upload')
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
    <div class="w-100 ">
        <div class="card p-3 border rounded-3 shadow-sm">
            <h3>Daftar seluruh ajuan dari Mahasiswa</h3>
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
            <div class="table-wrapper border rounded-3 overflow-hidden">

                <table class="table align-middle  overflow-hidden">
                    <thead class="table-light text-start">
                        <tr>
                            <th>No</th>
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
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td style="max-width: 300px;">
                                    {{ $item->judul }}
                                </td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->program_studi->nama }}</td>
                                <td>
                                    <span class="badge bg-warning text-dark">{{ $item->jenis_dokumen->nama }}</span>
                                </td>
                                <td>
                                    {{ $item->status }}
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="/admin/dokumen/{{ $item->id }}">Lihat Detail</a>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
