<?php

namespace App\Http\Controllers;

use App\Models\LaporanMahasiswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard',[
           'data' => LaporanMahasiswa::orderBy('view_count', 'desc')->take(5)->get(),
        ]);
    }
}
