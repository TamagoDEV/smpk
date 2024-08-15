<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Reporters;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    public function index()
    {
        // Mengambil data berita beserta relasi reporters dan user dari suratMasuk
        $berita = Berita::with(['reporters.user', 'approvedBy'])->get();
        return view('berita.index', [
            'title' => 'Data Berita',
            'berita' => $berita,
        ]);
    }

    public function create(Request $request)
    {
        // Ambil reporter_id dari request
        $reporterId = $request->input('reporter', null);

        // Inisialisasi suratList
        $suratList = collect();

        if ($reporterId) {
            // Ambil reporter yang sesuai dengan reporter_id
            $reporter = Reporters::find($reporterId);
            if ($reporter) {
                // Ambil surat masuk yang terkait dengan reporter tersebut
                $suratList = SuratMasuk::where('id', $reporter->surat_masuk_id)->get();
            }
        } else {
            // Jika tidak ada reporter_id, ambil semua surat sebagai default
            $suratList = SuratMasuk::all();
        }

        return view('berita.tambah', [
            'title' => 'Tambah Berita',
            'suratList' => $suratList,
            'currentReporterId' => $reporterId, // Kirim reporter_id ke view
        ]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tipe_media' => 'required|in:website,radio,youtube,media_lain',
            'surat_masuk_id' => 'required',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link_youtube' => 'nullable|url',
            'audio' => 'nullable|mimes:mp3,wav|max:2048',
            'naskah' => 'nullable|mimes:doc,docx,pdf|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('foto');
        }

        if ($request->hasFile('audio')) {
            $validatedData['audio'] = $request->file('audio')->store('audio');
        }

        if ($request->hasFile('naskah')) {
            $validatedData['naskah'] = $request->file('naskah')->store('naskah');
        }

        // Buat berita baru
        $berita = Berita::create($validatedData);

        // Simpan hubungan antara berita dan reporter di tabel pivot
        if ($request->filled('reporter_id')) {
            $berita->reporters()->attach($request->input('reporter_id'));
        }

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dibuat.');
    }



    public function show($id)
    {
        $berita = Berita::with(['suratMasuk'])->findOrFail($id);
        return view('berita.detail', [
            'title' => 'Detail Berita',
            'berita' => $berita,
        ]);
    }

    public function edit(Berita $berita)
    {
        return view('berita.edit', [
            'title' => 'Edit Berita',
            'berita' => $berita,
        ]);
    }

    public function update(Request $request, Berita $berita)
    {
        $validatedData = $request->validate([
            'tipe_media' => 'required|in:website,radio,youtube,media_lain',
            'surat_masuk_id' => 'required',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link_youtube' => 'nullable|url',
            'audio' => 'nullable|mimes:mp3,wav|max:2048',
            'naskah' => 'nullable|mimes:doc,docx,pdf|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('foto');
        }

        if ($request->hasFile('audio')) {
            $validatedData['audio'] = $request->file('audio')->store('audio');
        }

        if ($request->hasFile('naskah')) {
            $validatedData['naskah'] = $request->file('naskah')->store('naskah');
        }

        $berita->update($validatedData);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diupdate.');
    }

    public function approve($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->approved_by) {
            return redirect()->route('berita.index')->with('error', 'Berita ini sudah di-approve.');
        }

        $berita->approved_by = Auth::id();
        $berita->approved_at = now();
        $berita->save();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil di-approve.');
    }

    public function reject($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->rejected_by = Auth::id();
        $berita->rejected_at = now();
        $berita->save();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditolak.');
    }

    public function destroy(Berita $berita)
    {
        $berita->delete();
        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
