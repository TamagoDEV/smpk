<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'berita_id' => 'required|exists:berita,id',
            'isi' => 'required',
        ]);

        Komentar::create([
            'berita_id' => $request->berita_id,
            'isi' => $request->isi,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}
