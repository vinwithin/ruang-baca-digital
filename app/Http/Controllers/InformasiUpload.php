<?php

namespace App\Http\Controllers;

use App\Models\LaporanMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InformasiUpload extends Controller
{
    public function index(){
        return view('informasi-upload.index', [
            'data' => LaporanMahasiswa::where('identifier', Auth::user()->identifier)->get()
        ]);
    }
}
