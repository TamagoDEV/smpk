<!doctype html>
<html lang="en" class="semi-dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
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

<body class="bg-register">

    <!--start wrapper-->
    <div class="wrapper">

        <!--start content-->
        <main class="authentication-content mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto">
                        <div class="card shadow rounded-5 overflow-hidden">
                            <div class="card-body p-4 p-sm-5">
                                <h5 class="card-title">Form Pengajuan Surat</h5>
                                <p class="card-text mb-5">Silakan isi form di bawah ini untuk mengajukan surat.</p>

                                <!-- Alert Success -->
                                @if (session('success'))
                                    <div class="alert border-0 bg-light-success alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="fs-3 text-success"><i class="bi bi-check-circle-fill"></i></div>
                                            <div class="ms-3">
                                                <div class="text-success">{{ session('success') }}</div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <!-- Alert Error -->
                                @if ($errors->any())
                                    <div class="alert border-0 bg-light-danger alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="fs-3 text-danger"><i class="bi bi-x-circle-fill"></i></div>
                                            <div class="ms-3">
                                                <div class="text-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <form class="form-body" action="{{ route('submit-surat') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="jenisSurat" class="form-label">Pilih Jenis Surat</label>
                                        <select class="form-select" id="jenisSurat" name="jenis" required>
                                            <option value="" disabled selected>Pilih Jenis Surat</option>
                                            <option value="iklan">Iklan</option>
                                            <option value="peliputan">Peliputan</option>
                                        </select>
                                    </div>

                                    <!-- Data Pribadi Pengirim -->
                                    <div class="mb-3">
                                        <label for="namaPengirim" class="form-label">Nama Pengirim</label>
                                        <input type="text" class="form-control" id="namaPengirim"
                                            name="nama_pengirim" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="instansi" class="form-label">Instansi</label>
                                        <input type="text" class="form-control" id="instansi" name="instansi"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="bidang" class="form-label">Bidang</label>
                                        <input type="text" class="form-control" id="bidang" name="bidang"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="noHp" class="form-label">No HP</label>
                                        <input type="text" class="form-control" id="noHp" name="no_hp"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kontakLain" class="form-label">Kontak Lain (Opsional)</label>
                                        <input type="text" class="form-control" id="kontakLain" name="kontak_lain">
                                    </div>

                                    <div id="formIklan" style="display: none;">
                                        <div class="mb-3">
                                            <label for="tipeIklan" class="form-label">Tipe Iklan</label>
                                            <input type="text" class="form-control" id="tipeIklan"
                                                name="tipe_iklan">
                                        </div>
                                        <div class="mb-3">
                                            <label for="periode" class="form-label">Periode</label>
                                            <input type="text" class="form-control" id="periode"
                                                name="periode">
                                        </div>
                                        <div class="mb-3">
                                            <label for="harga" class="form-label">Harga</label>
                                            <input type="number" class="form-control" id="harga"
                                                name="harga">
                                        </div>
                                        <div class="mb-3">
                                            <label for="ppn" class="form-label">PPN (11%)</label>
                                            <input type="number" class="form-control" id="ppn"
                                                name="ppn">
                                        </div>
                                    </div>

                                    <div id="formPeliputan" style="display: none;">
                                        <div class="mb-3">
                                            <label for="namaAcara" class="form-label">Nama Acara</label>
                                            <input type="text" class="form-control" id="namaAcara"
                                                name="nama_acara">
                                        </div>
                                        <div class="mb-3">
                                            <label for="lokasiAcara" class="form-label">Lokasi Acara</label>
                                            <input type="text" class="form-control" id="lokasiAcara"
                                                name="lokasi_acara">
                                        </div>
                                        <div class="mb-3">
                                            <label for="waktuAcara" class="form-label">Waktu Acara</label>
                                            <input type="text" class="form-control" id="waktuAcara"
                                                name="waktu_acara">
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggalAcara" class="form-label">Tanggal Acara</label>
                                            <input type="date" class="form-control" id="tanggalAcara"
                                                name="tanggal_acara">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="dokumenSurat" class="form-label">Dokumen Surat</label>
                                        <input class="form-control" type="file" id="dokumenSurat"
                                            name="dokumen_surat">
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Kirim Surat</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!--end page main-->

    </div>
    <!--end wrapper-->

    <!-- Bootstrap JS -->
    <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        document.getElementById('jenisSurat').addEventListener('change', function() {
            var formIklan = document.getElementById('formIklan');
            var formPeliputan = document.getElementById('formPeliputan');

            if (this.value === 'iklan') {
                formIklan.style.display = 'block';
                formPeliputan.style.display = 'none';
            } else if (this.value === 'peliputan') {
                formIklan.style.display = 'none';
                formPeliputan.style.display = 'block';
            } else {
                formIklan.style.display = 'none';
                formPeliputan.style.display = 'none';
            }
        });
    </script>
</body>

</html>
