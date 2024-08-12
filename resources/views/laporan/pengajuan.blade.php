@extends('layout.cms')

@section('content')
    <main class="page-content">
        <h6 class="mb-0 text-uppercase">Data Pengajuan Laporan</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pengajuan</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Nama Approval</th>
                                <th>Status Approval</th>
                                <th>Tanggal Approval</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laporanPengajuan as $index => $pengajuan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pengajuan->nama_pengajuan }}</td>
                                    <td>{{ $pengajuan->tanggal_pengajuan }}</td>
                                    <td>{{ $pengajuan->approvedBy->nama_lengkap ?? 'N/A' }}</td>
                                    <td>{{ $pengajuan->approved ? 'Disetujui' : 'Belum Disetujui' }}</td>
                                    <td>{{ $pengajuan->approved_at ?? 'N/A' }}</td>
                                    <td>
                                        @if (Auth::user()->role === 'kepala_bidang' && !$pengajuan->approved)
                                            <form action="{{ route('laporan.approve', $pengajuan->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success">Approve</button>
                                            </form>
                                        @endif
                                        @if ($pengajuan->approved)
                                            <a href="{{ route('laporan.cetak', ['id' => $pengajuan->id]) }}"
                                                class="btn btn-primary">Cetak</a>
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
@endsection
