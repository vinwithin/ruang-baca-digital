<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        return view('profil.index',[
            'data' => User::where('id', Auth::user()->id)->firstOrFail(),
        ]);
    }

    public function store(Request $request){
        
    }
}
