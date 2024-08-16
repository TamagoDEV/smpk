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
    <link href="{{ asset('assets/plugins/smart-wizard/css/smart_wizard_all.min.css') }}" rel="stylesheet"
        type="text/css" />
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->

        <!--start switcher-->
        <div class="switcher-body">
            <button class="btn btn-primary btn-switcher shadow-sm" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i
                    class="bi bi-paint-bucket me-0"></i></button>
            <div class="offcanvas offcanvas-end shadow border-start-0 p-2" data-bs-scroll="true"
                data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling">
                <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Theme Customizer</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <h6 class="mb-0">Theme Variation</h6>
                    <hr>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="theme" id="theme-light" value="light"
                            checked>
                        <label class="form-check-label" for="theme-light">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="theme" id="theme-dark" value="dark">
                        <label class="form-check-label" for="theme-dark">Dark</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="theme" id="theme-semi-dark"
                            value="semi-dark">
                        <label class="form-check-label" for="theme-semi-dark">Semi-Dark</label>
                    </div>
                    <hr>
                    <h6 class="mb-0">Header Colors</h6>
                    <hr>
                    <div class="color-picker">
                        <input type="color" id="header-color" value="#343a40">
                        <label for="header-color">Header Color</label>
                    </div>
                </div>
            </div>
        </div>
        <!--end switcher-->

        <!--start sidebar-->
        <aside class="sidebar">
            <!-- Sidebar content -->
        </aside>
        <!--end sidebar-->

        <!--start content-->
        <main class="content">
            <div class="container-fluid">
                <div class="row">
                    @foreach ($berita as $item)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card">
                                @if ($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" class="card-img-top"
                                        alt="Image">
                                @endif
                                <div class="card-body">
                                    <h2 class="card-title">{{ $item->judul }}</h2>
                                    <div class="card-text">
                                        <!-- Additional content can be added here if needed -->
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <span class="text-muted">Published by
                                        @if ($item->reporters->isNotEmpty())
                                            @php
                                                // Mengambil reporter pertama
                                                $firstReporter = $item->reporters->first();
                                            @endphp
                                            {{ $firstReporter->user->nama_lengkap ?? 'N/A' }}
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                    <span class="text-muted">{{ $item->created_at->format('d M Y') }}</span>
                                    <a href="{{ route('berita.detail-publik', $item->id) }}"
                                        class="btn btn-primary btn-sm">
                                        <i class="bi bi-info-circle"></i> Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>
        <!--end content-->
    </div>
    <!--end wrapper-->

    <!-- Bootstrap Bundle with Popper -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/smart-wizard/js/jquery.smartWizard.min.js') }}"></script>
    <script src="{{ asset('assets/js/drag-drop.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
