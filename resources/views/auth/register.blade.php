<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>SignUp | AGGIKU </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/img/landing') }}/logo-fav.png" />
    <link href="{{ asset('/back') }}/layouts/vertical-light-menu/css/light/loader.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/back') }}/layouts/vertical-light-menu/css/dark/loader.css" rel="stylesheet" type="text/css" />
    <script src="{{ asset('/back') }}/layouts/vertical-light-menu/loader.js"></script>
    
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('/back') }}/src/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    
    <link href="{{ asset('/back') }}/layouts/vertical-light-menu/css/light/plugins.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/back') }}/src/assets/css/light/authentication/auth-boxed.css" rel="stylesheet" type="text/css" />
    
    <link href="{{ asset('/back') }}/layouts/vertical-light-menu/css/dark/plugins.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/back') }}/src/assets/css/dark/authentication/auth-boxed.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- END GLOBAL MANDATORY STYLES -->
    
</head>
<body class="form">

    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">
    
            <div class="row">
    
                <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                    <div class="card mt-3 mb-3">
                        <div class="card-body">
    
                            <form method="POST" action="/register">
                                @csrf

                                <div class="row">
                                    <div class="col-12 mb-4 mt-4">
                                        <div class="">
                                            <div class="seperator">
                                                <hr>
                                                <div class="seperator-text"> <span><h4>DAFTAR PROGRAM AFILIASI AGGIKU</h4> </span></div>
                                            </div>
                                        </div>
                                    </div>
                                    @error('email')
                                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror

                                    @error('password')
                                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama</label>
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required
                                                autocomplete="name" autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="ktp" class="form-label">NO KTP</label>
                                            <input id="ktp" type="number" class="form-control" name="ktp" value="{{ old('ktp') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="npwp" class="form-label">NPWP</label>
                                            <input id="npwp" type="text" class="form-control" name="npwp" value="{{ old('npwp') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="bank" class="form-label">Nama Bank</label>
                                            <input id="bank" type="text" class="form-control" name="bank" value="{{ old('bank') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="account_name" class="form-label">Nama Di Rekening</label>
                                            <input id="account_name" type="text" class="form-control" name="account_name" value="{{ old('account_name') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="account_number" class="form-label">Nomor Rekening</label>
                                            <input id="account_number" type="text" class="form-control" name="account_number" value="{{ old('account_name') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">No HP</label>
                                            <input id="phone" type="number" class="form-control" name="phone" value="{{ old('phone') }}" required >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="dob" class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob') }}">
                                        </div>
                                    </div>

                                    <div class="col-xl-12 mx-auto">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Alamat</label>
                                                    <textarea style="resize: none;" class="form-control" rows="7" id="address" name="address">{{ old('address') }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="provinsi" class="form-label">Provinsi & Kota</label>
                                                    <select class="form-select" id="provinsi" name="province">
                                                        <option value="{{ old('province') }}">Pilih Provinsi</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <select class="form-select" id="kota" name="city">
                                                        <option value="{{ old('city') }}">Pilih Kota</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <select class="form-select" id="kecamatan" name="district">
                                                        <option value="{{ old('district') }}">Pilih Kecamatan</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <select class="form-select" id="kodePos" name="poscode">
                                                        <option value="{{ old('poscode') }}">Pilih Kode Pos</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input value="{{ old('password') }}" id="password" type="password" class="form-control" name="password" required autocomplete="new-password" placeholder="minimal 6 digit">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="password-confirm" class="form-label">Confirm Password</label>
                                            <input value="{{ old('password-confirm') }}" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3 form-check form-check-primary form-check-inline">
                                            <input class="form-check-input me-3" type="checkbox" id="terms_and_conditions" value="1" onclick="terms_changed(this)" />
                                            <span class="form-check-label" for="terms_and_conditions">
                                                Saya setuju dengan <a href="{{ route('kebijakan-privasi') }}" target="_blank" class="text-primary">Kebijakan privasi</a>
                                            </span>
                                        </div>
                                    </div>
                                    <input type="hidden" value="{{ $referalCode ?? '' }}" name="referalCode">

                                    <div class="col-12">
                                        <div class="mb-4">
                                            <button disabled type="submit" class="btn btn-secondary w-100" id="submit_button">DAFTAR</button>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-4">
                                        <div class="text-center">
                                            <p class="mb-0">Kembali ke <a href="{{ route('landinghome') }}" class="text-warning">Beranda</a></p>
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
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('/back') }}/src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <script>
        function terms_changed(termsCheckBox) {
            if (termsCheckBox.checked) {
                document.getElementById("submit_button").disabled = false;
            } else {
                document.getElementById("submit_button").disabled = true;
            }
        }
    </script>

    <script>
      
        fetch('/api/address/provinces')
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                var prosabah = document.getElementById('provinsi');
                var provinsiLength = data.length;
                for (let i = 0; i < provinsiLength; i++) {
                    var option = document.createElement('option');
                    option.value = data[i].id_province + '-' + data[i].name_province;
                    option.textContent = data[i].name_province;
                    provinsi.appendChild(option);
                }
            })
            .catch((err) => {
                console.log(err);
            });
        $('#provinsi').on('change', function() {
            console.log('provinsi changed');
            var provinsiId = this.value;
            $('#kota').empty();
            fetch('/api/address/regencies/' + provinsiId)
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    var kota = document.getElementById('kota');
                    kota.innerHTML = `
                        <option value="" selected disabled>Pilih Kabupaten - Kota</option>
                    `
                    var kotaLength = data.length;
                    for (let i = 0; i < kotaLength; i++) {
                        var option = document.createElement('option');
                        option.value = data[i].id_regencies + '-' + data[i].name_regencies;
                        option.textContent = data[i].name_regencies;
                        kota.appendChild(option);
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        })
        $('#kota').on('change', function() {
            $('#kecamatan').empty();
            var kotaId = this.value;
            console.log(kotaId);
            fetch('/api/address/districts/' + kotaId)
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    var kecamatan = document.getElementById('kecamatan');
                    kecamatan.innerHTML = `
                        <option value="" selected disabled>Pilih Kecamatan</option>
                    `
                    var kecamatanLength = data.length;
                    for (let i = 0; i < kecamatanLength; i++) {
                        var option = document.createElement('option');
                        option.value = data[i].id_districts + '-' + data[i].name_districts;
                        option.textContent = data[i].name_districts;
                        kecamatan.appendChild(option);
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        })
        $('#kecamatan').on('change', function() {
            $('#kodePos').empty();
            var kecamatanId = this.value;
            console.log(kecamatanId.split('-')[1]);
            fetch('/api/address/postcode/' + kecamatanId.split('-')[1])
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    var kodePos = document.getElementById('kodePos');
                    kodePos.innerHTML = `
                        <option value="" selected disabled>Pilih kelurahan - Kode Pos</option>
                    `
                    var kodePosLength = data.length;
                    for (let i = 0; i < kodePosLength; i++) {
                        var option = document.createElement('option');
                        option.value = data[i].name_villages + '-' + data[i].poscode;
                        option.textContent = data[i].name_villages + ' - ' + data[i].poscode;
                        kodePos.appendChild(option);
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        })

        $('#provinsi').select2({
            theme: 'bootstrap'
        });
        $('#kota').select2({
            theme: 'bootstrap'
        });
        $('#kecamatan').select2({
            theme: 'bootstrap'
        });
        $('#kodePos	').select2({
            theme: 'bootstrap'
        });
    </script>

</body>
</html>