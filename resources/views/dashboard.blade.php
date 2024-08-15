@extends('layout.cms')

@section('content')
    <main class="page-content">
        <div class="container">
            <h1>{{ $title }}</h1>
            <div class="row">
                @if (auth()->user()->role == 'superadmin')
                    <!-- Kartu: Total Pengguna -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Total Pengguna</div>
                            <div class="card-body">
                                <h5>{{ $userCount }}</h5>
                                <p>Jumlah pengguna yang terdaftar di sistem.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Kartu: Ikhtisar Surat Masuk -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Ikhtisar Surat Masuk</div>
                            <div class="card-body">
                                <h5>{{ $suratMasukCount }}</h5>
                                <p>Total surat masuk yang diterima.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Kartu: Artikel Berita -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Artikel Berita</div>
                            <div class="card-body">
                                <h5>{{ $newsCount }}</h5>
                                <p>Total jumlah artikel berita yang dipublikasikan.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Kartu: Status Persetujuan -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Status Persetujuan</div>
                            <div class="card-body">
                                <h5>{{ $approvalStatus }}</h5>
                                <p>Surat yang menunggu persetujuan.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Kartu: Jadwal Reporter -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Jadwal Reporter</div>
                            <div class="card-body">
                                <h5>{{ $reporterSchedule }}</h5>
                                <p>Jumlah tugas reporter yang terjadwal.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Kartu: Persetujuan Tertunda -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Persetujuan Tertunda</div>
                            <div class="card-body">
                                <h5>{{ $pendingApprovals }}</h5>
                                <p>Jumlah surat yang menunggu persetujuan.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Kartu: Ikhtisar Laporan -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Ikhtisar Laporan</div>
                            <div class="card-body">
                                <h5>{{ $reportsOverview }}</h5>
                                <p>Ringkasan semua laporan.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Kartu: Tugas yang Ditetapkan -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Tugas yang Ditetapkan</div>
                            <div class="card-body">
                                <h5>{{ $assignedTasks }}</h5>
                                <p>Jumlah tugas yang ditetapkan kepada semua pengguna.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Kartu: Acara yang Akan Datang -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Acara yang Akan Datang</div>
                            <div class="card-body">
                                <h5>{{ $upcomingEvents }}</h5>
                                <p>Jumlah acara yang akan datang.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Kartu: Pengajuan Berita -->
                    {{-- <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Pengajuan Berita</div>
                            <div class="card-body">
                                <h5>{{ $newsSubmissions }}</h5>
                                <p>Jumlah pengajuan berita yang menunggu tinjauan.</p>
                            </div>
                        </div>
                    </div> --}}
                @elseif(auth()->user()->role == 'admin')
                    <!-- Kartu: Ikhtisar Surat Masuk -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Ikhtisar Surat Masuk</div>
                            <div class="card-body">
                                <h5>{{ $suratMasukCount }}</h5>
                                <p>Total surat yang ditangani oleh admin.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Kartu: Status Persetujuan -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Status Persetujuan</div>
                            <div class="card-body">
                                <h5>{{ $approvalStatus }}</h5>
                                <p>Surat yang menunggu persetujuan.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Kartu: Jadwal Reporter -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Jadwal Reporter</div>
                            <div class="card-body">
                                <h5>{{ $reporterSchedule }}</h5>
                                <p>Jumlah tugas reporter yang terjadwal.</p>
                            </div>
                        </div>
                    </div>
                @elseif(auth()->user()->role == 'kepala_bidang')
                    <!-- Kartu: Persetujuan Tertunda -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Persetujuan Tertunda</div>
                            <div class="card-body">
                                <h5>{{ $pendingApprovals }}</h5>
                                <p>Jumlah surat yang menunggu persetujuan Anda.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Kartu: Ikhtisar Laporan -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Ikhtisar Laporan</div>
                            <div class="card-body">
                                <h5>{{ $reportsOverview }}</h5>
                                <p>Ringkasan semua laporan di bawah pengawasan Anda.</p>
                            </div>
                        </div>
                    </div>
                @elseif(auth()->user()->role == 'reporter')
                    <!-- Kartu: Tugas yang Ditetapkan -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Tugas yang Ditetapkan</div>
                            <div class="card-body">
                                <h5>{{ $assignedTasks }}</h5>
                                <p>Jumlah tugas yang ditetapkan kepada Anda.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Kartu: Acara yang Akan Datang -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Acara yang Akan Datang</div>
                            <div class="card-body">
                                <h5>{{ $upcomingEvents }}</h5>
                                <p>Jumlah acara yang akan datang untuk Anda liput.</p>
                            </div>
                        </div>
                    </div>
                @elseif(auth()->user()->role == 'sub_bagian_approval')
                    <!-- Kartu: Laporan yang Tertunda -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Data Berita</div>
                            <div class="card-body">
                                <h5>{{ $approvedReports }}</h5>
                                <p>Berita yang sudah di approve.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Kartu: Pengajuan Berita -->
                    {{-- <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Pengajuan Berita</div>
                            <div class="card-body">
                                <h5>{{ $newsSubmissions }}</h5>
                                <p>Jumlah pengajuan berita yang menunggu tinjauan.</p>
                            </div>
                        </div>
                    </div> --}}
                @endif
            </div>
        </div>
    </main>
@endsection
