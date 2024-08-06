<?php

namespace App\Http\Controllers;

use App\Models\Reporters;
use App\Models\SuratMasuk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    public function peliputanIndex()
    {
        $peliputan = SuratMasuk::with('reporters', 'kepalaBidang')
            ->where('jenis', 'peliputan')
            ->get()
            ->map(function ($surat) {
                $surat->status_jadwal = $surat->reporters->isEmpty() ? 'Belum Terjadwal' : 'Sudah Terjadwal';
                return $surat;
            });
        // Mengambil pengguna dengan role 'reporter'
        $users = User::where('role', 'reporter')->get();

        // Mengembalikan tampilan dengan data yang diperlukan
        return view('suratmasuk.peliputan', [
            'title' => 'Surat Peliputan',
            'peliputan' => $peliputan,
            'users' => $users,
        ]);
    }

    public function assignReporter(Request $request, $id)
    {
        $request->validate([
            'reporter_ids' => 'required|array',
            'reporter_ids.*' => 'exists:users,id',
            'tipe' => 'required|string',
            'berita_Id' => 'null',
        ]);

        $suratMasuk = SuratMasuk::findOrFail($id);
        $addedReporters = [];

        foreach ($request->reporter_ids as $user_id) {
            // Periksa apakah kombinasi surat_masuk_id dan user_id sudah ada
            $existingReporter = Reporters::where('surat_masuk_id', $id)
                ->where('user_id', $user_id)
                ->first();

            // Jika tidak ada, tambahkan kombinasi baru
            if (!$existingReporter) {
                Reporters::create([
                    'surat_masuk_id' => $id,
                    'user_id' => $user_id,
                    'tipe' => $request->tipe,
                    'berita_id' => null,
                ]);
                $addedReporters[] = $user_id;
            }
        }

        if (count($addedReporters) > 0) {
            return redirect()->back()->with('success', 'Reporter berhasil ditambahkan.');
        } else {
            return redirect()->back()->with('error', 'Reporter sudah ada.');
        }
    }

    public function iklanIndex()
    {
        $iklan = SuratMasuk::with('reporters')
            ->where('jenis', 'iklan')
            ->get();

        return view('suratmasuk.iklan', [
            'title' => 'Surat Iklan',
            'iklan' => $iklan,
        ]);
    }

    public function approvedSurat()
    {
        $approved = SuratMasuk::with('reporters')
            ->whereNotNull('kepala_bidang_id')
            ->get();

        return view('suratmasuk.approvalsurat', [
            'title' => 'Surat Approved',
            'approved' => $approved,
        ]);
    }

    public function detailsIklan($id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);

        return response()->json($suratMasuk);
    }

    public function detailsPeliputan($id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);

        return response()->json($suratMasuk);
    }

    public function approve($id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);

        if (Auth::user()->role !== 'kepala_bidang') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk melakukan aksi ini.');
        }

        $suratMasuk->kepala_bidang_id = Auth::id();
        $suratMasuk->approved = 1;
        $suratMasuk->approved_at = now();
        $suratMasuk->save();

        return redirect()->back()->with('success', 'Surat masuk berhasil di-approve.');
    }

    public function destroy($id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);
        $suratMasuk->delete();

        return redirect()->back()->with('success', 'Surat masuk berhasil dihapus.');
    }
}
