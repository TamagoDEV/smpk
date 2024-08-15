@extends('layout.cms')

@section('content')
    <main class="page-content">
        <h6 class="mb-0 text-uppercase">Data Berita</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Reporter</th>
                                <th>Tipe Media</th>
                                <th>Jenis Berita</th>
                                <th>Judul Berita</th>
                                <th>Approval</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($berita as $index => $beritaItem)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        @if ($beritaItem->reporters->isNotEmpty())
                                            @php
                                                // Mengambil reporter pertama
                                                $firstReporter = $beritaItem->reporters->first();
                                            @endphp
                                            {{ $firstReporter->user->nama_lengkap ?? 'N/A' }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ ucwords(strtolower($beritaItem->tipe_media)) }}</td>
                                    <td>{{ ucwords(strtolower($beritaItem->suratMasuk->jenis ?? 'N/A')) }}</td>
                                    <td>{{ $beritaItem->judul }}</td>
                                    <td>
                                        @if ($beritaItem->approved_by)
                                            {{ $beritaItem->approvedBy->nama_lengkap ?? 'Unknown' }}
                                        @elseif ($beritaItem->rejected_by)
                                            <span
                                                style="background-color: gray; color: white; padding: 5px 10px; border-radius: 15px; display: inline-block;">
                                                Ditolak
                                            </span>
                                        @else
                                            <span
                                                style="background-color: red; color: white; padding: 5px 10px; border-radius: 15px; display: inline-block;">
                                                Belum di Approve
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('berita.detail', $beritaItem->id) }}"
                                            class="btn btn-info btn-sm">Detail Berita</a>

                                        @if (auth()->user()->role === 'sub_bagian_approval' && !$beritaItem->approved_by && !$beritaItem->rejected_by)
                                            <form id="approve-form-{{ $beritaItem->id }}"
                                                action="{{ route('berita.approve', $beritaItem->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Approve
                                                    Berita</button>
                                            </form>

                                            <form id="reject-form-{{ $beritaItem->id }}"
                                                action="{{ route('berita.reject', $beritaItem->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-warning btn-sm">Tolak Berita</button>
                                            </form>
                                        @endif

                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#buatBeritaModal" data-id="{{ $beritaItem->id }}">Hapus
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Konfirmasi saat mengklik tombol approve
            document.querySelectorAll('form[id^="approve-form-"]').forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Apakah Anda yakin ingin menyetujui berita ini?')) {
                        e.preventDefault(); // Mencegah pengiriman form
                    }
                });
            });

            // Konfirmasi saat mengklik tombol reject
            document.querySelectorAll('form[id^="reject-form-"]').forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Apakah Anda yakin ingin menolak berita ini?')) {
                        e.preventDefault(); // Mencegah pengiriman form
                    }
                });
            });
        });
    </script>
@endsection
