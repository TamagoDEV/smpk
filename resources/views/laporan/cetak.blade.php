<!DOCTYPE html>
<html>

<head>
    <title>Laporan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .signature {
            margin-top: 30px;
            text-align: right;
        }
    </style>
</head>

<body>
    <h1>Laporan</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Laporan</th>
                <th>Nama Pengirim</th>
                <th>Instansi</th>
                <th>Bidang</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $report->jenis }}</td>
                    <td>{{ $report->nama_pengirim }}</td>
                    <td>{{ $report->instansi }}</td>
                    <td>{{ $report->bidang }}</td>
                    <td>{{ $report->created_at->format('d-m-Y') }}</td>
                    <td>{{ $report->approved ? 'Approved' : 'Pending' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature">
        <p>Mengetahui,</p>
        <p>Kepala Bidang</p>
        <p>(Tanda Tangan)</p>
    </div>
</body>

</html>
