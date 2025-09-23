<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class BeritaController extends Controller
{
    public function index()
    {
        return view('admin.berita.index', [
            'data' => Berita::paginate(10)
        ]);
    }
    public function create()
    {
        return view('admin.berita.create');
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required|string',
        ]);
        $validateData['user_id'] = Auth::user()->id;
        $validateData['slug'] = SlugService::createSlug(Berita::class, 'slug', $validateData['title']);
        $validateData["excerpt"] =  Str::limit(strip_tags($request->content), 100);
        if ($request->hasFile('image')) {
            $thumbnail_name = time() . '_' . $request->image->getClientOriginalName();
            $path = $request->image->storeAs('berita/thumbnails', $thumbnail_name, 'public');
            $validateData['image'] = $path;
        }

        preg_match_all('/data:image\/[a-zA-Z]+;base64,([^\"]+)/', $validateData['content'], $matches);
        $imageTags = $matches[0];
        if (count($imageTags) > 0) {
            foreach ($imageTags as $tagImage) {
                $image = preg_replace('/^data:image\/\w+;base64,/', '', $tagImage);
                $extension = explode('/', explode(':', substr($tagImage, 0, strpos($tagImage, ';')))[1])[1];
                $allowedTypes = ['jpeg', 'jpg', 'png', 'gif'];
                if (!in_array($extension, $allowedTypes)) {
                    return response()->json([
                        'message' => 'Invalid image type. Allowed types: ' . implode(', ', $allowedTypes)
                    ], 422);
                }
                $imageName = Str::random(10) . '.' . $extension;
                Storage::disk('public')->put('berita/' . $imageName, base64_decode($image));
                $validateData['content'] = str_replace($tagImage,  asset('/storage/berita/' . $imageName), $validateData['content']);
            }
        }

        $result = Berita::create($validateData);
        if (!$result) {
            return redirect()->back()->with('error', 'Gagal Menyimpan Berita.');
        }
        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        return view('berita.show', compact('berita'));
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', [
            'data' => $berita
        ]);
    }

    public function update(Request $request, Berita $berita)
    {
        $validateData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required|string',
        ]);
        $validateData['user_id'] = Auth::user()->id;
        $validateData['slug'] = SlugService::createSlug(Berita::class, 'slug', $validateData['title']);
        $validateData["excerpt"] =  Str::limit(strip_tags($request->content), 100);

        if ($request->hasFile('image')) {
            $thumbnail_name = time() . '_' . $request->image->getClientOriginalName();
            $path = $request->image->storeAs('berita/thumbnails', $thumbnail_name, 'public');
            $validateData['image'] = $path;
        }
        
        preg_match_all('/data:image\/[a-zA-Z]+;base64,([^\"]+)/', $validateData['content'], $matches);
        $imageTags = $matches[0];
        if (count($imageTags) > 0) {
            foreach ($imageTags as $tagImage) {
                $image = preg_replace('/^data:image\/\w+;base64,/', '', $tagImage);
                $extension = explode('/', explode(':', substr($tagImage, 0, strpos($tagImage, ';')))[1])[1];
                $allowedTypes = ['jpeg', 'jpg', 'png', 'gif'];
                if (!in_array($extension, $allowedTypes)) {
                    return response()->json([
                        'message' => 'Invalid image type. Allowed types: ' . implode(', ', $allowedTypes)
                    ], 422);
                }
                $imageName = Str::random(10) . '.' . $extension;
                Storage::disk('public')->put('berita/' . $imageName, base64_decode($image));
                $validateData['content'] = str_replace($tagImage,  asset('/storage/berita/' . $imageName), $validateData['content']);
            }
        }

        $result = Berita::where('id', $berita->id)->update($validateData);

        if ($result) {
            return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui berita.');
        }
    }
    public function destroy(Berita $berita)
    {
        $result = Berita::where('id', $berita->id)->delete();
        if ($result) {
            return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus berita.');
        }
    }
}
