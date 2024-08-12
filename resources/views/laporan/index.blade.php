@extends('layout.cms')

@section('content')
    <main class="page-content">
        <h6 class="mb-0 text-uppercase">Laporan</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <form id="filterForm">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <select class="form-select" name="bulan" id="bulan">
                                <option value="" disabled selected>Bulan</option>
                                @foreach (range(1, 12) as $month)
                                    <option value="{{ $month }}">
                                        {{ \Carbon\Carbon::createFromFormat('m', $month)->translatedFormat('F') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" name="tahun" id="tahun">
                                <option value="" disabled selected>Tahun</option>
                                @foreach (range(date('Y'), 2000) as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" name="jenis_laporan" id="jenis_laporan">
                                <option value="" disabled selected>Laporan Apa</option>
                                <option value="berita_website">Berita Website</option>
                                <option value="berita_radio">Berita Radio</option>
                                <option value="berita_youtube">Berita YouTube</option>
                                <option value="berita_media">Berita Media</option>
                                <option value="iklan">Surat Iklan</option>
                                <option value="peliputan">Surat Peliputan</option>
                                <option value="jadwal">Jadwal</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button id="submitReport" type="button" class="btn btn-primary">Ajukan Laporan</button>
                        </div>
                    </div>
                </form>

                <div id="loading" style="display:none;">Loading...</div>

                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead id="tableHeader">
                            <!-- Headers will be dynamically set here -->
                            <tr id="headerRow">
                                <!-- Dynamic headers will be inserted here -->
                            </tr>
                        </thead>
                        <tbody id="reportTableBody">
                            <!-- Data will be dynamically inserted here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    {{-- <td>${report.foto ? `<img src="${report.foto}" width="50"/>` : 'N/A'}</td> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formElements = document.querySelectorAll('#bulan, #tahun, #jenis_laporan');

            formElements.forEach(function(element) {
                element.addEventListener('change', function() {
                    fetchReports();
                });
            });

            function fetchReports() {
                document.getElementById('loading').style.display = 'block';

                const bulan = document.querySelector('#bulan').value;
                const tahun = document.querySelector('#tahun').value;
                const jenis_laporan = document.querySelector('#jenis_laporan').value;

                fetch(`{{ route('laporan.filter') }}?bulan=${bulan}&tahun=${tahun}&jenis_laporan=${jenis_laporan}`)
                    .then(response => response.json())
                    .then(data => {
                        const tableBody = document.querySelector('#reportTableBody');
                        const tableHeader = document.querySelector('#headerRow');
                        tableBody.innerHTML = '';
                        tableHeader.innerHTML = '';

                        let headers = [];
                        if (jenis_laporan.startsWith('berita')) {
                            headers = ['No', 'Tipe Media', 'Judul', 'Isi', 'Link YouTube', 'Audio', 'Naskah',
                                'Keterangan'
                            ];
                            data.forEach((report, index) => {
                                const row = `
        <tr>
            <td>${index + 1}</td>
            <td>${report.tipe_media || 'N/A'}</td>
            <td>${report.judul || 'N/A'}</td>
            <td>${report.isi || 'N/A'}</td>
            <td>${report.link_youtube || 'N/A'}</td>
            <td>${report.audio || 'N/A'}</td>
            <td>${report.naskah || 'N/A'}</td>
            <td>${report.keterangan || 'N/A'}</td>
        </tr>
        `;
                                tableBody.insertAdjacentHTML('beforeend', row);
                            });
                        } else if (jenis_laporan === 'iklan') {
                            headers = ['No', 'Nama Pengirim', 'Instansi', 'Bidang', 'Tanggal', 'Status'];
                            data.forEach((report, index) => {
                                const row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${report.nama_pengirim || 'N/A'}</td>
                        <td>${report.instansi || 'N/A'}</td>
                        <td>${report.bidang || 'N/A'}</td>
                        <td>${new Date(report.created_at).toLocaleDateString()}</td>
                        <td>${report.approved ? 'Approved' : 'Pending'}</td>
                    </tr>
                `;
                                tableBody.insertAdjacentHTML('beforeend', row);
                            });
                        } else if (jenis_laporan === 'peliputan') {
                            headers = ['No', 'Nama Pengirim', 'Instansi', 'Bidang', 'Tanggal', 'Status'];
                            data.forEach((report, index) => {
                                const row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${report.nama_pengirim || 'N/A'}</td>
                        <td>${report.instansi || 'N/A'}</td>
                        <td>${report.bidang || 'N/A'}</td>
                        <td>${new Date(report.created_at).toLocaleDateString()}</td>
                        <td>${report.approved ? 'Approved' : 'Pending'}</td>
                    </tr>
                `;
                                tableBody.insertAdjacentHTML('beforeend', row);
                            });
                        } else if (jenis_laporan === 'jadwal') {
                            headers = ['No', 'Nama Surat', 'Nama Pengirim', 'Nama Reporter', 'Tipe'];
                            data.forEach((report, index) => {
                                const row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${report.surat_masuk ? report.surat_masuk.jenis : 'N/A'}</td>
                            <td>${report.surat_masuk ? report.surat_masuk.nama_pengirim : 'N/A'}</td>
                            <td>${report.user ? report.user.nama_lengkap : 'N/A'}</td>
                            <td>${report.tipe || 'N/A'}</td>
                        </tr>
                    `;
                                tableBody.insertAdjacentHTML('beforeend', row);
                            });
                        }

                        headers.forEach(header => {
                            tableHeader.insertAdjacentHTML('beforeend', `<th>${header}</th>`);
                        });

                        document.getElementById('loading').style.display = 'none';
                    });
            }

            document.getElementById('submitReport').addEventListener('click', function() {
                const bulan = document.querySelector('#bulan').value;
                const tahun = document.querySelector('#tahun').value;
                const jenis_laporan = document.querySelector('#jenis_laporan').value;

                fetch('{{ route('laporan.ajukan') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            bulan: bulan,
                            tahun: tahun,
                            jenis_laporan: jenis_laporan
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Laporan berhasil diajukan!');
                            // Optionally, redirect or update UI based on response
                        } else {
                            alert('Gagal mengajukan laporan.');
                        }
                    });
            });
        });
    </script>
@endsection
