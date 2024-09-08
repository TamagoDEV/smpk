<?php

namespace App\Http\Controllers;

use App\Models\Reporters;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReporterController extends Controller
{
    // Method untuk menampilkan daftar surat masuk terjadwal
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'reporter') {
            // Menampilkan jadwal milik reporter yang sedang login, diurutkan berdasarkan tanggal acara paling dekat
            $reporters = Reporters::with(['user', 'suratMasuk'])
                ->where('user_id', $user->id)
                ->orderedByEventDate()
                ->get();
        } else {
            // Menampilkan semua jadwal, diurutkan berdasarkan tanggal acara paling dekat
            $reporters = Reporters::with(['user', 'suratMasuk'])
                ->orderedByEventDate()
                ->get();
        }

        return view('reporter.terjadwal', [
            'title' => 'Data Jadwal Reporter',
            'reporters' => $reporters,
        ]);
    }
}
