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
    <h1>Laporan Pengajuan</h1>
    <h2>Detail Pengajuan</h2>

    <p><strong>Nama Pengajuan:</strong> {{ $laporanPengajuan->nama_pengajuan }}</p>
    <p><strong>Keterangan:</strong> {{ $laporanPengajuan->keterangan }}</p>
    <p><strong>Status:</strong> {{ $laporanPengajuan->approved ? 'Approved' : 'Pending' }}</p>

    <h3>Daftar Laporan</h3>

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
                <h4>Reporter</h4>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Surat</th>
                            <th>Nama Pengirim</th>
                            <th>Nama Reporter</th>
                            <th>Tipe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $laporan->reporter->nama_surat ?? 'N/A' }}</td>
                            <td>{{ $laporan->reporter->nama_pengirim ?? 'N/A' }}</td>
                            <td>{{ $laporan->reporter->nama_lengkap ?? 'N/A' }}</td>
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
            {{ \Carbon\Carbon::parse($laporanPengajuan->tanggal_pengajuan)->format('d-m-Y') }}</p>
        <img src="{{ $qrCodeUrl }}" alt="QR Code">
    </div>
</body>

</html>
