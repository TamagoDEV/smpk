<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::with(['suratMasuk', 'suratMasuk.kepalaBidang', 'suratMasuk.reporters'])->get();

        return view('berita.index', [
            'title' => 'Data Berita',
            'berita' => $berita,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suratList = SuratMasuk::all();
        return view('berita.tambah', [
            'title' => 'Tambah Berita',
            'suratList' => $suratList,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tipe_media' => 'required|in:website,radio,youtube,media_lain',
            'surat_id' => 'required|exists:surat_masuk,id',
            'slug' => 'required|unique:berita,slug',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link_youtube' => 'nullable|url',
            'audio' => 'nullable|mimes:mp3,wav|max:2048',
            'naskah' => 'nullable|mimes:doc,docx,pdf|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $berita = Berita::create($validatedData);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $berita = Berita::with(['suratMasuk'])->findOrFail($id);
        return view('berita.detail', [
            'title' => 'Detail Berita',
            'berita' => $berita,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $berita)
    {
        return view('berita.edit', [
            'title' => 'Edit Berita',
            'berita' => $berita
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berita $berita)
    {
        $validatedData = $request->validate([
            'tipe_media' => 'required|in:website,radio,youtube,media_lain',
            'surat_id' => 'required|exists:surat_masuk,id',
            'slug' => 'required|unique:berita,slug,' . $berita->id,
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link_youtube' => 'nullable|url',
            'audio' => 'nullable|mimes:mp3,wav|max:2048',
            'naskah' => 'nullable|mimes:doc,docx,pdf|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $berita->update($validatedData);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $berita)
    {
        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
