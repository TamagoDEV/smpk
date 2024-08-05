@extends('layout.cms')

@section('content')
    <main class="page-content">
        <h6 class="mb-0 text-uppercase">Data Surat Approved</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Surat</th>
                                <th>Nama Pengirim</th>
                                <th>Tanggal dibuat</th>
                                <th>Approval</th>
                                <th style="text-align: center;">#</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($approved as $index => $sm)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $sm->jenis }}</td>
                                    <td>{{ $sm->nama_pengirim }}</td>
                                    <td>{{ $sm->created_at }}</td>
                                    <td>{{ ucwords($sm->kepalaBidang->nama_lengkap ?? '-') }}</td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-success btn-sm" data-id="{{ $sm->id }}"
                                            onclick="downloadSurat({{ $sm->id }})"
                                            @if (!$sm->kepalaBidang) disabled @endif title="Unduh Surat Iklan">
                                            <i class="lni lni-download" style="margin-left: -1px; text-align:center;"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-id="{{ $sm->id }}"
                                            onclick="showDetails({{ $sm->id }}, '{{ $sm->jenis }}')">Detail</button>

                                        <form action="{{ route('surat_masuk.destroy', $sm->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Detail Surat Masuk Modal -->
    <div class="modal fade" id="suratMasukModal" tabindex="-1" aria-labelledby="suratMasukModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="suratMasukModalLabel">Detail Surat Masuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Jenis Surat:</strong> <span id="jenis"></span></p>
                    <p><strong>Nama Pengirim:</strong> <span id="nama_pengirim"></span></p>
                    <p><strong>Instansi:</strong> <span id="instansi"></span></p>
                    <p><strong>Bidang:</strong> <span id="bidang"></span></p>
                    <p><strong>No HP:</strong> <span id="no_hp"></span></p>
                    <p><strong>Kontak Lain:</strong> <span id="kontak_lain"></span></p>

                    <!-- Fields for Iklan -->
                    <div id="iklanFields">
                        <p><strong>Tipe Iklan:</strong> <span id="tipe_iklan"></span></p>
                        <p><strong>Periode:</strong> <span id="periode"></span></p>
                        <p><strong>Harga:</strong> <span id="harga"></span></p>
                        <p><strong>PPN:</strong> <span id="ppn"></span></p>
                    </div>

                    <!-- Fields for Peliputan -->
                    <div id="peliputanFields">
                        <p><strong>Nama Acara:</strong> <span id="nama_acara"></span></p>
                        <p><strong>Lokasi Acara:</strong> <span id="lokasi_acara"></span></p>
                        <p><strong>Waktu Acara:</strong> <span id="waktu_acara"></span></p>
                        <p><strong>Tanggal Acara:</strong> <span id="tanggal_acara"></span></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal script -->
    <script>
        function showDetails(id, jenis) {
            fetch(`{{ url('/surat-masuk') }}/${id}/details-iklan`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('jenis').textContent = data.jenis;
                    document.getElementById('nama_pengirim').textContent = data.nama_pengirim;
                    document.getElementById('instansi').textContent = data.instansi;
                    document.getElementById('bidang').textContent = data.bidang;
                    document.getElementById('no_hp').textContent = data.no_hp;
                    document.getElementById('kontak_lain').textContent = data.kontak_lain;

                    if (jenis === 'iklan') {
                        document.getElementById('tipe_iklan').textContent = data.tipe_iklan;
                        document.getElementById('periode').textContent = data.periode;
                        document.getElementById('harga').textContent = data.harga;
                        document.getElementById('ppn').textContent = data.ppn;

                        document.getElementById('iklanFields').style.display = 'block';
                        document.getElementById('peliputanFields').style.display = 'none';
                    } else if (jenis === 'peliputan') {
                        document.getElementById('nama_acara').textContent = data.nama_acara;
                        document.getElementById('lokasi_acara').textContent = data.lokasi_acara;
                        document.getElementById('waktu_acara').textContent = data.waktu_acara;
                        document.getElementById('tanggal_acara').textContent = data.tanggal_acara;

                        document.getElementById('iklanFields').style.display = 'none';
                        document.getElementById('peliputanFields').style.display = 'block';
                    }

                    new bootstrap.Modal(document.getElementById('suratMasukModal')).show();
                });
        }

        function downloadSurat(id) {
            window.location.href = `{{ url('/surat-masuk') }}/${id}/download`;
        }
    </script>
@endsection
