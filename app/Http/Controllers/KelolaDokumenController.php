<?php

namespace App\Http\Controllers;

use App\Models\JenisDokumen;
use App\Models\LaporanMahasiswa;
use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelolaDokumenController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $prodi = $request->input('prodi');
        $jenisDokumen = $request->input('jenis_dokumen');

        $data = LaporanMahasiswa::with('user.roles')
            ->whereHas('user.roles', function ($q) {
                $q->where('name', 'admin');
            });
        if ($search) {
            $data->where(function ($query) use ($search) {
                $query->where('judul', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%")
                    ->orWhere('identifier', 'like', "%{$search}%")
                    ->orWhere('kata_kunci', 'like', "%{$search}%");
            });
        }
        if ($jenisDokumen) {
            $data->where('jenis_dokumen_id', $jenisDokumen);
        }
        if ($prodi) {
            $data->where('program_studi_id', $prodi);
        }

        $data = $data->latest()->paginate(10);

        return view('admin.kelola-dokumen.index', [
            'data' => $data,
            'jenis_dokumen' => JenisDokumen::all(),
            'prodi' => ProgramStudi::all()
        ]);
    }
    public function show(LaporanMahasiswa $laporanmahasiswa)
    {
        $data = LaporanMahasiswa::findOrFail($laporanmahasiswa->id);
        return view('admin.kelola-dokumen.show', [
            'data' => $data,
        ]);
    }
    public function create()
    {
        return view('admin.kelola-dokumen.create', [
            'prodi' => ProgramStudi::all(),
            'jenis_dokumen' => JenisDokumen::all(),
        ]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'program_studi_id' => 'required|string',
            'identifier' => 'required|string|max:20',
            'jenis_dokumen_id' => 'required|string',
            'dospem1' => 'required|string|max:255',
            'dospem2' => 'nullable|string|max:255',
            'tahun' => 'required|integer|between:2020,2030',
            'judul' => 'required|string|max:500',
            'kata_kunci' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240', // Maksimal 10MB
            'dataConfirmation' => 'accepted', // Checkbox harus dicentang
        ]);

        // Proses upload file
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('dokumen', $fileName);
            $validatedData['file'] = $fileName;
        } else {
            return back()->withErrors(['file' => 'File dokumen wajib diunggah.']);
        }

        // Simpan ke database
        $validatedData['status'] = 'Disetujui';
        $validatedData['user_id'] = Auth::user()->id; // Set user_id to the currently authenticated user
        $result = LaporanMahasiswa::create(
            $validatedData
        );
        if ($result) {
            return redirect()->route('admin.kelola-dokumen')->with('success', 'Dokumen berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Gagal Menyimpan Dokumen.');
        }
    }
    public function edit(LaporanMahasiswa $laporanmahasiswa)
    {
        return view('admin.kelola-dokumen.edit', [
            'data' => LaporanMahasiswa::find($laporanmahasiswa->id),
            'prodi' => ProgramStudi::all(),
            'jenis_dokumen' => JenisDokumen::all(),
        ]);
    }
    public function update(Request $request, LaporanMahasiswa $laporanmahasiswa)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'program_studi_id' => 'required|string',
            'identifier' => 'required|string|max:20',
            'jenis_dokumen_id' => 'required|string',
            'dospem1' => 'required|string|max:255',
            'dospem2' => 'nullable|string|max:255',
            'tahun' => 'required|integer|between:2020,2030',
            'judul' => 'required|string|max:500',
            'kata_kunci' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // Maksimal 10MB
            'dataConfirmation' => 'accepted', // Checkbox harus dicentang
        ]);
        unset($validatedData['dataConfirmation']);
        // Proses upload file
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('dokumen', $fileName);
            $validatedData['file'] = $fileName;
        } else {
            return back()->withErrors(['file' => 'File dokumen wajib diunggah.']);
        }
        $validatedData['user_id'] = Auth::user()->id; // Set user_id to the currently authenticated user
        $result = LaporanMahasiswa::where('id', $laporanmahasiswa->id)->update(
            $validatedData
        );
        if ($result) {
            return redirect()->route('admin.kelola-dokumen')->with('success', 'Dokumen berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Gagal Menyimpan Dokumen.');
        }
    }
    public function destroy(LaporanMahasiswa $laporanmahasiswa)
    {
        $laporan = LaporanMahasiswa::findOrFail($laporanmahasiswa->id);
        if ($laporan->delete()) {
            return redirect()->route('admin.kelola-dokumen')->with('success', 'Dokumen berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus dokumen.');
        }
    }
}
