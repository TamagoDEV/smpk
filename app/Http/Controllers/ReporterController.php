<?php

namespace App\Http\Controllers;

use App\Models\Reporters;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class ReporterController extends Controller
{
    //
    // Method untuk menampilkan daftar surat masuk terjadwal
    public function index()
    {
        $reporters = Reporters::with(['user', 'suratMasuk'])->get();
        return view('reporter.terjadwal', [
            'title' => 'Data Jadwal Reporter',
            'reporters' => $reporters,
        ]);
    }
}
