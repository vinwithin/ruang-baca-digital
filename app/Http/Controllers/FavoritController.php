<?php

namespace App\Http\Controllers;

use App\Models\Favorit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritController extends Controller
{
    public function index(){
        return view('favorit.index', [
            'data' => Favorit::where('user_id', Auth::user()->id)->get()
        ]);
    }
}
