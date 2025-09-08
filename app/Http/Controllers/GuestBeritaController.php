<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class GuestBeritaController extends Controller
{
    public function index(){
        return view('guest.berita.index',[
            'data' => Berita::paginate(10)
        ]);
    }
    public function show(Berita $berita){
        return view('guest.berita.detail',[
            'data' => $berita
        ]);
    }
}
