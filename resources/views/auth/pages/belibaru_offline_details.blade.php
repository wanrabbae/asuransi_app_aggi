@extends('auth.layouts.app')
<!-- set title -->
@section('title')

    @push('after-style')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush

@section('content')

    <div class="middle-content container-xxl p-0">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 ">
                <div class="usr-tasks ">

                    <div id="showValidation" class="text-white">
                        @if ($errors->any())
                            <div class="alert alert-danger bg-danger text-white" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                     <div id="wizard_Default" class="widget-content widget-content-area mb-4">
                        <div class="widget-header">
                            <div class="container mb-4">
                                <form id="insuranceForm" action="{{ route('transaction.offline') }}" method="POST">
                                    @csrf

                                    <div id="step2" class="step">
                                        <hr class="my-4">
                                        <h3 class="mb-4">{{ $offlineproduct->name }}</h3>
                                        <hr class="my-4">

                                        <div class="row gx-4">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="product_id">Jenis Asuransi</label>
                                                    <select name="product_id" id="product_id" disabled class="form-select" value="{{ old('product_id') }}">
                                                        @foreach ($products as $item)
                                                            <option value="{{ $item->id }}" {{ $item->id == $offlineproduct->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="nilai_pertanggungan">Perkiraan Nilai Pertanggungan</label>
                                                    <input type="text" name="nilai_pertanggungan" id="nilai_pertanggungan" class="form-control" value="{{ old('nilai_pertanggungan') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="mb-3">
                                                    <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                                                    <input type="text" class="form-control" id="namaLengkap" name="nasabah_name" value="{{ old('nasabah_name') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="nomorKTP" class="form-label">Nomor KTP (Minimal 12 digits)</label>
                                                    <input type="number" class="form-control" id="nomorKTP" name="nasabah_id" value="{{ old('nasabah_id') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="text" class="form-control" id="email" name="nasabah_email" placeholder="" value="{{ old('nasabah_email') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">No Telp</label>
                                                    <input type="number" class="form-control" id="phone" name="nasabah_phone" placeholder="" value="{{ old('nasabah_phone') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                                                    <input type="date" class="form-control" id="tanggalLahir" name="nasabah_dob" value="{{ old('nasabah_dob') }}" required>
                                                </div>
                                            </div>

                                            <div class="col-xl-12 mx-auto">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <div class="mb-3">
                                                            <label for="alamatNasabah" class="form-label">Alamat</label>
                                                            <textarea class="form-control" rows="7 id="alamatNasabah" name="nasabah_address" value="{{ old('nasabah_address') }}" required>{{ old('nasabah_address') }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="provinsiNasabah" class="form-label">Provinsi & Kota</label>
                                                            <select class="form-select" id="provinsiNasabah" name="nasabah_province" value="{{ old('nasabah_province') }}" required>
                                                                <!-- Add options for provinces -->
                                                                <option value="">Pilih Provinsi</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <select class="form-select" id="kotaNasabah" name="nasabah_city" value="{{ old('nasabah_city') }}" required>
                                                                <!-- Add options for cities -->
                                                                <option value="">Pilih Kota</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <select class="form-select" id="kecamatanNasabah" name="nasabah_district" value="{{ old('nasabah_district') }}" required>
                                                                <!-- Add options for cities -->
                                                                <option value="">Pilih Kecamatan</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <select class="form-select" id="kodePosNasabah" name="nasabah_poscode" value="{{ old('nasabah_poscode') }}" required>
                                                                <!-- Add options for cities -->
                                                                <option value="">Pilih Kode Pos</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-4">
                                        <input type="hidden" name="referal_code" value="{{ auth()->user()->referal_code }}">
                                        <input type="hidden" name="referal_code_upline" value="{{ auth()->user()->referal_code }}">
                                        <div class="d-flex justify-content-end ">
                                            <button class="btn btn-primary btn-lg" type="submit">Submit</button>
                                        </div>

                                    </div>

                                </form>
                                {{-- @endif --}}
                            </div>
                        </div>
                     </div>
                    
                </div>
            </div>
        </div>
    </div>

    @push('before-script')
        <script src="/js/formatRupiah.js"></script>
        <script src="/js/formatTanggal.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.forms['insuranceForm'].addEventListener('submit', function() {
                    document.getElementById('product_id').removeAttribute('disabled');
                });
            });
            var nilai_pertanggungan = document.getElementById('nilai_pertanggungan');
            nilai_pertanggungan.addEventListener('keyup', function(e) {
                nilai_pertanggungan.value = formatRupiah(this.value);
            });

            fetch('/api/address/provinces')
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    var provinsiNasabah = document.getElementById('provinsiNasabah');
                    var provinsiLength = data.length;
                    for (let i = 0; i < provinsiLength; i++) {
                        var option = document.createElement('option');
                        option.value = data[i].id_province + '-' + data[i].name_province;
                        option.textContent = data[i].name_province;
                        provinsiNasabah.appendChild(option.cloneNode(true));
                    }
                })
                .catch((err) => {
                    console.log(err);
                });

            $('#provinsiNasabah').on('change', function() {
                console.log('provinsi changed');
                var provinsiId = this.value;
                $('#kotaNasabah').empty();
                fetch('/api/address/regencies/' + provinsiId)
                    .then((response) => {
                        return response.json();
                    })
                    .then((data) => {
                        var kota = document.getElementById('kotaNasabah');
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

            $('#kotaNasabah').on('change', function() {
                $('#kecamatanNasabah').empty();
                console.log("test kota");
                var kotaId = this.value;
                console.log(kotaId);
                fetch('/api/address/districts/' + kotaId)
                    .then((response) => {
                        return response.json();
                    })
                    .then((data) => {
                        var kecamatan = document.getElementById('kecamatanNasabah');
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

            $('#kotaNasabah').on('change', function() {
                $('#kodePosNasabah').empty();
                var kotaId = this.value;
                console.log(kotaId.split('-')[1]);
                fetch('/api/address/postcode/' + kotaId.split('-')[1])
                    .then((response) => {
                        return response.json();
                    })
                    .then((data) => {
                        var kodePos = document.getElementById('kodePosNasabah');
                        var kodePosLength = data.length;
                        for (let i = 0; i < kodePosLength; i++) {
                            var option = document.createElement('option');
                            option.value = data[i].poscode;
                            option.textContent = data[i].poscode + ' - ' + data[i].name_regenciest + ', ' + data[i].name_districts;
                            kodePos.appendChild(option);
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            })

            $('#provinsiNasabah').select2({
                theme: 'bootstrap'
            });
            $('#kotaNasabah').select2({
                theme: 'bootstrap'
            });
            $('#kecamatanNasabah').select2({
                theme: 'bootstrap'
            });
            $('#kodePosNasabah').select2({
                theme: 'bootstrap'
            });
        </script>

        {{-- @if ($offlineproduct->slug == 'asuransi-kebakaran')
        <script>
            $('#provinsi').select2({
                theme: 'bootstrap'
            });
            $('#kota').select2({
                theme: 'bootstrap'
            });
            $('#kecamatan').select2({
                theme: 'bootstrap'
            });
            $('#kodePos').select2({
                theme: 'bootstrap'
            });

            fetch('/api/address/provinces')
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    var provinsiNasabah = document.getElementById('provinsiNasabah');
                    var provinsiTertanggung = document.getElementById('provinsiTertanggung');
                    var provinsiLength = data.length;
                    for (let i = 0; i < provinsiLength; i++) {
                        var option = document.createElement('option');
                        option.value = data[i].id_province + '-' + data[i].name_province;
                        option.textContent = data[i].name_province;
                        provinsi.appendChild(option);
                        provinsiNasabah.appendChild(option.cloneNode(true));
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
                console.log("test kota");
                var kotaId = this.value;
                console.log(kotaId);
                fetch('/api/address/districts/' + kotaId)
                    .then((response) => {
                        return response.json();
                    })
                    .then((data) => {
                        var kecamatan = document.getElementById('kecamatan');
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
            $('#kota').on('change', function() {
                $('#kodePos').empty();
                var kotaId = this.value;
                console.log(kotaId.split('-')[1]);
                fetch('/api/address/postcode/' + kotaId.split('-')[1])
                    .then((response) => {
                        return response.json();
                    })
                    .then((data) => {
                        var kodePos = document.getElementById('kodePos');
                        var kodePosLength = data.length;
                        for (let i = 0; i < kodePosLength; i++) {
                            var option = document.createElement('option');
                            option.value = data[i].poscode;
                            option.textContent = data[i].poscode + ' - ' + data[i].name_regenciest + ', ' + data[i].name_districts;
                            kodePos.appendChild(option);
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            })
            $('#provinsiNasabah').on('change', function() {
                console.log('provinsi changed');
                var provinsiId = this.value;
                $('#kotaNasabah').empty();
                fetch('/api/address/regencies/' + provinsiId)
                    .then((response) => {
                        return response.json();
                    })
                    .then((data) => {
                        var kota = document.getElementById('kotaNasabah');
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

            $('#kotaNasabah').on('change', function() {
                $('#kecamatanNasabah').empty();
                console.log("test kota");
                var kotaId = this.value;
                console.log(kotaId);
                fetch('/api/address/districts/' + kotaId)
                    .then((response) => {
                        return response.json();
                    })
                    .then((data) => {
                        var kecamatan = document.getElementById('kecamatanNasabah');
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

            $('#kotaNasabah').on('change', function() {
                $('#kodePosNasabah').empty();
                var kotaId = this.value;
                console.log(kotaId.split('-')[1]);
                fetch('/api/address/postcode/' + kotaId.split('-')[1])
                    .then((response) => {
                        return response.json();
                    })
                    .then((data) => {
                        var kodePos = document.getElementById('kodePosNasabah');
                        var kodePosLength = data.length;
                        for (let i = 0; i < kodePosLength; i++) {
                            var option = document.createElement('option');
                            option.value = data[i].poscode;
                            option.textContent = data[i].poscode + ' - ' + data[i].name_regenciest + ', ' + data[i].name_districts;
                            kodePos.appendChild(option);
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            })
        </script>
    @endif --}}
    @endpush


@endsection
