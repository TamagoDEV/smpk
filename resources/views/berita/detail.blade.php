@extends('layout.cms')

@section('content')
    <main class="page-content">
        <div class="container">
            <h1 class="mb-4">{{ $berita->judul }}</h1>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Detail Berita</h5>
                            <p><strong>Tipe Media:</strong> {{ ucwords(strtolower($berita->tipe_media)) }}</p>
                            <p><strong>Jenis Berita:</strong> {{ ucwords(strtolower($berita->suratMasuk->jenis ?? 'N/A')) }}
                            </p>
                            <p><strong>Isi:</strong></p>
                            <div class="mb-4">{!! nl2br(e($berita->isi)) !!}</div>

                            @if ($berita->foto)
                                <div class="mb-4">
                                    <strong>Foto:</strong>
                                    <img src="{{ Storage::url($berita->foto) }}" class="img-fluid mt-2" alt="Foto Berita">
                                </div>
                            @endif

                            @if ($berita->link_youtube)
                                <div class="mb-4">
                                    <strong>Link YouTube:</strong> <a href="{{ $berita->link_youtube }}" target="_blank"
                                        class="btn btn-outline-danger mt-2">Tonton Video</a>
                                </div>
                            @endif

                            @if ($berita->audio)
                                <div class="mb-4">
                                    <strong>Audio:</strong>
                                    <audio controls class="w-100 mt-2">
                                        <source src="{{ Storage::url($berita->audio) }}" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                </div>
                            @endif

                            @if ($berita->naskah)
                                <div class="mb-4">
                                    <strong>Naskah:</strong> <a href="{{ Storage::url($berita->naskah) }}" target="_blank"
                                        class="btn btn-outline-primary mt-2">Download Naskah</a>
                                </div>
                            @endif

                            @if ($berita->keterangan)
                                <div class="mb-4">
                                    <strong>Keterangan:</strong> {{ $berita->keterangan }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sticky-top">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Informasi Berita</h5>
                                <p><strong>Tanggal:</strong> {{ $berita->created_at->format('d M Y') }}</p>
                                <p><strong>Oleh:</strong> {{ $berita->author ?? 'Admin' }}</p>
                            </div>
                        </div>
                        <a href="{{ route('berita.index') }}" class="btn btn-primary mt-3 w-100">Kembali ke Daftar
                            Berita</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
