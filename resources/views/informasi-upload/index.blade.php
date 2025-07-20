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
        <div class="card p-5 border rounded-3 shadow-sm">

            <h3 class="fw-bold mb-4">File yang anda input</h3>
            <div class="table-wrapper border rounded-3 overflow-hidden">

                <table class="table align-middle  overflow-hidden">
                    <thead class="table-light text-start">
                        <tr>
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

                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary"
                                        href="" target="_blank">
                                        Baca <i class="bi bi-book"></i>
                                    </a>
                                    @if ($item->status === 'Revisi')
                                        <a class="btn btn-sm btn-warning" href="/dokumen/edit/{{$item->id}}">Edit</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
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
