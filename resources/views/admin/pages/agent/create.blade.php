@extends('admin.layouts.app')
<!-- set title -->
@section('title')

@push('after-style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Dark theme for select dropdown */
        select.form-control {
            background-color: #1b2e4b;
            color: #ffffff;
            border-color: #1b2e4b;
        }

        /* Custom styles for select2 (you may need to adjust based on your select2 version) */
        .select2-container .select2-selection--single {
            background-color: #1b2e4b;
            color: #ffffff;
            border: 1px solid #1b2e4b;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            border-color: #ffffff transparent transparent transparent;
        }
    </style>
@endpush


@section('content')

                    <div class="row">
                        <div id="browser_default" class="col-12 mt-4">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Tambah Data Mitra</h4>
                                        </div>                 
                                    </div>
                                </div>
                               
                                <div class="widget-content widget-content-area p-4">
                                    <form method="POST" action="{{ route('dashboard.userdata.storeagent') }}" enctype="multipart/form-data" class="row g-3">
                                    @csrf
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
                                    <form method="POST" action="{{ route('dashboard.userdata.store') }}" enctype="multipart/form-data" class="row g-3">
                                    @csrf
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Name</label>
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="password" class="form-label">Password</label>
                                            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email" class="form-label">Email</label>
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        </div>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror                                        
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="ktp" class="form-label">No KTP</label>
                                                <input id="ktp" type="number" class="form-control" name="ktp" value="{{ old('ktp') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="npwp" class="form-label">NPWP</label>
                                                <input id="npwp" type="text" class="form-control" name="npwp" value="{{ old('npwp') }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">No Telp</label>
                                                <input id="phone" type="number" class="form-control" name="phone" value="{{ old('phone') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="dob" class="form-label">Tanggal Lahir</label>
                                                <input id="dob" type="date" class="form-control" name="dob" value="{{ old('dob') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="agent_code" class="form-label">Kode Mitra</label>
                                                <input id="agent_code" type="text" class="form-control" name="agent_code" value="{{ old('agent_code') }}" required>
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
                                        
                                        
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="bank" class="form-label">Nama Bank</label>
                                                <input id="bank" type="text" class="form-control" name="bank" value="{{ old('bank') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="account_name" class="form-label">Nama Di Rekening</label>
                                                <input id="account_name" type="text" class="form-control" name="account_name" value="{{ old('account_name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="account_number" class="form-label">Nomor Rekening</label>
                                                <input id="account_number" type="text" class="form-control" name="account_number" value="{{ old('account_name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="npwp_img" class="form-label">File NPWP (Image)</label>
                                                <input id="npwp_img" type="file" accept="image/*" class="form-control" name="npwp_img" required >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="ktp_img" class="form-label">File KTP (Image)</label>
                                                <input id="ktp_img" type="file" accept="image/*" class="form-control" name="ktp_img" required >
                                        
                                            </div>
                                        </div>                                            
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="kk_img" class="form-label">File Kartu Keluarga (Image)</label>
                                                <input id="kk_img" type="file" accept="image/*" class="form-control" name="kk_img" required >
                                            </div>
                                        </div> 
                                                                              
                                        
                                        <div class="col-md-6">
                                            <button class="btn btn-primary" type="submit">Simpan</button>
                                            <a class="btn btn-warning" href="{{ route('dashboard.userdata.agent') }}" role="button">Back</a>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

@push('after-script')
    <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
    </script>
    <script>
    CKEDITOR.replace('description', options);
    </script>

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
@endpush

@endsection