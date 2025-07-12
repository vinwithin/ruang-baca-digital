@extends('layout.admin.app')
@section('title', 'Informasi Status Upload')
@section('content')
    <div class="w-100 ">
        <div class="card p-3 border rounded-3 shadow-sm">
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
            <h3>Daftar dokumen bacaan favorit anda</h3>
            <table class="table table-bordered align-middle rounded-2 overflow-hidden">
                <thead class="table-light text-start">
                    <tr>
                        <th>Judul</th>
                        <th>Nama</th>
                        <th>Program Studi</th>
                        <th>Jenis Koleksi</th>
                        <th>Tahun</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td style="max-width: 300px;">
                                {{ $item->laporan->judul }}
                            </td>
                            <td>{{ $item->laporan->nama }}</td>
                            <td>{{ $item->laporan->program_studi->nama }}</td>
                            <td>
                                <span class="badge bg-warning text-dark">{{ $item->laporan->jenis_dokumen->nama }}</span>
                            </td>
                            <td>
                              {{$item->laporan->tahun}}
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
    </div>

@endsection
