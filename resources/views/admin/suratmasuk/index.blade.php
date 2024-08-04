@extends('layout.cms')

@section('content')
    <main class="page-content">
        <h6 class="mb-0 text-uppercase">Data Surat Masuk</h6>
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
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suratmasuk as $index => $sm)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $sm->jenis }}</td>
                                    <td>{{ $sm->nama_pengirim }}</td>
                                    <td>{{ $sm->created_at }}</td>
                                    <td>
                                        <span
                                            class="status-jadwal {{ $sm->status_jadwal == 'Belum Terjadwal' ? 'status-belum-terjadwal' : 'status-sudah-terjadwal' }}">
                                            {{ $sm->status_jadwal }}
                                        </span>
                                        <!-- Button di tabel yang membuka modal -->
                                        <button type="button" class="btn btn-primary btn-sm" style="margin-left: 10px;"
                                            data-bs-toggle="modal" data-bs-target="#checkReporterModal"
                                            data-id="{{ $sm->id }}" title="Check Reporter"><i
                                                class="fadeIn animated bx bx-message-alt-check"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#assignReporterModal" data-id="{{ $sm->id }}"
                                            data-jenis="{{ $sm->jenis }}" data-tipe_iklan="{{ $sm->tipe_iklan }}"
                                            data-periode="{{ $sm->periode }}" data-harga="{{ $sm->harga }}"
                                            data-ppn="{{ $sm->ppn }}" data-nama_acara="{{ $sm->nama_acara }}"
                                            data-lokasi_acara="{{ $sm->lokasi_acara }}"
                                            data-waktu_acara="{{ $sm->waktu_acara }}"
                                            data-tanggal_acara="{{ $sm->tanggal_acara }}">Tambah Reporter</button>
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
    <div class="modal fade" id="assignReporterModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Reporter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="assignReporterForm" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="reporters" class="form-label">Pilih Reporter</label>
                            <select class="form-control" id="reporters" name="reporters[]" multiple required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tipe" class="form-label">Tipe</label>
                            <select class="form-control" id="tipe" name="tipe" required>
                                <option value="media">Media</option>
                                <option value="diskominfo">Diskominfo</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis</label>
                            <input type="text" class="form-control" id="jenis" name="jenis" readonly>
                        </div>
                        <div id="iklanFields" style="display: none;">
                            <div class="mb-3">
                                <label for="tipe_iklan" class="form-label">Tipe Iklan</label>
                                <input type="text" class="form-control" id="tipe_iklan" name="tipe_iklan" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="periode" class="form-label">Periode</label>
                                <input type="text" class="form-control" id="periode" name="periode" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="text" class="form-control" id="harga" name="harga" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="ppn" class="form-label">PPN</label>
                                <input type="text" class="form-control" id="ppn" name="ppn" readonly>
                            </div>
                        </div>

                        <div id="peliputanFields" style="display: none;">
                            <div class="mb-3">
                                <label for="nama_acara" class="form-label">Nama Acara</label>
                                <input type="text" class="form-control" id="nama_acara" name="nama_acara" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="lokasi_acara" class="form-label">Lokasi Acara</label>
                                <input type="text" class="form-control" id="lokasi_acara" name="lokasi_acara"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="waktu_acara" class="form-label">Waktu Acara</label>
                                <input type="text" class="form-control" id="waktu_acara" name="waktu_acara" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_acara" class="form-label">Tanggal Acara</label>
                                <input type="date" class="form-control" id="tanggal_acara" name="tanggal_acara"
                                    readonly>
                            </div>
                        </div>
                        <!-- Modal Tambah Reporter -->
                        <div class="modal fade" id="assignReporterModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Reporter</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="assignReporterForm" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="reporters" class="form-label">Pilih Reporter</label>
                                                <select class="form-control" id="reporters" name="reporters[]" multiple
                                                    required>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->nama_lengkap }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tipe" class="form-label">Tipe</label>
                                                <select class="form-control" id="tipe" name="tipe" required>
                                                    <option value="media">Media</option>
                                                    <option value="diskominfo">Diskominfo</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="jenis" class="form-label">Jenis</label>
                                                <input type="text" class="form-control" id="jenis" name="jenis"
                                                    readonly>
                                            </div>

                                            <!-- Group for Iklan -->
                                            <div id="iklanFields" style="display: none;">
                                                <div class="mb-3">
                                                    <label for="tipe_iklan" class="form-label">Tipe Iklan</label>
                                                    <input type="text" class="form-control" id="tipe_iklan"
                                                        name="tipe_iklan" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="periode" class="form-label">Periode</label>
                                                    <input type="text" class="form-control" id="periode"
                                                        name="periode" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="harga" class="form-label">Harga</label>
                                                    <input type="text" class="form-control" id="harga"
                                                        name="harga" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="ppn" class="form-label">PPN</label>
                                                    <input type="text" class="form-control" id="ppn"
                                                        name="ppn" readonly>
                                                </div>
                                            </div>

                                            <!-- Group for Peliputan -->
                                            <div id="peliputanFields" style="display: none;">
                                                <div class="mb-3">
                                                    <label for="nama_acara" class="form-label">Nama Acara</label>
                                                    <input type="text" class="form-control" id="nama_acara"
                                                        name="nama_acara" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="lokasi_acara" class="form-label">Lokasi Acara</label>
                                                    <input type="text" class="form-control" id="lokasi_acara"
                                                        name="lokasi_acara" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="waktu_acara" class="form-label">Waktu Acara</label>
                                                    <input type="text" class="form-control" id="waktu_acara"
                                                        name="waktu_acara" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tanggal_acara" class="form-label">Tanggal Acara</label>
                                                    <input type="date" class="form-control" id="tanggal_acara"
                                                        name="tanggal_acara" readonly>
                                                </div>
                                            </div>



                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Check Reporter -->
    <div class="modal fade" id="checkReporterModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reporter yang Ditambahkan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul id="reporter-list" class="list-group"></ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var assignReporterModal = document.getElementById('assignReporterModal');
            assignReporterModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-id');
                var jenisSurat = button.getAttribute('data-jenis');
                var tipeIklan = button.getAttribute('data-tipe_iklan');
                var periode = button.getAttribute('data-periode');
                var harga = button.getAttribute('data-harga');
                var ppn = button.getAttribute('data-ppn');
                var namaAcara = button.getAttribute('data-nama_acara');
                var lokasiAcara = button.getAttribute('data-lokasi_acara');
                var waktuAcara = button.getAttribute('data-waktu_acara');
                var tanggalAcara = button.getAttribute('data-tanggal_acara');

                console.log("Jenis Surat: ", jenisSurat); // Debugging

                var form = document.getElementById('assignReporterForm');
                form.action = "{{ url('surat_masuk') }}/" + id + "/assign_reporter";

                document.getElementById('jenis').value = jenisSurat;

                // Clear all fields
                document.getElementById('tipe_iklan').value = '';
                document.getElementById('periode').value = '';
                document.getElementById('harga').value = '';
                document.getElementById('ppn').value = '';
                document.getElementById('nama_acara').value = '';
                document.getElementById('lokasi_acara').value = '';
                document.getElementById('waktu_acara').value = '';
                document.getElementById('tanggal_acara').value = '';

                if (jenisSurat === 'iklan') {
                    console.log("Showing iklanFields"); // Debugging
                    document.getElementById('iklanFields').style.display = 'block';
                    document.getElementById('peliputanFields').style.display = 'none';

                    document.getElementById('tipe_iklan').value = tipeIklan;
                    document.getElementById('periode').value = periode;
                    document.getElementById('harga').value = harga;
                    document.getElementById('ppn').value = ppn;
                } else if (jenisSurat === 'peliputan') {
                    console.log(jenisSurat, namaAcara, lokasiAcara, waktuAcara, tanggalAcara);
                    document.getElementById('peliputanFields').style.display = 'block';
                    document.getElementById('iklanFields').style.display = 'none';

                    document.getElementById('nama_acara').value = namaAcara;
                    document.getElementById('lokasi_acara').value = lokasiAcara;
                    document.getElementById('waktu_acara').value = waktuAcara;
                    document.getElementById('tanggal_acara').value = tanggalAcara;
                }
            });

            var checkReporterModal = document.getElementById('checkReporterModal');
            checkReporterModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-id');

                fetch(`/suratmasuk/${id}/data`)
                    .then(response => response.json())
                    .then(data => {
                        const reporterList = document.getElementById('reporter-list');
                        reporterList.innerHTML = ''; // Clear the list before adding new items

                        data.reporters.forEach(reporter => {
                            const listItem = document.createElement('li');
                            listItem.classList.add('list-group-item');

                            // Create span elements for name and type
                            const namaLengkap = document.createElement('span');
                            namaLengkap.innerText = reporter.user.nama_lengkap || 'No name';

                            const tipe = document.createElement('span');
                            tipe.classList.add('badge', 'bg-secondary',
                                'ms-2'); // Example styling with Bootstrap badge
                            tipe.innerText = reporter.tipe || 'No type';

                            // Append name and type to list item
                            listItem.appendChild(namaLengkap);
                            listItem.appendChild(tipe);

                            // Append list item to the list
                            reporterList.appendChild(listItem);
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    </script>
@endsection
