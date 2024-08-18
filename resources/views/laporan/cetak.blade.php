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
    </div>

    <h3>Laporan Pengajuan Liputan Yang Telah Diproses</h3>

    @if ($laporanPengajuan->laporan->count() > 0)
        @foreach ($laporanPengajuan->laporan as $laporan)
            @if ($laporan->berita)
                <!-- Berita -->
                <h4>Berita</h4>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tipe Media</th>
                            <th>Judul</th>
                            <th>Isi</th>
                            <th>Link YouTube</th>
                            <th>Audio</th>
                            <th>Naskah</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $laporan->berita->tipe_media ?? 'N/A' }}</td>
                            <td>{{ $laporan->berita->judul ?? 'N/A' }}</td>
                            <td>{{ $laporan->berita->isi ?? 'N/A' }}</td>
                            <td>{{ $laporan->berita->link_youtube ?? 'N/A' }}</td>
                            <td>{{ $laporan->berita->audio ?? 'N/A' }}</td>
                            <td>{{ $laporan->berita->naskah ?? 'N/A' }}</td>
                            <td>{{ $laporan->berita->keterangan ?? 'N/A' }}</td>
                        </tr>
                    </tbody>
                </table>
            @elseif ($laporan->suratMasuk)
                <!-- Surat Masuk -->
                <h4>Surat Masuk</h4>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengirim</th>
                            <th>Instansi</th>
                            <th>Bidang</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $laporan->suratMasuk->nama_pengirim ?? 'N/A' }}</td>
                            <td>{{ $laporan->suratMasuk->instansi ?? 'N/A' }}</td>
                            <td>{{ $laporan->suratMasuk->bidang ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($laporan->suratMasuk->tanggal)->format('d-m-Y') ?? 'N/A' }}
                            </td>
                            <td>{{ $laporan->suratMasuk->approved === 1 ? 'Sudah Disetujui' : 'Belum Disetujui' }}</td>
                        </tr>
                    </tbody>
                </table>
            @elseif ($laporan->reporter)
                <!-- Reporter -->
                <h4>Jadwal</h4>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Acara</th>
                            <th>Tanggal Acara</th>
                            <th>Tempat</th>
                            <th>Nama Reporter</th>
                            <th>Tipe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $laporan->reporter->suratMasuk->nama_acara ?? 'N/A' }}</td>
                            <td>{{ $laporan->reporter->suratMasuk->tanggal_acara ?? 'N/A' }}</td>
                            <td>{{ $laporan->reporter->suratMasuk->lokasi_acara ?? 'N/A' }}</td>
                            <td>{{ $laporan->reporter->user->nama_lengkap ?? 'N/A' }}</td>
                            <td>{{ $laporan->reporter->tipe ?? 'N/A' }}</td>
                        </tr>
                    </tbody>
                </table>
            @endif
        @endforeach
    @else
        <p>Tidak ada laporan untuk ditampilkan.</p>
    @endif
    <!-- Signature and QR Code -->
    <div style="margin-top: 40px;">
        <h3>Signature</h3>
        <p><strong>Tanggal Pengajuan:</strong>
            {{ \Carbon\Carbon::parse($laporanPengajuan->tanggal_pengajuan)->locale('id')->format('d F Y') }}</p>
        <p><strong>Tanda Tangan Pengesah</strong></p>
        <img src="{{ $qrCodeUrl }}" alt="QR Code" style="display: block; margin: 10px 0;">
        <p><strong>{{ $laporanPengajuan->approvedBy->nama_lengkap }}</strong> </p>
    </div>

</body>

</html>
