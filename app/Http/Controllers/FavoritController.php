<?php

namespace App\Http\Controllers;

use App\Models\Favorit;
use App\Models\LaporanMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritController extends Controller
{
    public function index(){
        $data = Favorit::where('user_id', Auth::user()->id)
->whereHas('laporan', function ($query) {
$query->where('user_id', Auth::user()->id);
})
->with('laporan')
->get();


return view('favorit.index', [
'data' => $data
]);
    }
    public function detail(LaporanMahasiswa $laporanmahasiswa){
        return view('favorit.detail',[
            'data' => $laporanmahasiswa
        ]);
    }
}
