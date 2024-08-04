<?php

namespace App\Http\Controllers;

use App\Models\Reporters;
use App\Models\SuratMasuk;
use App\Models\User;
use Illuminate\Http\Request;

class SuratMasukController extends Controller
{
    public function index()
    {
        return view('suratmasuk', [
            'title' => 'Buat Surat',
        ]);
    }

    public function submit(Request $request)
    {
        $rules = [
            'jenis' => 'required|string',
            'nama_pengirim' => 'required|string',
            'instansi' => 'required|string',
            'bidang' => 'required|string',
            'no_hp' => 'required|string',
            'kontak_lain' => 'nullable|string',
        ];

        if ($request->jenis == 'iklan') {
            $rules = array_merge($rules, [
                'tipe_iklan' => 'required|string',
                'periode' => 'required|string',
                'harga' => 'required|numeric',
                'ppn' => 'required|numeric',
            ]);
        } elseif ($request->jenis == 'peliputan') {
            $rules = array_merge($rules, [
                'nama_acara' => 'required|string',
                'lokasi_acara' => 'required|string',
                'waktu_acara' => 'required|string',
                'tanggal_acara' => 'required|date',
            ]);
        }

        $validatedData = $request->validate($rules);

        $suratMasuk = new SuratMasuk();
        $suratMasuk->jenis = $request->jenis;
        $suratMasuk->nama_pengirim = $request->nama_pengirim;
        $suratMasuk->instansi = $request->instansi;
        $suratMasuk->bidang = $request->bidang;
        $suratMasuk->no_hp = $request->no_hp;
        $suratMasuk->kontak_lain = $request->kontak_lain;
        $suratMasuk->dokumen_surat = $request->file('dokumen_surat')->store('dokumen_surat');

        if ($request->jenis === 'iklan') {
            $suratMasuk->tipe_iklan = $request->tipe_iklan;
            $suratMasuk->periode = $request->periode;
            $suratMasuk->harga = $request->harga;
            $suratMasuk->ppn = $request->ppn;
        } else if ($request->jenis === 'peliputan') {
            $suratMasuk->nama_acara = $request->nama_acara;
            $suratMasuk->lokasi_acara = $request->lokasi_acara;
            $suratMasuk->waktu_acara = $request->waktu_acara;
            $suratMasuk->tanggal_acara = $request->tanggal_acara;
        }

        $suratMasuk->save();

        return redirect()->back()->with('success', 'Pengajuan surat berhasil dikirim.');
    }

    // Method untuk menampilkan daftar surat masuk
    public function pageSuratMasuk()
    {
        $suratmasuk = SuratMasuk::with('reporters')->get()->map(function ($surat) {
            $surat->status_jadwal = $surat->reporters->isEmpty() ? 'Belum Terjadwal' : 'Sudah Terjadwal';
            return $surat;
        });

        // Filter pengguna dengan role "reporter"
        $users = User::where('role', 'reporter')->get();

        return view('admin.suratmasuk.index', [
            'title' => 'Daftar Surat Masuk',
            'suratmasuk' => $suratmasuk,
            'users' => $users,
        ]);
    }
    // Method untuk menambahkan reporter ke surat masuk
    public function assignReporter(Request $request, $id)
    {
        $request->validate([
            'reporters' => 'required|array',
            'reporters.*' => 'exists:users,id',
            'tipe' => 'required|string',
            'nama_acara' => 'nullable|string',
            'lokasi_acara' => 'nullable|string',
            'waktu_acara' => 'nullable|string',
            'tanggal_acara' => 'nullable|date',
        ]);

        $suratMasuk = SuratMasuk::findOrFail($id);
        $reporters = $request->input('reporters');
        $tipe = $request->input('tipe');

        // Ambil reporter yang sudah ada untuk surat masuk yang sama
        $existingReporters = $suratMasuk->reporters()->pluck('user_id')->toArray();

        // Filter reporter yang belum ada
        $newReporters = array_diff($reporters, $existingReporters);

        // Jika tidak ada reporter baru, kembalikan dengan pesan error
        if (empty($newReporters)) {
            return redirect()->back()->with('error', 'Reporter sudah ada pada surat ini.');
        }

        // Tambahkan reporter baru
        foreach ($newReporters as $reporterId) {
            Reporters::create([
                'surat_masuk_id' => $suratMasuk->id,
                'user_id' => $reporterId,
                'tipe' => $tipe,
            ]);
        }

        return redirect()->back()->with('success', 'Reporter berhasil ditambahkan.');
    }

    public function getData($id)
    {
        $suratmasuk = SuratMasuk::with('reporters.user')->findOrFail($id);
        return response()->json($suratmasuk);
    }

    public function destroy($id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);
        $suratMasuk->delete();

        return redirect()->back()->with('success', 'Surat masuk berhasil dihapus.');
    }


    // Method untuk menampilkan daftar surat masuk terjadwal
    public function pageSuratTerjadwal()
    {
        $suratmasuk = SuratMasuk::all();
        return view('admin.suratmasuk.terjadwal', [
            'title' => 'Surat Masuk Terjadwal',
            'suratmasuk' => $suratmasuk,
        ]);
    }
}
