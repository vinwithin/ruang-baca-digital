<?php

namespace App\Http\Controllers;

use App\Models\Panduan;
use Illuminate\Http\Request;

class PanduanController extends Controller
{
    public function extractYouTubeVideoId($url)
    {
        $regExp = '/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/';
        preg_match($regExp, $url, $match);
        return (isset($match[7]) && strlen($match[7]) == 11) ? $match[7] : null;
    }
    public function index()
    {
        return view('admin.panduan.index', [
            'data' => Panduan::first()
        ]);
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'link' => 'required|url',
        ]);
        $videoId = $this->extractYouTubeVideoId($data['link']);
        if (!$videoId) {
            return redirect()->route('kelola-konten.video')->with('error', 'Link video tidak valid!');
        }
        $data['link'] = "https://www.youtube.com/embed/" . $videoId;
        $result = Panduan::where('id', $id)->update([
            'link' => $data['link']
        ]);
        if ($result) {
            return redirect()->back()
                ->with('success', 'Video panduan berhasil diperbarui');
        } else {
            return redirect()->back()
                ->with('error', 'Video panduan gagal diperbarui');
        }
    }
}
