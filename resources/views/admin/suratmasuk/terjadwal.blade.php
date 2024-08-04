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
                                    <td>.</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editUserModal" data-id="{{ $sm->id }}">Buat
                                            Berita</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Data User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="nama_depan" class="form-label">Nama Depan</label>
                                <input type="text" class="form-control" id="nama_depan" name="nama_depan">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="nama_belakang" class="form-label">Nama Belakang</label>
                                <input type="text" class="form-control" id="nama_belakang" name="nama_belakang">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="superadmin">Superadmin</option>
                                <option value="admin">Admin</option>
                                <option value="kepala_bidang">Kepala Bidang</option>
                                <option value="reporter">Reporter</option>
                                <option value="sub_bagian_approval">Sub Bagian Approval</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                            <img id="foto-preview" src="#" alt="Foto Preview"
                                style="display: none; max-width: 100%; height: auto; margin-top: 10px; border: 1px solid #ddd; padding: 5px;" />
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="instansi" class="form-label">Instansi</label>
                                <input type="text" class="form-control" id="instansi" name="instansi">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="bidang" class="form-label">Bidang</label>
                                <input type="text" class="form-control" id="bidang" name="bidang">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">Nomor HP</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
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
                    const userId = this.getAttribute('data-id');
                    fetch(`/users/${userId}/edit`)
                        .then(response => response.json())
                        .then(data => {
                            const form = document.getElementById('editUserForm');
                            form.action = `/users/${userId}`;
                            form.querySelector('#nama_depan').value = data.nama_depan;
                            form.querySelector('#nama_belakang').value = data.nama_belakang;
                            form.querySelector('#nama_lengkap').value = data.nama_lengkap;
                            form.querySelector('#username').value = data.username;
                            form.querySelector('#email').value = data.email;
                            form.querySelector('#role').value = data.role;
                            form.querySelector('#tempat_lahir').value = data.tempat_lahir;
                            form.querySelector('#tanggal_lahir').value = data.tanggal_lahir;
                            form.querySelector('#instansi').value = data.instansi;
                            form.querySelector('#bidang').value = data.bidang;
                            form.querySelector('#alamat').value = data.alamat;
                            form.querySelector('#no_hp').value = data.no_hp;

                            // Preview existing photo
                            const fotoPreview = document.getElementById('foto-preview');
                            if (data.foto) {
                                fotoPreview.src = `{{ Storage::url('${data.foto}') }}`;
                                fotoPreview.style.display = 'block';
                            } else {
                                fotoPreview.style.display = 'none';
                            }
                        });
                });
            });
        });
    </script>
@endsection
