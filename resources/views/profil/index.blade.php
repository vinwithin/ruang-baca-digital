@extends('layout.admin.app')
@section('title', 'Pengaturan Profil')
@section('content')
    <style>
        h3 {
            font-family: "Plus Jakarta Sans";
            font-size: 16px;
            font-style: normal;
            font-weight: 500;
            line-height: 20px;
        }

        dt {
            font-family: "Plus Jakarta Sans";
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: 20px;
        }

        dd {
            font-family: "Plus Jakarta Sans";
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: 20px;
        }

        .btn {
            display: flex;
            height: 28px;
            color: #ffffff;
            padding: 0 8px;
            justify-content: center;
            align-items: center;
            gap: 4px;
            align-self: stretch;
            border-radius: 10px;
            background: #023E8A;
        }
    </style>
    <div class="w-100 ">
        <div class="card p-5">
            <div class="row">
                <div class="col-md-2">
                    <img src="/img/avatars/avatar-2.jpg" class=mb-2" alt="Foto Profil"
                        style="width: 150px; height:150px; border-radius: 50% !important; border: 1px solid black;">
                    <!-- Tombol Ganti Foto -->
                </div>
                <div class="col-md-9">
                    <dl class="row">
                        <h3>{{ $data->name }}</h3>
                        @foreach ($data->getRoleNames() as $role)
                            <p class="text-muted">{{ Str::ucfirst($role) }}</p>
                        @endforeach

                        <hr>
                        <dt class="col-7 mb-3">
                            Nama Pengguna/NIM </dt>

                        <dd class="col-5 mb-3">: {{ $data->identifier }}</dd>

                        <dt class="col-7 mb-3">
                            Kata Sandi </dt>

                        <dd class="col-5 mb-3">: ***********</dd>
                        <dt class="col-7 mb-3"></dt>
                        <dd class="col-5 mb-3"><a class="btn" href=""><i
                                    class="fa-regular fa-circle-arrow-left me-2" style="color: #ffffff;"></i>Ganti Kata
                                Sandi</a></dd>

                    </dl>

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
