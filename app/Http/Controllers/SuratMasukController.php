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
        // Validation rules
        $rules = [
            'jenisSurat' => 'required|string', // jenis
            'namaPengirim' => 'required|string', // nama_pengirim
            'instansi' => 'required|string', // instansi
            'bidang' => 'required|string', // bidang
            'noHp' => 'required|string', // no_hp
            'kontakLain' => 'nullable|string', // kontak_lain
            'fileLampiran' => 'required|file', // dokumen_surat
        ];

        // Conditional validation rules for "iklan"
        if ($request->jenisSurat === 'iklan') {
            $rules = array_merge($rules, [
                'tipeIklan' => 'required|string', // tipe_iklan
            ]);

            if ($request->tipeIklan === 'billboard') {
                $rules = array_merge($rules, [
                    'periodeBillboard' => 'nullable|string', // periode
                    'hargaBillboard' => 'nullable|numeric', // harga
                    'ppnBillboard' => 'nullable|numeric', // ppn
                    'jenisBillboard' => 'nullable|string', // jenisBillboard
                    'lokasiBillboard' => 'nullable|string', // lokasiBillboard
                ]);
            } elseif ($request->tipeIklan === 'radio') {
                $rules = array_merge($rules, [
                    'jenisKegiatan' => 'nullable|string', // jenisKegiatan
                    'durasiRadio' => 'nullable|string', // durasiRadio
                    'hargaRadio' => 'nullable|numeric', // hargaRadio
                    'ppnRadio' => 'nullable|numeric', // ppnRadio
                ]);
            }
        }

        // Conditional validation rules for "peliputan"
        if ($request->jenisSurat === 'peliputan') {
            $rules = array_merge($rules, [
                'namaAcara' => 'required|string', // nama_acara
                'lokasiAcara' => 'required|string', // lokasi_acara
                'waktuAcara' => 'required|string', // waktu_acara
                'tanggalAcara' => 'required|date', // tanggal_acara
            ]);
        }

        // Validate the input
        $validatedData = $request->validate($rules);

        // Save to the database
        $suratMasuk = new SuratMasuk();
        $suratMasuk->jenis = $request->jenisSurat;
        $suratMasuk->nama_pengirim = $request->namaPengirim;
        $suratMasuk->instansi = $request->instansi;
        $suratMasuk->bidang = $request->bidang;
        $suratMasuk->no_hp = $request->noHp;
        $suratMasuk->kontak_lain = $request->kontakLain;
        $suratMasuk->dokumen_surat = $request->file('fileLampiran')->store('dokumen_surat'); // File upload
        if ($request->jenisSurat === 'iklan') {
            // Combine tipe iklan with additional fields
            $tipeIklan = $request->tipeIklan;

            if ($request->tipeIklan === 'billboard') {
                $tipeIklan .= ', ' . $request->lokasiBillboard . ', ' . $request->jenisBillboard;

                $suratMasuk->periode = $request->periodeBillboard;
                $suratMasuk->harga = $request->hargaBillboard;
                $suratMasuk->ppn = $request->ppnBillboard;
            } elseif ($request->tipeIklan === 'radio') {
                $tipeIklan .= ', ' . $request->jenisKegiatan;
                $suratMasuk->periode = $request->durasiRadio;
                $suratMasuk->harga = $request->hargaRadio;
                $suratMasuk->ppn = $request->ppnRadio;
            }

            $suratMasuk->tipe_iklan = $tipeIklan;
        } elseif ($request->jenisSurat === 'peliputan') {
            // Handling peliputan type fields
            $suratMasuk->nama_acara = $request->namaAcara;
            $suratMasuk->lokasi_acara = $request->lokasiAcara;
            $suratMasuk->waktu_acara = $request->waktuAcara;
            $suratMasuk->tanggal_acara = $request->tanggalAcara;
        }

        // Save the record
        $suratMasuk->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Pengajuan surat berhasil dikirim.');
    }



    public function peliputanIndex()
    {
        $peliputan = SuratMasuk::with('reporters', 'kepalaBidang')
            ->where('jenis', 'peliputan')
            ->orderBy('created_at', 'desc')
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
            ->orderBy('created_at', 'desc')

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
            ->orderBy('approved_at', 'desc')

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
