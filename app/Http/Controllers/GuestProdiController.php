<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class GuestProdiController extends Controller
{
    public function index(){
        return view('guest.prodi.detail',[
            'data' => ProgramStudi::all()
        ]);
    }
}
