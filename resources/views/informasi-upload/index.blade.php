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
            <table class="table table-bordered align-middle rounded-2 overflow-hidden">
                <thead class="table-light text-start">
                    <tr>
                        <th>Judul</th>
                        <th>Nama</th>
                        <th>Program Studi</th>
                        <th>Jenis Koleksi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td style="max-width: 300px;">
                                {{ $item->judul }}
                            </td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->program_studi->nama }}</td>
                            <td>
                                <span class="badge bg-warning text-dark">{{ $item->jenis_dokumen->nama }}</span>
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ $item->status }}</span>
                                @if ($item->status === 'Revisi')
                                    <a class="btn btn-warning" href="">Edit</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
    </div>

@endsection
