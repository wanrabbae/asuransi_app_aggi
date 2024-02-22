@extends('auth.layouts.app')
<!-- set title -->
@section('title')

@push('after-style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')

    <div class="middle-content container-xxl p-0">
        <div class="row layout-top-spacing">

            <div id="flLoginForm" class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="statbox widget box box-shadow">
                    @if ($errors->any())
                        <div class="alert alert-danger bg-danger p-2 text-white" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li style="">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success bg-success p-2 text-white" role="alert">{{ Session::get('success') }}</div>
                    @endif
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                @if (Auth::user()->roles == '0')
                                    <h4>Profil Agen - {{ Auth::user()->agen_code }}</h4>
                                @elseif (Auth::user()->roles != '0')
                                    <h4>Profil</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <form method="POST" action="{{ route('dashboard.updateprofile', Auth::user()->id) }}" class="row g-3">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" id="name" autocomplete="name">
                            </div>
                            <div class="col-md-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control" id="email" autocomplete="email">
                            </div>
                            <div class="col-md-3">
                                <label for="ktp" class="form-label">KTP</label>
                                <input type="text" name="ktp" value="{{ Auth::user()->ktp }}" class="form-control" id="ktp">
                            </div>
                             <div class="col-md-4">
                                <label for="dob" class="form-label">Tanggal lahir</label>
                                <input type="date" name="dob" value="{{ \Carbon\Carbon::parse(Auth::user()->dob)->format('Y-m-d') }}" class="form-control" id="dob">
                            </div>
                            <div class="col-md-4">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="form-control" id="phone" autocomplete="phone">
                            </div>
                            <div class="col-md-4">
                                <label for="password" class="form-label">Password <span style="font-size: 9px; color:red;">(isi jika ingin diganti)</span></label>
                                <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
                            </div>

                            <div class="col-xl-12 mx-auto">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Alamat</label>
                                            <textarea style="resize: none;" class="form-control" rows="7" id="address" name="address" autocomplete="none">{{ Auth::user()->address }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="provinsi" class="form-label">Provinsi & Kota</label>
                                            <select class="form-select" id="provinsi" name="province">
                                                <option value="{{ Auth::user()->province }}">{{ Auth::user()->province }}</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <select class="form-select" id="kota" name="city">
                                                <option value="{{ Auth::user()->city }}">{{ Auth::user()->city }}</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <select class="form-select" id="kecamatan" name="district">
                                                <option value="{{ Auth::user()->district }}">{{ Auth::user()->district }}</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <select class="form-select" id="kodePos" name="poscode">
                                                <option value="{{ Auth::user()->poscode }}">{{ Auth::user()->poscode }}</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>                            
                            @if (Auth::user()->roles == '2')
                            <div class="col-md-3">
                                <label for="npwp" class="form-label">NPWP</label>
                                <input type="text" name="npwp" value="{{ Auth::user()->npwp }}" class="form-control" id="npwp">
                            </div>
                            <div class="col-md-3">
                                <label for="bank" class="form-label">Bank</label>
                                <input type="text" name="bank" value="{{ Auth::user()->bank }}" class="form-control" id="bank">
                            </div>
                            <div class="col-md-3">
                                <label for="account_name" class="form-label">Nama di Rekening</label>
                                <input type="text" value="{{ Auth::user()->account_name }}" class="form-control" name="account_name" id="account_name">
                            </div>
                            <div class="col-md-3">
                                <label for="account_number" class="form-label">No. Rekening</label>
                                <input type="text" value="{{ Auth::user()->account_number }}" class="form-control" id="account_number" name="account_number">
                            </div>
                             @endif
                            <div class="col-12 mt-4">
                                <a href="" class="btn btn-outline-primary mb-2" data-bs-toggle="modal" data-bs-target="#submitdModal">
                                    Update Profil
                                </a>
                                @if (Auth::user()->roles == '1')
                                <a href="" class="btn btn-outline-warning mb-2" data-bs-toggle="modal" data-bs-target="#agentregisterModal">
                                    Daftar Affiliasi
                                </a>
                                @endif
                                @if (Auth::user()->roles == '2')
                                <a href="" class="btn btn-outline-success mb-2" data-bs-toggle="modal" data-bs-target="#mitratregisterModal">
                                    Bergabung menjadi mitra
                                </a>
                                @endif
                            </div>
                            <!-- Modal Update data  -->
                            <div class="modal fade modal-notification" id="submitdModal" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document" id="standardModalLabel">
                                    <div class="modal-content">
                                    <div class="modal-body text-center">
                                        <div class="icon-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                                        </div>
                                        <p class="modal-text">Simpan perubahan data ?</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">                                                    
                                        <button type="button" class="btn btn-denger" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                    </div>
                                </div>
                            </div>   
                        </form>

                        <!-- Modal daftar affiliasi -->
                        <div class="modal fade register-modal" id="agentregisterModal" tabindex="-1" role="dialog" aria-labelledby="agentregisterModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                
                                    <div class="modal-header mt-2" id="agentregisterModalLabel">
                                        <h4 class="modal-title">DAFTAR PROGRAM AFFILIASI AGGIKU</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                    </div>
                                    <div class="modal-body">                                            
                                        <form method="POST" action="{{ route('dashboard.upgradeAffiliator', Auth::user()->id) }}" enctype="multipart/form-data" class="mt-0">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="npwp" class="form-label">Nomor NPWP</label>
                                                <input type="text" class="form-control" id="npwp" name="npwp" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="bank" class="form-label">Nama Bank</label>
                                                <input type="text" class="form-control" id="bank" name="bank" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="account_name" class="form-label">Nama di rekening</label>
                                                <input type="text" class="form-control" id="account_name" name="account_name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="account_number" class="form-label">Nomor Rekening</label>
                                                <input type="text" class="form-control" id="account_number" name="account_number" required>
                                            </div>
                                            
                                            <div class="mb-3 form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1" onchange="toggleSimpanButton()">
                                                <label class="form-check-label" for="exampleCheck1">Checklist untuk mengaktifkan tombol simpan</label>
                                            </div>
                                            <button type="submit" id="simpanButton" onclick="simpan()" disabled class="btn btn-primary mt-2 mb-2 w-100">Simpan Data</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal daftar Mitra -->
                        <div class="modal fade register-modal" id="mitratregisterModal" tabindex="-1" role="dialog" aria-labelledby="mitratregisterModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                
                                    <div class="modal-header mt-2" id="mitratregisterModalLabel">
                                        <h4 class="modal-title">DAFTAR PROGRAM MITRA AGGIKU</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                    </div>
                                    <div class="modal-body">                                            
                                        <form method="POST" action="{{ route('dashboard.upgradeToAgent', Auth::user()->id) }}" enctype="multipart/form-data" class="mt-0">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="npwp_img" class="form-label">File NPWP (Image)</label>
                                                <input id="npwp_img" type="file" accept="image/*" class="form-control" name="npwp_img" required >
                                            </div>
                                            <div class="mb-3">
                                                <label for="ktp_img" class="form-label">File KTP (Image)</label>
                                                <input id="ktp_img" type="file" accept="image/*" class="form-control" name="ktp_img" required >
                                            </div>                                            
                                            <div class="mb-3">
                                                <label for="kk_img" class="form-label">File Kartu Keluarga (Image)</label>
                                                <input id="kk_img" type="file" accept="image/*" class="form-control" name="kk_img" required >
                                            </div>
                                            
                                            <div class="mb-3 form-check">
                                                <input type="checkbox" class="form-check-input" id="mitraCheck" onchange="toggleMitraButton()">
                                                <label class="form-check-label" for="mitraCheck">Checklist untuk mengaktifkan tombol simpan</label>
                                            </div>
                                            <button type="submit" id="simpanBtnmitra" onclick="simpan()" disabled class="btn btn-primary mt-2 mb-2 w-100">Simpan Data</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@push('after-script')    

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('/back') }}/src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    
    <script>
        function toggleSimpanButton() {
            var checkbox = document.getElementById('exampleCheck1');
            var simpanButton = document.getElementById('simpanButton');

            simpanButton.disabled = !checkbox.checked;
        }
    </script>
    <script>
        function toggleMitraButton() {
            var checkbox = document.getElementById('mitraCheck');
            var simpanButton = document.getElementById('simpanBtnmitra');

            simpanButton.disabled = !checkbox.checked;
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
        $('#kodePos').select2({
            theme: 'bootstrap'
        });
    </script>
    
    
@endpush

@endsection
