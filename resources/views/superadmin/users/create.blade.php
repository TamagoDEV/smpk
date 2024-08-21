@extends('layout.cms')

@section('content')
    <main class="page-content">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <h6 class="mb-0 text-uppercase">Form Wizard</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <br />
                        <p>
                            <button class="btn btn-danger" id="reset-btn" type="button">Ulang</button>
                        </p>
                        <br />
                        <!-- SmartWizard html -->
                        <div id="smartwizard">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-1"> <strong>Step 1</strong><br>Isi Data Pribadi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-2"> <strong>Step 2</strong><br>Upload Foto</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-3"> <strong>Step 3</strong><br>Set Password</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-4"> <strong>Step 4</strong><br>Review Data</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <!-- Step 1: Data Pribadi -->
                                <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                    <h3>Data Pribadi</h3>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="nama_depan">Nama Depan</label>
                                            <input type="text" class="form-control" id="nama_depan" name="nama_depan"
                                                required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="nama_belakang">Nama Belakang</label>
                                            <input type="text" class="form-control" id="nama_belakang"
                                                name="nama_belakang" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                            required>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" id="username" name="username"
                                                required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="role">Role</label>
                                            <select class="form-control" id="role" name="role" required>
                                                <option value="superadmin">Super Admin</option>
                                                <option value="admin">Admin</option>
                                                <option value="kepala_bidang">Kepala Bidang</option>
                                                <option value="reporter">Reporter</option>
                                                <option value="sub_bagian_approval">Sub Bagian Approval</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="form-group col-md-6">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input type="text" class="form-control" id="tempat_lahir"
                                                name="tempat_lahir">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="tanggal_lahir"
                                                name="tanggal_lahir">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="instansi">Instansi</label>
                                            <input type="text" class="form-control" id="instansi" name="instansi">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="bidang">Bidang</label>
                                            <input type="text" class="form-control" id="bidang" name="bidang">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="no_hp">Nomor HP</label>
                                            <input type="text" class="form-control" id="no_hp" name="no_hp">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="alamat">Alamat</label>
                                            <textarea class="form-control" id="alamat" name="alamat"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 2: Upload Foto -->
                                <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                    <h3>Upload Foto</h3>
                                    <div class="form-group">
                                        <label for="foto">Foto</label>
                                        <input type="file" class="form-control-file" id="foto" name="foto"
                                            accept="image/*">
                                        <img id="foto-preview" src="" alt="Foto Preview"
                                            style="max-width:200px; margin-top:10px;">
                                        <br><br><br><br><br><br><br><br><br>
                                    </div>
                                </div>



                                <!-- Step 3: Set Password -->
                                <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                    <h3>Set Password</h3>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Konfirmasi Password</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" required>
                                    </div>
                                </div>

                                <!-- Step 4: Review Data -->
                                <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                                    <h3>Review Data</h3>
                                    <div id="review-section">
                                        <!-- Review data will be displayed here -->
                                    </div>
                                    <button class="btn btn-info btn-finish" type="button"
                                        id="finish-btn">Finish</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ url('assets/js/jquery.min.js') }}"></script>
    <script src="{{ url('assets/js/smartwizard.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#smartwizard').smartWizard({
                selected: 0,
                theme: 'dots',
                transition: {
                    animation: 'slide-horizontal',
                },
                toolbarSettings: {
                    toolbarPosition: 'both',
                }
            });

            $('#finish-btn').on('click', function() {
                var form = $('<form>', {
                    action: '{{ route('users.store') }}',
                    method: 'POST',
                    enctype: 'multipart/form-data'
                }).append('@csrf');

                // Collect data from Step 1
                $('#step-1').find('input, select, textarea').each(function() {
                    // Check if the element is a select box
                    if ($(this).is('select')) {
                        // Create a hidden input to pass the select value
                        form.append($('<input>', {
                            type: 'hidden',
                            name: $(this).attr('name'),
                            value: $(this).val()
                        }));
                    } else {
                        form.append($(this).clone());
                    }
                });

                // Collect data from Step 2
                var fotoInput = $('#step-2').find('input[type="file"]').clone();
                form.append(fotoInput);

                // Collect data from Step 3
                $('#step-3').find('input').each(function() {
                    form.append($(this).clone());
                });

                // Append the form to body and submit
                $('body').append(form);
                form.submit();
            });

            // Update review section before showing step 4
            $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
                if (stepNumber == 2 && stepDirection == 'forward') {
                    var reviewSection = $('#review-section');
                    reviewSection.empty();

                    // Collect and display data from Step 1
                    $('#step-1').find('input, select, textarea').each(function() {
                        reviewSection.append('<p><strong>' + $(this).prev('label').text() +
                            ':</strong> ' + $(this).val() + '</p>');
                    });

                    // Collect and display data from Step 2
                    var fotoInput = $('#step-2').find('input[type="file"]').get(0);
                    if (fotoInput.files.length > 0) {
                        reviewSection.append('<p><strong>Foto:</strong> ' + fotoInput.files[0].name +
                            '</p>');
                    }

                    // Collect and display data from Step 3
                    $('#step-3').find('input').each(function() {
                        if ($(this).attr('type') != 'password') {
                            reviewSection.append('<p><strong>' + $(this).prev('label').text() +
                                ':</strong> ' + $(this).val() + '</p>');
                        }
                    });
                }
            });

            // Reset button functionality
            $('#reset-btn').on('click', function() {
                $('#smartwizard').smartWizard("reset");
                $('form')[0].reset();
            });

            // Handle image preview
            $('#foto').on('change', function() {
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#foto-preview').attr('src', e.target.result).show();
                    };
                    reader.readAsDataURL(file);
                } else {
                    $('#foto-preview').hide().attr('src', '');
                }
            });
        });
    </script>
@endsection
