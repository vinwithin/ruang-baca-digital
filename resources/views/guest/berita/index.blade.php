@extends('layout.index')
@section('content')
    <link rel="stylesheet" href="/css/berita.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .title {
            color: #043471;
            font-family: "Plus Jakarta Sans";
            font-size: 25px;
            font-weight: 500;
            line-height: 24px;
        }
    </style>
    <section id="berita" class="">
        <h2 class="title text-center mt-4 mb-5">BERITA</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 g-4">
            @foreach ($data as $item)
                <div class="col" style="">
                    <div class="card news-card position-relative overflow-hidden rounded-3 shadow-sm"
                        onclick="window.location.href='/berita/{{ $item->slug }}'">
                        <img src="/storage/{{ $item->image }}" class="object-fit-cover position-absolute top-0 start-0"
                            alt="{{ $item->title }}" />
                        <div class="overlay position-absolute top-0 start-0 w-100 h-100"></div>
                        <div
                            class="card-content position-relative p-4 h-100 d-flex flex-column justify-content-end align-items-center text-center">
                            <h4 class="fw-bold text-white">{{ $item->title }}</h4>
                            <p class="mt-3 small text-light">
                                {{ $item->excerpt }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-5">
            {{ $data->links() }}
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
@endsection
