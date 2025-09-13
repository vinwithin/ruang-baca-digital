<?php

namespace App\Http\Controllers;

use App\Models\LaporanMahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {


        $startMonth = $request->input('start_month');
        $startYear = $request->input('start_year');
        $endMonth = $request->input('end_month');
        $endYear = $request->input('end_year');

        // Konversi ke format tanggal awal & akhir
        $startDate = Carbon::createFromDate($startYear, $startMonth, 1)->startOfMonth();
        $endDate = Carbon::createFromDate($endYear, $endMonth, 1)->endOfMonth();

        $laporanPerBulan = DB::table('laporan')
            ->selectRaw("
        DATE_FORMAT(created_at, '%M %Y') as bulan, 
        COUNT(*) as total,
        YEAR(created_at) as year,
        MONTH(created_at) as month
    ")
            ->whereBetween("created_at", [$startDate, $endDate])
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%M %Y')"), 'year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Debug: Check if data is retrieved
        // dd($laporanPerBulan);

        return view('dashboard', [
            'chartData' => $laporanPerBulan,
            'prodi' => ProgramStudi::all(),
            'data' => LaporanMahasiswa::where('status', 'Disetujui')->orderBy('view_count', 'desc')->take(5)->get(),
            'data_ajuan' => LaporanMahasiswa::where('user_id', Auth::user()->id)->get(),
            'data_count' => LaporanMahasiswa::orderBy('view_count', 'desc')->get(),
            'skripsi_count' => LaporanMahasiswa::where('status', 'Disetujui')->where('jenis_dokumen_id', 1)->sum('view_count'),
            'laporan_count' => LaporanMahasiswa::where('status', 'Disetujui')->where('jenis_dokumen_id', 2)->sum('view_count'),
            'dateRange' => [
                'start' => $startDate->format('Y-m-d'),
                'end' => $endDate->format('Y-m-d')
            ]
        ]);
    }

    public function laporanMagang()
    {
        return view('dashboard.laporan-magang', [
            'data' => LaporanMahasiswa::with('jenis_dokumen')
                ->where('status', 'Disetujui')
                ->whereHas('jenis_dokumen', function ($q) {
                    $q->where('nama', 'Laporan Magang');
                })->get()
        ]);
    }
    public function skripsi()
    {
        return view('dashboard.skripsi', [
            'data' => LaporanMahasiswa::with('jenis_dokumen')
                ->where('status', 'Disetujui')
                ->whereHas('jenis_dokumen', function ($q) {
                    $q->where('nama', 'Skripsi');
                })->get()
        ]);
    }
}
