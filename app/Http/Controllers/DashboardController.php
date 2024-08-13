<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Reporters;
use App\Models\SuratMasuk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userRole = Auth::user()->role;
        $data = ['title' => 'Dashboard'];

        if ($userRole == 'superadmin') {
            $data['userCount'] = User::count();
            $data['suratMasukCount'] = SuratMasuk::count();
            $data['newsCount'] = Laporan::count();
            $data['approvalStatus'] = SuratMasuk::where('approved', false)->count();
            $data['reporterSchedule'] = Reporters::count(); // Assuming this counts all reporter tasks
            $data['pendingApprovals'] = SuratMasuk::where('approved', false)->count();
            $data['reportsOverview'] = Laporan::count();
            $data['assignedTasks'] = Reporters::count(); // Assuming superadmin needs all tasks
            $data['upcomingEvents'] = Reporters::where('created_at', '>=', now())->count(); // Use created_at instead of event_date
            // $data['newsSubmissions'] = Laporan::where('status', 'pending')->count();
        } elseif ($userRole == 'admin') {
            $data['suratMasukCount'] = SuratMasuk::count();
            $data['approvalStatus'] = SuratMasuk::where('approved', false)->count();
            $data['reporterSchedule'] = Reporters::count(); // Adjust as needed
        } elseif ($userRole == 'kepala_bidang') {
            $data['pendingApprovals'] = SuratMasuk::where('approved', false)->count();
            $data['reportsOverview'] = Laporan::count(); // Adjust as needed
        } elseif ($userRole == 'reporter') {
            $data['assignedTasks'] = Reporters::where('user_id', Auth::id())->count();
            $data['upcomingEvents'] = Reporters::where('user_id', Auth::id())->where('created_at', '>=', now())->count(); // Use created_at instead of event_date
        } elseif ($userRole == 'sub_bagian_approval') {
            $data['pendingReports'] = Laporan::where('approved', false)->count();
            // $data['newsSubmissions'] = Laporan::where('status', 'pending')->count();
        }

        return view('dashboard', $data);
    }
}
