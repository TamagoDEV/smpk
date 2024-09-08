@extends('layout.cms')

@section('content')
    <main class="page-content">
        <h6 class="mb-0 text-uppercase">Data Jadwal Reporter</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Acara</th>
                                <th>Tanggal Acara</th>
                                <th>Nama Reporter</th>
                                <th>Tipe</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reporters as $index => $reporter)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ ucwords(strtolower($reporter->suratMasuk->nama_acara ?? 'N/A')) }}</td>
                                    <td>{{ ucwords(strtolower($reporter->suratMasuk->tanggal_acara ?? 'N/A')) }}</td>
                                    <td>{{ ucwords(strtolower($reporter->user->nama_lengkap ?? 'N/A')) }}</td>
                                    <td>{{ ucwords(strtolower($reporter->tipe)) }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm"
                                            data-id="{{ $reporter->surat_masuk_id }}"
                                            onclick="showDetails({{ $reporter->surat_masuk_id }})">Detail Surat</button>

                                        @if (Auth::user()->role === 'reporter')
                                            {{-- Mengganti 'hasRole' dengan metode yang sesuai untuk memeriksa peran pengguna --}}
                                            <a href="{{ route('berita.create', ['reporter' => $reporter->id]) }}"
                                                class="btn btn-primary btn-sm">Buat Berita</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>


    <!-- Detail Surat Masuk -->
    <div class="modal fade" id="suratMasukModal" tabindex="-1" aria-labelledby="suratMasukModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="suratMasukModalLabel">Detail Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Jenis Surat:</strong> <span id="jenis"></span></p>
                    <p><strong>Nama Pengirim:</strong> <span id="nama_pengirim"></span></p>
                    <p><strong>Instansi:</strong> <span id="instansi"></span></p>
                    <p><strong>Bidang:</strong> <span id="bidang"></span></p>
                    <p><strong>No HP:</strong> <span id="no_hp"></span></p>
                    <p><strong>Kontak Lain:</strong> <span id="kontak_lain"></span></p>
                    <!-- Tambahkan detail lainnya sesuai kebutuhan -->
                    <p><strong>Nama Acara:</strong> <span id="nama_acara"></span></p>
                    <p><strong>Lokasi Acara:</strong> <span id="lokasi_acara"></span></p>
                    <p><strong>Waktu Acara:</strong> <span id="waktu_acara"></span></p>
                    <p><strong>Tanggal Acara:</strong> <span id="tanggal_acara"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- Modal script -->
<script>
    function showDetails(id) {
        fetch(`{{ url('/surat-masuk') }}/${id}/details-peliputan`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('jenis').textContent = data.jenis;
                document.getElementById('nama_pengirim').textContent = data.nama_pengirim;
                document.getElementById('instansi').textContent = data.instansi;
                document.getElementById('bidang').textContent = data.bidang;
                document.getElementById('no_hp').textContent = data.no_hp;
                document.getElementById('kontak_lain').textContent = data.kontak_lain;
                // Update field lainnya jika diperlukan
                document.getElementById('nama_acara').textContent = data.nama_acara;
                document.getElementById('lokasi_acara').textContent = data.lokasi_acara;
                document.getElementById('waktu_acara').textContent = data.waktu_acara;
                document.getElementById('tanggal_acara').textContent = data.tanggal_acara;
                new bootstrap.Modal(document.getElementById('suratMasukModal')).show();
            });
    }
</script>
