<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Laporan;
use App\Models\LaporanPengajuan;
use App\Models\Reporters;
use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use Dompdf\Dompdf;
use Dompdf\Options;
use Endroid\QrCode\Encoding\Encoding;
use Illuminate\Support\Facades\Auth;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\ErrorCorrectionLevel;


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
        $query = collect();  // Initialize query as null

        if ($request->filled('jenis_laporan')) {
            switch ($request->jenis_laporan) {
                case 'berita_website':
                    $query = Berita::query()
                        ->where('tipe_media', 'website')
                        ->with('reporters.user'); // Eager load the reporters and their associated user
                    break;
                case 'berita_radio':
                    $query = Berita::query()
                        ->where('tipe_media', 'radio')
                        ->with('reporters.user'); // Eager load the reporters and their associated user
                    break;
                case 'berita_youtube':
                    $query = Berita::query()
                        ->where('tipe_media', 'youtube')
                        ->with('reporters.user'); // Eager load the reporters and their associated user
                    break;
                case 'berita_media':
                    $query = Berita::query()
                        ->where('tipe_media', 'media')
                        ->with('reporters.user'); // Eager load the reporters and their associated user
                    break;
                case 'iklan':
                case 'peliputan':
                    $query = SuratMasuk::query()->where('jenis', $request->jenis_laporan);
                    break;
                case 'jadwal':
                    $query = Reporters::query()->with(['suratMasuk', 'user']);
                    break;
            }

            // Apply date filters if provided
            if ($query && $request->filled('bulan') && $request->filled('tahun')) {
                $query->whereMonth('created_at', $request->bulan)
                    ->whereYear('created_at', $request->tahun);
            } elseif ($query && $request->filled('bulan')) {
                $query->whereMonth('created_at', $request->bulan);
            } elseif ($query && $request->filled('tahun')) {
                $query->whereYear('created_at', $request->tahun);
            }

            $query = $query->get();
        }

        return response()->json($query);
    }


    public function approve(Request $request, $id)
    {
        // Pastikan user yang login adalah Kepala Bidang
        if (Auth::user()->role !== 'kepala_bidang') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk melakukan approval.');
        }

        // Mencari laporan pengajuan berdasarkan ID
        $laporanPengajuan = LaporanPengajuan::find($id);

        if (!$laporanPengajuan) {
            return redirect()->back()->with('error', 'Pengajuan laporan tidak ditemukan.');
        }

        // Melakukan approval laporan
        $laporanPengajuan->approved = true;
        $laporanPengajuan->approved_by = Auth::user()->id;
        $laporanPengajuan->approved_at = now();
        $laporanPengajuan->save();

        return redirect()->back()->with('success', 'Pengajuan laporan berhasil di-approve.');
    }

    public function cetak($id)
    {
        // Temukan laporan_pengajuan
        $laporanPengajuan = LaporanPengajuan::with('laporan.berita.reporters.user', 'laporan.suratMasuk', 'laporan.reporter.suratMasuk', 'laporan.reporter.user')->findOrFail($id);
        // dd($laporanPengajuan);
        // Format data QR Code
        $approvedAtFormatted = $laporanPengajuan->approved_at;
        $qrCodeText = "Laporan ID: {$laporanPengajuan->id}\nApproved By: {$laporanPengajuan->approvedBy->nama_lengkap}\nApproved At: {$approvedAtFormatted}";

        // Generate QR Code
        $qrCode = new QrCode($qrCodeText);
        $qrCode->setSize(200); // Meningkatkan ukuran QR code
        $qrCode->setMargin(10); // Menambahkan margin
        $qrCode->setEncoding(new Encoding('UTF-8')); // Menggunakan objek Encoding
        $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::High); // Tingkat koreksi kesalahan tinggi
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        // Encode QR Code to Base64
        $base64QrCode = base64_encode($result->getString());
        $qrCodeUrl = 'data:image/png;base64,' . $base64QrCode;

        // Inisialisasi Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);

        // Load konten HTML
        $html = view('laporan.cetak', [
            'laporanPengajuan' => $laporanPengajuan,
            'qrCodeUrl' => $qrCodeUrl,
        ])->render();
        $dompdf->loadHtml($html);

        // Set ukuran kertas dan orientasi
        $dompdf->setPaper('F4', 'landscape');

        // Render HTML sebagai PDF
        $dompdf->render();

        // Stream file ke browser
        return $dompdf->stream('laporan-pengajuan-' . $id . '.pdf');
    }

    public function ajukan(Request $request)
    {
        $request->validate([
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2000|max:2099',
            'jenis_laporan' => 'required|string'
        ]);

        // Save LaporanPengajuan
        $laporanPengajuan = new LaporanPengajuan();
        $laporanPengajuan->nama_pengajuan = 'Pengajuan Laporan ' . $request->jenis_laporan;
        $laporanPengajuan->keterangan = $request->keterangan;
        $laporanPengajuan->tanggal_pengajuan = now();
        $laporanPengajuan->approved = false;
        $laporanPengajuan->save();

        // Determine the type of report and save corresponding data
        if (str_starts_with($request->jenis_laporan, 'berita')) {
            $beritaIds = Berita::query()
                ->where('tipe_media', str_replace('berita_', '', $request->jenis_laporan))
                ->whereMonth('created_at', $request->bulan)
                ->whereYear('created_at', $request->tahun)
                ->pluck('id');

            if ($beritaIds->isEmpty()) {
                return response()->json(['error' => 'Tidak ada berita yang ditemukan untuk bulan dan tahun yang dipilih'], 404);
            }

            foreach ($beritaIds as $beritaId) {
                $laporan = new Laporan();
                $laporan->laporan_pengajuan_id = $laporanPengajuan->id;
                $laporan->berita_id = $beritaId;
                $laporan->save();
            }
        } elseif (in_array($request->jenis_laporan, ['iklan', 'peliputan'])) {
            $suratMasukIds = SuratMasuk::query()
                ->where('jenis', $request->jenis_laporan)
                ->whereMonth('created_at', $request->bulan)
                ->whereYear('created_at', $request->tahun)
                ->pluck('id');

            if ($suratMasukIds->isEmpty()) {
                return response()->json(['error' => 'Tidak ada surat masuk yang ditemukan untuk bulan dan tahun yang dipilih'], 404);
            }

            foreach ($suratMasukIds as $suratMasukId) {
                $laporan = new Laporan();
                $laporan->laporan_pengajuan_id = $laporanPengajuan->id;
                $laporan->surat_masuk_id = $suratMasukId;
                $laporan->save();
            }
        } elseif ($request->jenis_laporan == 'jadwal') {
            $reporterIds = Reporters::query()
                ->whereMonth('created_at', $request->bulan)
                ->whereYear('created_at', $request->tahun)
                ->pluck('id');

            if ($reporterIds->isEmpty()) {
                return response()->json(['error' => 'Tidak ada jadwal yang ditemukan untuk bulan dan tahun yang dipilih'], 404);
            }

            foreach ($reporterIds as $reporterId) {
                $laporan = new Laporan();
                $laporan->laporan_pengajuan_id = $laporanPengajuan->id;
                $laporan->reporter_id = $reporterId;
                $laporan->save();
            }
        }

        return response()->json(['success' => true]);
    }


    public function pengajuan(Request $request)
    {
        $laporanPengajuan = LaporanPengajuan::with('approvedBy')->get(); // Mengambil semua laporan pengajuan beserta data user yang menyetujui

        return view('laporan.pengajuan', [
            'title' => 'Data Laporan - Pengajuan',
            'laporanPengajuan' => $laporanPengajuan,
        ]);
    }
}
