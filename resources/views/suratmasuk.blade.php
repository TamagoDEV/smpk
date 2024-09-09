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
                                        <select class="form-select" id="jenisSurat" name="jenisSurat" required>
                                            <option value="" disabled selected>Pilih Jenis Surat</option>
                                            <option value="iklan">Iklan</option>
                                            <option value="peliputan">Peliputan</option>
                                        </select>
                                    </div>

                                    <!-- Data Pribadi Pengirim -->
                                    <div class="mb-3">
                                        <label for="namaPengirim" class="form-label">Nama Pengirim</label>
                                        <input type="text" class="form-control" id="namaPengirim" name="namaPengirim"
                                            required>
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
                                        <input type="text" class="form-control" id="noHp" name="noHp"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kontakLain" class="form-label">Kontak Lain (Opsional)</label>
                                        <input type="text" class="form-control" id="kontakLain" name="kontakLain">
                                    </div>
                                    {{-- form peliputan  --}}
                                    <div id="formPeliputan" style="display: none;">
                                        <div class="mb-3">
                                            <label for="namaAcara" class="form-label">Nama Acara</label>
                                            <input type="text" class="form-control" id="namaAcara"
                                                name="namaAcara">
                                        </div>
                                        <div class="mb-3">
                                            <label for="lokasiAcara" class="form-label">Lokasi Acara</label>
                                            <input type="text" class="form-control" id="lokasiAcara"
                                                name="lokasiAcara">
                                        </div>
                                        <div class="mb-3">
                                            <label for="waktuAcara" class="form-label">Waktu Acara</label>
                                            <input type="text" class="form-control" id="waktuAcara"
                                                name="waktuAcara">
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggalAcara" class="form-label">Tanggal Acara</label>
                                            <input type="date" class="form-control" id="tanggalAcara"
                                                name="tanggalAcara">
                                        </div>
                                    </div>


                                    <div id="formIklan" style="display: none;">
                                        <div class="mb-3">
                                            <label for="tipeIklan" class="form-label">Tipe Iklan</label>
                                            <select class="form-select" id="tipeIklan" name="tipeIklan">
                                                <option value="" disabled selected>Pilih Tipe Iklan</option>
                                                <option value="billboard">Billboard</option>
                                                <option value="radio">Radio</option>
                                            </select>
                                        </div>

                                        <!-- Form Iklan Billboard -->
                                        <div id="formBillboard" style="display: none;">
                                            <div class="mb-3">
                                                <label for="lokasiBillboard" class="form-label">Lokasi
                                                    Billboard</label>
                                                <select class="form-select" id="lokasiBillboard"
                                                    name="lokasiBillboard">
                                                    <option value="" disabled selected>Pilih Lokasi</option>
                                                    <option value="alun-alun">Alun-Alun</option>
                                                    <option value="pasar-senen">Pasar Senen</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="jenisBillboard" class="form-label">Jenis Billboard</label>
                                                <select class="form-select" id="jenisBillboard"
                                                    name="jenisBillboard">
                                                    <option value="" disabled selected>Pilih Jenis Billboard
                                                    </option>
                                                    <option value="non-roko">Non-Roko</option>
                                                    <option value="roko">Roko</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="periodeBillboard" class="form-label">Periode</label>
                                                <select class="form-select" id="periodeBillboard"
                                                    name="periodeBillboard">
                                                    <option value="" disabled selected>Pilih Periode</option>
                                                    <option value="bulan">Bulan</option>
                                                    <option value="hari">Hari</option>
                                                    <option value="jam">Jam</option>
                                                    <option value="menit">Menit</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="hargaBillboard" class="form-label">Harga</label>
                                                <input type="number" class="form-control" id="hargaBillboard"
                                                    name="hargaBillboard">
                                            </div>
                                            <div class="mb-3">
                                                <label for="ppnBillboard" class="form-label">PPN (11%)</label>
                                                <input type="number" class="form-control" id="ppnBillboard"
                                                    name="ppnBillboard" readonly>
                                            </div>
                                        </div>


                                        <!-- Form Iklan Radio -->
                                        <div id="formRadio" style="display: none;">
                                            <div class="mb-3">
                                                <label for="jenisKegiatan" class="form-label">Jenis Kegiatan</label>
                                                <select class="form-select" id="jenisKegiatan" name="jenisKegiatan">
                                                    <option value="" disabled selected>Pilih Jenis Kegiatan
                                                    </option>
                                                    <option value="sport">Sport</option>
                                                    <option value="adlibs">Adlibs</option>
                                                    <option value="sponsor">Sponsor Program/Acara</option>
                                                    <option value="talkshow">Talkshow</option>
                                                    <option value="dialog">Dialog Interaktif</option>
                                                    <option value="siaran_langsung">Siaran Langsung</option>
                                                    <option value="sponsor_olah_raga">Sponsor Olah Raga</option>
                                                    <option value="break">Break</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="durasiRadio" class="form-label">Durasi</label>
                                                <select class="form-select" id="durasiRadio" name="durasiRadio">
                                                    <!-- Durasi dan harga otomatis terisi berdasarkan jenis kegiatan -->
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="hargaRadio" class="form-label">Harga</label>
                                                <input type="number" class="form-control" id="hargaRadio"
                                                    name="hargaRadio" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="ppnRadio" class="form-label">PPN (11%)</label>
                                                <input type="number" class="form-control" id="ppnRadio"
                                                    name="ppnRadio" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Input Lainnya -->
                                    <div class="mb-3">
                                        <label for="fileLampiran" class="form-label">Lampiran (Opsional)</label>
                                        <input type="file" class="form-control" id="fileLampiran"
                                            name="fileLampiran">
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!--end content-->

    </div>
    <!--end wrapper-->

    <!-- Bootstrap JS -->
    <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Custom JS -->
    <script>
        // Data harga iklan radio
        const hargaDataRadio = {
            sport: {
                durasi: '30 menit',
                harga: 150000
            },
            adlibs: {
                durasi: '15 menit',
                harga: 100000
            },
            sponsor: {
                durasi: '60 menit',
                harga: 300000
            },
            talkshow: {
                durasi: '60 menit',
                harga: 250000
            },
            dialog: {
                durasi: '45 menit',
                harga: 200000
            },
            siaran_langsung: {
                durasi: '90 menit',
                harga: 400000
            },
            sponsor_olah_raga: {
                durasi: '60 menit',
                harga: 350000
            },
            break: {
                durasi: '15 menit',
                harga: 75000
            }
        };

        document.addEventListener('DOMContentLoaded', function() {
            const jenisSurat = document.getElementById('jenisSurat');
            const formIklan = document.getElementById('formIklan');
            const tipeIklan = document.getElementById('tipeIklan');
            const formBillboard = document.getElementById('formBillboard');
            const formRadio = document.getElementById('formRadio');
            const jenisKegiatan = document.getElementById('jenisKegiatan');
            const durasiRadio = document.getElementById('durasiRadio');
            const hargaRadio = document.getElementById('hargaRadio');
            const ppnRadio = document.getElementById('ppnRadio');

            jenisSurat.addEventListener('change', function() {
                if (jenisSurat.value === 'iklan') {
                    formIklan.style.display = 'block';
                    formPeliputan.style.display = 'none'; // Sembunyikan form peliputan
                } else if (jenisSurat.value === 'peliputan') {
                    formPeliputan.style.display = 'block'; // Tampilkan form peliputan
                    formIklan.style.display = 'none'; // Sembunyikan form iklan
                } else {
                    formIklan.style.display = 'none';
                    formPeliputan.style.display = 'none';
                }
            });

            tipeIklan.addEventListener('change', function() {
                if (tipeIklan.value === 'billboard') {
                    formBillboard.style.display = 'block';
                    formRadio.style.display = 'none';
                } else if (tipeIklan.value === 'radio') {
                    formBillboard.style.display = 'none';
                    formRadio.style.display = 'block';
                } else {
                    formBillboard.style.display = 'none';
                    formRadio.style.display = 'none';
                }
            });

            jenisKegiatan.addEventListener('change', function() {
                const selectedKegiatan = jenisKegiatan.value;
                if (hargaDataRadio[selectedKegiatan]) {
                    const {
                        durasi,
                        harga
                    } = hargaDataRadio[selectedKegiatan];
                    durasiRadio.innerHTML = `<option value="${durasi}">${durasi}</option>`;
                    hargaRadio.value = harga;
                    ppnRadio.value = harga * 0.11;
                } else {
                    durasiRadio.innerHTML = '';
                    hargaRadio.value = '';
                    ppnRadio.value = '';
                }
            });
        });

        const hargaDataBillboard = {
            'alun-alun': {
                'non-roko': {
                    bulan: 2000000,
                    hari: 1000000,
                    jam: 200000,
                    menit: 50000
                },
                'roko': {
                    bulan: 2500000,
                    hari: 1250000,
                    jam: 250000,
                    menit: 62500
                }
            },
            'pasar-senen': {
                'non-roko': {
                    bulan: 1800000,
                    hari: 900000,
                    jam: 180000,
                    menit: 45000
                },
                'roko': {
                    bulan: 2200000,
                    hari: 1100000,
                    jam: 220000,
                    menit: 55000
                }
            }
        };

        document.addEventListener('DOMContentLoaded', function() {
            const lokasiBillboard = document.getElementById('lokasiBillboard');
            const jenisBillboard = document.getElementById('jenisBillboard');
            const periodeBillboard = document.getElementById('periodeBillboard');
            const hargaBillboard = document.getElementById('hargaBillboard');
            const ppnBillboard = document.getElementById('ppnBillboard');

            lokasiBillboard.addEventListener('change', updateHargaBillboard);
            jenisBillboard.addEventListener('change', updateHargaBillboard);
            periodeBillboard.addEventListener('change', updateHargaBillboard);

            function updateHargaBillboard() {
                const lokasi = lokasiBillboard.value;
                const jenis = jenisBillboard.value;
                const periode = periodeBillboard.value;

                if (lokasi && jenis && periode) {
                    const harga = hargaDataBillboard[lokasi][jenis][periode] || 0;
                    hargaBillboard.value = harga;
                    ppnBillboard.value = harga * 0.11;
                } else {
                    hargaBillboard.value = '';
                    ppnBillboard.value = '';
                }
            }
        });
    </script>
</body>

</html>
