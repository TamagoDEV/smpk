<!doctype html>
<html lang="en" class="dark-theme">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/smart-wizard/css/smart_wizard_all.min.css') }}" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
    <!--Theme Styles-->
    <link href="{{ asset('assets/css/dark-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/light-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/semi-dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/header-colors.css') }}" rel="stylesheet" />
    <title>{{ $title }}</title>

    <style>
        /* Custom CSS */
        .card {
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }

        .card-body {
            flex: 1;
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.5rem;
            margin-bottom: 0.75rem;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background-color: #f8f9fa;
            border-bottom-left-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
        }
    </style>
</head>

<body>

    <!--start wrapper-->
    <div class="wrapper">
        <!--start navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 20px;">
            <a class="navbar-brand" href="/" style="margin-left: 20px;">Sistem Manajemen Pemberitahuan
                Komunikasi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <form class="d-flex ms-auto">
                    <a href="{{ route('kirim-surat') }}" class="btn btn-primary">Surat Masuk</a>
                </form>
            </div>
        </nav>
        <!--end navbar-->

        <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
        <!--end overlay-->



        <!--start sidebar-->
        <aside class="sidebar">
            <!-- Sidebar content -->
        </aside>
        <!--end sidebar-->

        <!--start content-->
        <main class="content">
            <div class="container">
                <h1 class="mb-4">{{ $berita->judul }}</h1>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">



                                @if ($berita->foto)
                                <div class="mb-4">
                                    <center>
                                        <strong></strong>
                                        <img src="{{ Storage::url($berita->foto) }}" class="img-fluid mt-2" alt="Foto Berita">
                                    </center>
                                </div>
                                @endif

                                @if ($berita->keterangan)
                                <div class="mb-4">
                                    <strong>Keterangan:</strong> {{ $berita->keterangan }}
                                </div>
                                @endif


                                <div class="mb-4">{!! nl2br(e($berita->isi)) !!}</div>

                                @if ($berita->link_youtube)
                                <div class="mb-4">
                                    <strong>Link YouTube:</strong> <a href="{{ $berita->link_youtube }}" target="_blank" class="btn btn-outline-danger mt-2">Tonton Video</a>
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
                                    <strong>Naskah:</strong> <a href="{{ Storage::url($berita->naskah) }}" target="_blank" class="btn btn-outline-primary mt-2">Download Naskah</a>
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
                                    <p><strong>Oleh:</strong> {{ $berita->approvedBy->nama_lengkap ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <a href="{{ route('home') }}" class="btn btn-primary mt-3 w-100">Kembali ke
                                Daftar
                                Berita</a>
                        </div>
                    </div>
                    <hr style="margin-top: 20px;">
                    <h5>Tambah Komentar</h5>
                    <form action="{{ route('komentar.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="berita_id" value="{{ $berita->id }}">
                        <div class="mb-3">
                            <textarea name="isi" class="form-control" rows="3" placeholder="Tambahkan komentar..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                    </form>

                    <!-- Daftar Komentar -->
                    <h5 style="margin-top: 10px;">Komentar</h5>
                    @foreach ($berita->komentar as $komentar)
                    <div class="mb-2">
                        <p>{{ $komentar->isi }}</p>
                        <small>{{ $komentar->created_at->format('d M Y, H:i') }}</small>
                        <hr>
                    </div>
                    @endforeach
                </div>
            </div>
        </main>
        <!--end content-->
    </div>
    <!--end wrapper-->

    <!-- JavaScript -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/smart-wizard/js/jquery.smartWizard.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.js"></script>
</body>

</html>