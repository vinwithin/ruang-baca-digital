<?php

namespace App\Http\Controllers;

use App\Models\LaporanMahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            'dateRange' => [
                'start' => $startDate->format('Y-m-d'),
                'end' => $endDate->format('Y-m-d')
            ]
        ]);
    }
}
