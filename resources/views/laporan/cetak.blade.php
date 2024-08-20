<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Pengajuan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            height: 80px;
            vertical-align: middle;
        }

        .header div {
            display: inline-block;
            vertical-align: middle;
            text-align: left;
        }

        .header h3,
        .header p {
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Print Styles */
        @media print {
            .no-print {
                display: none;
            }
        }

        /* Signature and QR Code positioning */
        .signature {
            float: right;
            text-align: center;
            margin-top: 40px;
        }

        .signature img {
            width: 100px;
            height: 100px;
            display: block;
            margin: 10px auto;
        }
    </style>
</head>

<body>
    <div class="header">
        <?php
        $path = public_path('assets/img/logo.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        ?>
        <div style="display: flex; align-items: center; border-bottom: 2px solid #000; padding-bottom: 10px;">
            <img src="<?= $base64 ?>" alt="logo icon" style="width: 70px; height: auto; margin-right: 20px;">
            <div style="text-align:center;">
                <h3 style="margin: 0; font-size: 18px;">Dinas Komunikasi dan Informatika Kabupaten Tanah Laut</h3>
                <p style="margin: 0; font-size: 14px;">
                    Jl. A. Syairani Komplek Perkantoran Gagas, Kecamatan Pelaihari, Kabupaten Tanah Laut, Provinsi
                    Kalimantan Selatan 70814<br>
                    Telp: 0822 5081 5857 | Email: kominfo.tala@gmail.com
                </p>
            </div>
        </div>
    </div>

    @if ($laporanPengajuan->laporan->first()->berita)
        @if ($laporanPengajuan->laporan->first()->berita->tipe_media == 'website')
            <h3>Laporan Berita Website Bulan {{ $laporanPengajuan->bulan }} Tahun {{ $laporanPengajuan->tahun }} </h3>
        @elseif ($laporanPengajuan->laporan->first()->berita->tipe_media == 'radio')
            <h3>Laporan Berita Radio Bulan {{ $laporanPengajuan->bulan }} Tahun {{ $laporanPengajuan->tahun }} </h3>
        @elseif ($laporanPengajuan->laporan->first()->berita->tipe_media == 'youtube')
            <h3>Laporan Berita Youtube Bulan {{ $laporanPengajuan->bulan }} Tahun {{ $laporanPengajuan->tahun }} </h3>
        @elseif ($laporanPengajuan->laporan->first()->berita->tipe_media == 'media')
            <h3>Laporan Berita Media Bulan {{ $laporanPengajuan->bulan }} Tahun {{ $laporanPengajuan->tahun }} </h3>
        @endif
    @elseif ($laporanPengajuan->laporan->first()->suratMasuk)
        <h3>Laporan Surat Masuk Bulan {{ $laporanPengajuan->bulan }} Tahun {{ $laporanPengajuan->tahun }} </h3>
    @elseif ($laporanPengajuan->laporan->first()->reporter)
        <h3>Laporan Jadwal Bulan {{ $laporanPengajuan->bulan }} Tahun {{ $laporanPengajuan->tahun }} </h3>
    @endif

    @if ($laporanPengajuan->laporan->count() > 0)
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <!-- Tabel Header berdasarkan jenis laporan -->
                    @if ($laporanPengajuan->laporan->first()->berita)
                        <th>No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Approve</th>
                        <th>Tanggal Diapprove</th>
                    @elseif ($laporanPengajuan->laporan->first()->suratMasuk)
                        <th>No</th>
                        <th>Nama Pengirim</th>
                        <th>Instansi</th>
                        <th>Bidang</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    @elseif ($laporanPengajuan->laporan->first()->reporter)
                        <th>No</th>
                        <th>Nama Acara</th>
                        <th>Tanggal Acara</th>
                        <th>Tempat</th>
                        <th>Nama Reporter</th>
                        <th>Tipe</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                @foreach ($laporanPengajuan->laporan as $laporan)
                    @if ($laporan->berita)
                        <!-- Berita -->
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $laporan->berita->judul ?? 'N/A' }}</td>
                            <td>{{ $laporan->berita->reporters->first()->user->nama_lengkap ?? 'N/A' }}</td>
                            <td>{{ $laporan->created_at->format('d-m-Y') ?? 'N/A' }}</td>
                            <td>{{ $laporan->berita->approvedBy->nama_lengkap ?? 'N/A' }}</td>
                            <td>{{ $laporan->berita->approved_at ? $laporan->berita->approved_at : 'N/A' }}</td>
                        </tr>
                        @if ($laporan->berita->tipe_media == 'youtube')
                            <!-- Link YouTube -->
                            <tr>
                                <td colspan="6">
                                    <h5>Link YouTube:</h5>
                                    <a href="{{ $laporan->berita->link_youtube }}"
                                        target="_blank">{{ $laporan->berita->link_youtube }}</a>
                                </td>
                            </tr>
                        @endif
                    @elseif ($laporan->suratMasuk)
                        <!-- Surat Masuk -->
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $laporan->suratMasuk->nama_pengirim ?? 'N/A' }}</td>
                            <td>{{ $laporan->suratMasuk->instansi ?? 'N/A' }}</td>
                            <td>{{ $laporan->suratMasuk->bidang ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($laporan->suratMasuk->tanggal)->format('d-m-Y') ?? 'N/A' }}
                            </td>
                            <td>{{ $laporan->suratMasuk->approved === 1 ? 'Sudah Disetujui' : 'Belum Disetujui' }}
                            </td>
                        </tr>
                    @elseif ($laporan->reporter)
                        <!-- Reporter -->
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $laporan->reporter->suratMasuk->nama_acara ?? 'N/A' }}</td>
                            <td>{{ $laporan->reporter->suratMasuk->tanggal_acara ?? 'N/A' }}</td>
                            <td>{{ $laporan->reporter->suratMasuk->lokasi_acara ?? 'N/A' }}</td>
                            <td>{{ $laporan->reporter->user->nama_lengkap ?? 'N/A' }}</td>
                            <td>{{ $laporan->reporter->tipe ?? 'N/A' }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada laporan untuk ditampilkan.</p>
    @endif

    <!-- Signature and QR Code -->
    <div class="signature">

        <p><strong>Tanah Laut,</strong>
            {{ \Carbon\Carbon::parse($laporanPengajuan->tanggal_pengajuan)->locale('id')->format('d F Y') }}</p>
        <p><strong>Kepala Bidang Komunikasi</strong></p>
        <img src="{{ $qrCodeUrl }}" alt="QR Code">
        <p><strong>{{ $laporanPengajuan->approvedBy->nama_lengkap }}</strong> </p>
    </div>

</body>

</html>
