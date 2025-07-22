<?php

namespace App\Http\Controllers;

use App\Models\LaporanMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InformasiUpload extends Controller
{
    public function index()
    {
        return view('informasi-upload.index', [
            'data' => LaporanMahasiswa::where('identifier', Auth::user()->identifier)->get()
        ]);
    }
    public function view($filename)
    {
        $path = storage_path('app/private/dokumen/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }
}
