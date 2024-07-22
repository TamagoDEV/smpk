<!doctype html>
<html lang="en" class="semi-dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ url('assets/images/favicon-32x32.png') }}" type="image/png" />
    <!-- Bootstrap CSS -->
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- loader-->
    <link href="{{ url('assets/css/pace.min.css') }}" rel="stylesheet" />

    <title>{{ $title }}</title>
</head>

<body class="bg-login">

    <!--start wrapper-->
    <div class="wrapper">

        <!--start content-->
        <main class="authentication-content">
            <div class="container">
                <div class="mt-4">
                    <div class="card rounded-5 overflow-hidden shadow border mb-5 mb-lg-0 ">
                        <div class="row g-0">
                            <div
                                class="col-12 order-1 col-xl-7 d-flex align-items-center justify-content-center border-end">
                                <img src="{{ url('assets/images/error/auth-img-7.png') }}" class="img-fluid"
                                    alt="">
                            </div>


                            <div class="col-12 col-xl-5 order-xl-2">
                                <div class="card-body p-4 p-sm-5">
                                    <img src="{{ url('assets/img/kominfo.png') }}" class=" card-img-top"></i>
                                    <h5 class="card-title mt-4" style="margin-top: -25px;">Masuk</h5>
                                    <p class="card-text mb-4">Selamat Datang di Halaman SMPK</p>



                                    <form action="{{ route('login.process') }}" method="post" class="form-body">
                                        @csrf
                                        <div class="row g-3">

                                            @if ($errors->any())
                                                <div class="alert border-0 bg-light-danger alert-dismissible fade show">
                                                    @foreach ($errors->all() as $error)
                                                        <div class="text-danger">{{ $error }}</div>
                                                    @endforeach
                                                </div>
                                            @endif
                                            @if (session('error'))
                                                <div class="alert border-0 bg-light-danger alert-dismissible fade show">
                                                    <div class="text-danger">{{ session('error') }}</div>
                                                </div>
                                            @endif

                                            <div class="col-12">
                                                <label for="login" class="form-label">Username/Email</label>
                                                <div class="ms-auto position-relative">
                                                    <div
                                                        class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                        <i class="bi bi-person-circle"></i>
                                                    </div>
                                                    <input type="text" class="form-control radius-30 ps-5"
                                                        id="login" placeholder="Username or Email" name="login"
                                                        required value="{{ old('login') }}">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="password" class="form-label">Enter Password</label>
                                                <div class="ms-auto position-relative">
                                                    <div
                                                        class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                        <i class="bi bi-lock-fill"></i>
                                                    </div>
                                                    <input type="password" class="form-control radius-30 ps-5"
                                                        id="password" placeholder="Password" name="password" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckChecked" name="remember">
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckChecked">Remember Me</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary radius-30">Sign
                                                        In</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!--end wrapper-->


    <!--plugins-->
    <script src="{{ url('assets/js/jquery.min.js') }}"></script>
    <script src="{{ url('assets/js/pace.min.js') }}"></script>


</body>

</html>
