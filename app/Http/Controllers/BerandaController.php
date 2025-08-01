<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\JenisDokumen;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index(){
        return view('guest.beranda', [
            'prodi' => ProgramStudi::all(),
            'berita' => Berita::latest()->take(10)->get(),
            'jenis' => JenisDokumen::all(),
        ]);
    }
    public function tentang(){
        return view('guest.tentang');
    }
}
