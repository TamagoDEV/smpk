<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Reporters;
use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Auth;

class PelaporanController extends Controller
{
    public function index(Request $request)
    {
        $reports = collect(); // Menggunakan koleksi untuk hasil yang berbeda-beda

        if ($request->jenis_laporan == 'berita') {
            $reports = Berita::query()->get();
        } elseif ($request->jenis_laporan == 'surat_iklan' || $request->jenis_laporan == 'surat_peliputan') {
            $reports = SuratMasuk::query()->where('jenis', $request->jenis_laporan)->get();
        } elseif ($request->jenis_laporan == 'jadwal') {
            $reports = Reporters::query()->get();
        }

        return view('laporan.index', [
            'title' => 'Laporan',
            'reports' => $reports,
        ]);
    }

    public function filter(Request $request)
    {
        $query = collect(); // Initialize a collection

        if ($request->filled('jenis_laporan')) {
            switch ($request->jenis_laporan) {
                case 'berita':
                    $query = Berita::all(); // Fetch all data from berita table
                    break;
                case 'iklan':
                case 'peliputan':
                    $query = SuratMasuk::where('jenis', $request->jenis_laporan)->get(); // Filter surat_masuk based on jenis
                    break;
                case 'jadwal':
                    $query = Reporters::with(['suratMasuk', 'user']) // Include related surat and user data
                        ->get();
                    break;
            }
        }

        return response()->json($query);
    }

    // Method untuk approval laporan oleh Kepala Bidang
    public function approve($id)
    {
        // Pastikan user yang login adalah Kepala Bidang
        if (Auth::user()->role !== 'kepala_bidang') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk melakukan approval.');
        }

        // Mencari laporan berdasarkan ID
        $report = SuratMasuk::find($id);

        if (!$report) {
            return redirect()->back()->with('error', 'Laporan tidak ditemukan.');
        }

        // Melakukan approval laporan
        $report->is_approved = true;
        $report->approved_by = Auth::user()->id;
        $report->save();

        return redirect()->back()->with('success', 'Laporan berhasil di-approve.');
    }

    public function cetak(Request $request)
    {
        // Membuat query dasar menggunakan model SuratMasuk
        $query = SuratMasuk::query();

        // Filter berdasarkan bulan jika diisi
        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
        }

        // Filter berdasarkan tahun jika diisi
        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }

        // Filter berdasarkan jenis laporan jika diisi
        if ($request->filled('jenis_laporan')) {
            $query->where('jenis', $request->jenis_laporan);
        }

        // Mengambil semua laporan yang telah difilter
        $reports = $query->get();

        // Initialize Dompdf with options
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);

        // Load HTML content
        $html = view('laporan.cetak', ['reports' => $reports])->render();
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Stream the file to the browser
        return $dompdf->stream('laporan.cetak');
    }
}
