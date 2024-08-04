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
                                <th>Jenis Surat</th>
                                <th>Nama Reporter</th>
                                <th>Tipe</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reporters as $index => $reporter)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ ucwords(strtolower($reporter->suratMasuk->jenis ?? 'N/A')) }}</td>
                                    <td>{{ ucwords(strtolower($reporter->user->nama_lengkap ?? 'N/A')) }}</td>
                                    <td>{{ ucwords(strtolower($reporter->tipe)) }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning     btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editUserModal" data-id="{{ $reporter->id }}">Detail
                                            Surat</button>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editUserModal" data-id="{{ $reporter->id }}">Buat
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
@endsection
