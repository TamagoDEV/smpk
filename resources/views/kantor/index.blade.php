@extends('layout.cms')
@section('content')
    <main class="page-content">
        <h6 class="mb-0 text-uppercase">Data User</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <a href="{{ route('kantor.create') }}" class="btn btn-primary">Tambah karyawan</a>
                </div>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>jabatan</th>
                                <th>telpon</th>
                                <th>alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kantor as $index => $kantor)
                                <tr>
                                    <td>{{ $index + 1 }}</td>

                                    <td>{{ $kantor->nama }}</td>
                                    <td>{{ $kantor->jabatan }}</td>
                                    <td>{{ $kantor->telpon }}</td>
                                    <td>{{ $kantor->alamat }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-edit" data-bs-toggle="modal"
                                            data-bs-target="#editkantorModal" data-id="{{ $kantor->id }}">Ubah</button>
                                        <form action="{{ route('kantors.destroy', $kantor->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
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

    <!-- Edit kantor Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Data Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                            <div class="mb-3">
                                <label for="jabatan" class="form-label">jabatan</label>
                                <input type="text" class="form-control" id="jabatan" name="jabatan">
                            </div>
                            <div class="mb-3">
                                <label for="telpon" class="form-label">telpon</label>
                                <textarea class="form-control" id="telpon" name="telpon"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.btn-edit');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const karyawanId = this.getAttribute('data-id');
                    fetch(`/users/${karyawanId}/edit`)
                        .then(response => response.json())
                        .then(data => {
                            const form = document.getElementById('editUserForm');
                            form.action = `/karyawan/${karyawanId}`;
                            form.querySelector('#nama').value = data.nama;
                            form.querySelector('#jabatan').value = data.jabatan;
                            form.querySelector('#telpon').value = data.telpon;
                            form.querySelector('#alamat').value = data.alamat;

                            // Preview existing photo


                        });
                });
            });

            // Handle image preview

        });
    </script>
@endsection
