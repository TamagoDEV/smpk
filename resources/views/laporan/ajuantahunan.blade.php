@extends('layout.cms')

@section('content')
    <main class="page-content">
        <h6 class="mb-0 text-uppercase">Laporan</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <form id="filterForm">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <select class="form-select" name="tahun" id="tahun">
                                <option value="" disabled selected>Tahun</option>
                                @foreach (range(date('Y'), 2000) as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
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
                        <div class="col-md-4">
                            <button id="submitReport" type="button" class="btn btn-primary">Ajukan Laporan</button>
                        </div>
                    </div>
                </form>

                <div id="loading" style="display:none;">Loading...</div>

                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead id="tableHeader">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // const formElements = document.querySelectorAll('#bulan, #tahun, #jenis_laporan');
            const formElements = document.querySelectorAll(' #tahun, #jenis_laporan');

            formElements.forEach(function(element) {
                element.addEventListener('change', function() {
                    fetchReports();
                });
            });

            function fetchReports() {
                document.getElementById('loading').style.display = 'block';

                // const bulan = document.querySelector('#bulan').value;
                const tahun = document.querySelector('#tahun').value;
                const jenis_laporan = document.querySelector('#jenis_laporan').value;

                fetch(`{{ route('laporan.filter') }}?tahun=${tahun}&jenis_laporan=${jenis_laporan}`)
                    .then(response => response.json())
                    .then(data => {
                        const tableBody = document.querySelector('#reportTableBody');
                        const tableHeader = document.querySelector('#headerRow');
                        tableBody.innerHTML = '';
                        tableHeader.innerHTML = '';

                        let headers = [];
                        if (jenis_laporan.startsWith('berita')) {
                            headers = ['No', 'Judul', 'Penulis', 'Tanggal Pengajuan', 'Approve',
                                'Tanggal Diapprove'
                            ];

                            if (jenis_laporan === 'berita_youtube') {
                                headers.push('YouTube');
                            }

                            data.forEach((report, index) => {
                                console.log(report);

                                // Format tanggal menjadi "Month Day, Year"
                                let formattedDate = new Intl.DateTimeFormat('en-US', {
                                    month: 'long',
                                    day: 'numeric',
                                    year: 'numeric'
                                }).format(new Date(report.created_at));

                                let row = `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${report.judul || 'N/A'}</td>
                                <td>${report.reporters[0].user.nama_lengkap}</td>
                                <td>${formattedDate}</td>
                                    <td>${report.approved_by ? 'Approved' : 'Pending'}</td>
                                    <td>${report.approved_at || 'N/A'}</td>
                            `;

                                if (jenis_laporan === 'berita_youtube') {
                                    row += `<td>${report.link_youtube || 'N/A'}</td>`;
                                }

                                row += `</tr>`;

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
                            headers = ['No', 'Nama Acara', 'Tanggal Acara', 'Tempat', 'Nama Reporter', 'Tipe'];
                            data.forEach((report, index) => {
                                const row = `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${report.surat_masuk ? report.surat_masuk.nama_acara : 'N/A'}</td>
                                    <td>${report.surat_masuk ? report.surat_masuk.tanggal_acara : 'N/A'}</td>
                                    <td>${report.user ? report.surat_masuk.lokasi_acara: 'N/A'}</td>
                                    <td>${report.user ? report.user.nama_lengkap: 'N/A'}</td>
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
                // const bulan = document.querySelector('#bulan').value;
                const tahun = document.querySelector('#tahun').value;
                const jenis_laporan = document.querySelector('#jenis_laporan').value;

                fetch('{{ route('laporan.ajukanTahunan') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            // bulan: bulan,
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
