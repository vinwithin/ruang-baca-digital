@extends('layout.admin.app')
@section('title', 'Dashboard')
@section('content')
    <style>
        .row {
            margin-top: -100px;
        }
    </style>


    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
            <div class="card p-3 border rounded-3 shadow-sm h-100">
                <h4 class="fw-bold">
                    {{ $data->where('jenis_dokumen_id', 2)->where('status', 'Disetujui')->count() }}
                </h4>
                <div class="text-center">
                    Tugas Akhir/Skripsi
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card p-3 border rounded-3 shadow-sm h-100">
                <h4 class="fw-bold">
                    {{ $data->where('jenis_dokumen_id', 5)->where('status', 'Disetujui')->count() }}
                </h4>
                <div class="text-center">
                    Laporan Magang
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card p-3 border rounded-3 shadow-sm h-100">
                <h4 class="fw-bold">
                    {{ $data->where('status', 'Diproses')->count() }}
                </h4>
                <div class="text-center">
                    Ajuan Mahasiswa
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-2">
        <div id="curve_chart" style="width: 1200px; height: 500px"></div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="fw-bold">Dokumen Paling Sering Dibaca</h5>
        </div>
        <div class="card-body">
            @foreach ($data as $item)
                <h5>{{ $item->judul }}</h5>
                <p>{{ $item->view_count }} Kali dilihat</p>
                <span class="badge text-bg-warning">{{ $item->jenis_dokumen->nama }}</span>
            @endforeach

        </div>
    </div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    {{-- <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Bulan', 'Jumlah Ajuan'],
                @foreach ($chartData as $row)
                    ['{{ $row->bulan }}', {{ $row->total }}],
                @endforeach
            ]);

            var options = {
                title: 'Total Ajuan',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
    </script> --}}

@endsection
