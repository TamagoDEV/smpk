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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($berita as $index => $beritaItem)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        @if ($beritaItem->suratMasuk)
                                            @php
                                                $firstReporter = $beritaItem->suratMasuk->reporters->first();
                                            @endphp
                                            {{ $firstReporter ? $firstReporter->user->nama_lengkap : 'N/A' }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ ucwords(strtolower($beritaItem->tipe_media)) }}</td>
                                    <td>{{ ucwords(strtolower($beritaItem->suratMasuk->jenis ?? 'N/A')) }}</td>
                                    <td>{{ $beritaItem->judul }}</td>
                                    <td>
                                        <a href="{{ route('berita.detail', $beritaItem->id) }}"
                                            class="btn btn-info btn-sm">Detail Berita</a>
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
@endsection
