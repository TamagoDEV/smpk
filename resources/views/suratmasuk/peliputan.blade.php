@extends('layout.cms')

@section('content')
    <main class="page-content">
        <h6 class="mb-0 text-uppercase">Data Surat Masuk</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Surat</th>
                                <th>Nama Pengirim</th>
                                <th>Tanggal dibuat</th>
                                <th>Status</th>
                                <th>Approval</th>
                                <th style="text-align: center;">#</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peliputan as $index => $sm)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ ucwords($sm->jenis) }}</td>
                                    <td>{{ ucwords($sm->nama_pengirim) }}</td>
                                    <td>{{ $sm->created_at }}</td>
                                    <td>
                                        <span
                                            class="status-jadwal {{ $sm->status_jadwal == 'Belum Terjadwal' ? 'status-belum-terjadwal' : 'status-sudah-terjadwal' }}">
                                            {{ $sm->status_jadwal }}
                                        </span>
                                    </td>
                                    <td>{{ ucwords($sm->kepalaBidang->nama_lengkap ?? '-') }}</td>
                                    <td style="text-align:
                                    center;">
                                        <button type="button" class="btn btn-success btn-sm" data-id="{{ $sm->id }}"
                                            onclick="showDetails({{ $sm->id }})"
                                            @if (!$sm->kepalaBidang) disabled @endif title="Unduh Surat Iklan">
                                            <i class="lni lni-download" style="margin-left: -1px; text-align:center;"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-id="{{ $sm->id }}"
                                            onclick="showDetails({{ $sm->id }})">Detail</button>

                                        @if (auth()->user()->role == 'kepala_bidang' && !$sm->approved)
                                            <form action="{{ route('surat-masuk/approve', $sm->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-warning btn-sm">Approve</button>
                                            </form>
                                        @endif

                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#assignReporterModal" data-id="{{ $sm->id }}"
                                            data-jenis="{{ $sm->jenis }}" data-tipe_iklan="{{ $sm->tipe_iklan }}"
                                            data-periode="{{ $sm->periode }}" data-harga="{{ $sm->harga }}"
                                            data-ppn="{{ $sm->ppn }}" data-nama_acara="{{ $sm->nama_acara }}"
                                            data-lokasi_acara="{{ $sm->lokasi_acara }}"
                                            data-waktu_acara="{{ $sm->waktu_acara }}"
                                            data-tanggal_acara="{{ $sm->tanggal_acara }}"
                                            @if (!$sm->approved) disabled @endif
                                            title="{{ !$sm->approved ? 'Approve terlebih dahulu' : 'Tambah Reporter' }}">
                                            Reporter
                                        </button>

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

    <!-- Modal Tambah Reporter -->
    <div class="modal fade" id="assignReporterModal" tabindex="-1" aria-labelledby="assignReporterModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignReporterModalLabel">Tambah Reporter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="assignReporterForm" method="POST" action="">
                    @csrf
                    <input type="hidden" name="surat_masuk_id" id="surat_masuk_id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="reporter_ids" class="form-label">Pilih Reporter</label>
                            <select multiple class="form-select" id="reporter_ids" name="reporter_ids[]" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tipe" class="form-label">Tipe Reporter</label>
                            <select class="form-select" id="tipe" name="tipe" required>
                                <option value="media">Media</option>
                                <option value="diskominfo">Diskominfo</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Detail Surat Masuk -->
    <div class="modal fade" id="suratMasukModal" tabindex="-1" aria-labelledby="suratMasukModalLabel"
        aria-hidden="true">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var assignReporterModal = document.getElementById('assignReporterModal');
        assignReporterModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var suratMasukId = button.getAttribute('data-id');
            var form = document.getElementById('assignReporterForm');
            form.action = '/surat-masuk/' + suratMasukId + '/assign_reporter';

            // Clear previous selections
            var select = form.querySelector('#reporter_ids');
            select.value = [];

            // Fetch and set selected reporters
            fetch(`/surat-masuk/${suratMasukId}/data`)
                .then(response => response.json())
                .then(data => {
                    select.value = data.reporters.map(reporter => reporter.user_id);
                });
        });
    });
</script>
