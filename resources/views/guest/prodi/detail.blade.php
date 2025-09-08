@extends('layout.index')
@section('content')
    <link rel="stylesheet" href="/css/berita.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .card-list {
            width: 350px;
            height: 220px;
            display: flex;

            justify-content: center;
            align-items: center;
            color: black;
            user-select: none;
            border-radius: 10px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
            border-bottom: 4px solid rgba(188, 225, 148, 1);
            background: rgba(250, 250, 250, 1);
            position: relative;
        }

        .card-list::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(2, 62, 138, 0.4);
            border-radius: 10px;
            pointer-events: none;
        }

        .card-title {
            color: black;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            color: #fff;
            text-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
            /* Heading/h4/Bold */
            font-family: "Plus Jakarta Sans";
            font-size: 24px;
            font-style: normal;
            font-weight: 700;
            line-height: 32px;
            /* 133.333% */
            margin: 0;
            text-align: center;
            /* margin: 14px 0 40px; */
        }
    </style>
    <section id="berita" class="">
        <h2 class="title text-center mt-4 mb-5">PROGRAM STUDI</h2>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach ($data as $item)
                <div class="col">
                    <div class="card card-list flex-shrink-0"
                        onclick="window.location.href='/koleksi/program-studi/{{ $item->nama }}'"
                        style="cursor: pointer; background: url({{ $item->logo }}) no-repeat center center/cover;">

                        <div class="card-body">
                            <h5 class="card-title">{{ $item->nama }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
@endsection
