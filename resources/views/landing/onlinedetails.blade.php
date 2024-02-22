@extends('landing.layouts.app')

<!-- set title -->
@section('title', 'Online Product')

@push('after-style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #showloading {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        z-index: 9999;
        text-align: center;
        }

        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            border-top: 4px solid #3498db;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin-bottom: 15px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
@endpush

@section('content')

    <section class="wrapper bg-warning px-0 pb-6 mt-0 min-vh-8">
        <div class="container pb-10 pt-md-2 pb-md-10">
        </div>
    </section>

    <section class="wrapper bg-light">
        
        <div id="showloading">
            <div class="spinner"></div>
            <p class="text-center">Sedang memproses Asuransi...</p>
        </div>
        <div class="container py-8 py-md-8">

            <div id="showValidation" class="text-white">
            </div>

            @if ($onlineproduct->id == '1')
                <div id="wizard_Default" class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="container">
                                <form id="insuranceForm" action="/transaction-bangunan" method="POST">
                                    @csrf

                                    <!-- Step 1 -->
                                    <div id="step1" class="step">
                                        <hr class="my-4">
                                        <h3 class="mb-4"><span class="icon btn btn-circle btn-md btn-primary pe-none mb-1"><span class="number">01</span></span> Informasi Bangunan</h3>
                                        <hr class="my-4">

                                        <div class="row gx-4">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="statusKepemilikan" class="form-label">Status Kepemilikan</label>
                                                    <select class="form-select" id="statusKepemilikan" name="status_bangunan">
                                                        <option value="Di Tempati">Di Tempati</option>
                                                        <option value="Di Sewakan">Di Sewakan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="nilaiBangunan" class="form-label">Nilai Bangunan <span style="font-size: 12px;">(Rp. {{ format_uang($onlineproduct->min_price) }} - Rp.
                                                            {{ format_uang($onlineproduct->max_price) }})</span></label>
                                                    <input type="text" class="form-control" id="nilaiBangunan" value="{{ old('nilai_bangunan') }}" name="nilai_bangunan">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="nilaiTertanggung" class="form-label">Nilai Tertanggung Lainnya</label>
                                                    <input type="text" value="0" class="form-control" id="nilaiTertanggung" name="nilai_lainnya">
                                                </div>
                                            </div>

                                            <div class="col-xl-12 mx-auto">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <div class="mb-3">
                                                            <label for="alamatRumah" class="form-label">Alamat Rumah</label>
                                                            <textarea style="resize: none;" class="form-control" rows="6" id="alamatRumah" name="address_bangunan"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="provinsi" class="form-label">Kota & Provinsi</label>
                                                            <select class="form-select" id="provinsi" name="province_bangunan">
                                                                <option value="" selected>Pilih Provinsi</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <select class="form-select" id="kota" name="kota_bangunan">
                                                                <option value="" selected>Pilih Kabupatan - Kota</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <select class="form-select" id="kecamatan" name="district_bangunan">
                                                                <option value="">Pilih Kecamatan</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <select class="form-select" id="kodePos" name="poscode_bangunan">
                                                                <option value="">Pilih Kelurahan - Kode Pos</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary next-btn btn-sm">Selanjutnya</button>
                                    </div>

                                    <!-- Step 2 -->
                                    <div id="step2" class="step">
                                        @if (auth()->check())
                                        <hr class="my-4">
                                        <h3 class="mb-4"><span class="icon btn btn-circle btn-md btn-primary pe-none mb-1"><span class="number">02</span></span> Data Anda (silakan klik selanjutnya)</h3>
                                        <hr class="my-4">

                                        <div class="row gx-4">
                                            <div class="col-md-8">
                                                <div class="mb-3">
                                                    <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                                                    <input readonly type="text" class="form-control" id="namaLengkap" name="nasabah_name" value="{{ Auth::user()->name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="nomorKTP" class="form-label">Nomor KTP <span style="font-size: 12px;">(Minimal 12 digits)</span></label>
                                                    <input readonly type="number" class="form-control" id="nomorKTP" name="nasabah_id" value="{{ Auth::user()->ktp }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input readonly type="text" class="form-control" id="email" name="nasabah_email" placeholder="" autocomplete="none" value="{{ Auth::user()->email }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">No Telp <span style="font-size: 12px;">dimulai dari angka 0 (08xxx)</span></label>
                                                    <input readonly type="number" class="form-control" id="phone" name="nasabah_phone" placeholder="" autocomplete="none" value="{{ Auth::user()->phone }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                                                    <input readonly type="date" class="form-control" id="tanggalLahir" name="nasabah_dob" value="{{ Auth::user()->dob }}">
                                                </div>
                                            </div>

                                            <div class="col-xl-12 mx-auto">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <div class="mb-3">
                                                            <label for="alamatNasabah" class="form-label">Alamat</label>
                                                            <textarea readonly style="resize: none;" class="form-control" rows="6" id="alamatNasabah" name="nasabah_address">{{ Auth::user()->address }}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="provinsiNasabah" class="form-label">Provinsi & Kota</label>
                                                            <select disabled class="form-select" id="provinsiNasabah" name="nasabah_province">
                                                                <!-- Add options for provinces -->
                                                                <option value="{{ Auth::user()->province }}" selected>{{ Auth::user()->province }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <select disabled class="form-select" id="kotaNasabah" name="nasabah_city">
                                                                <!-- Add options for cities -->
                                                                <option value="{{ Auth::user()->city }}" seleted>{{ Auth::user()->city }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <select disabled class="form-select" id="kecamatanNasabah" name="nasabah_district">
                                                                <!-- Add options for cities -->
                                                                <option value="{{ Auth::user()->district }}" seleted>{{ Auth::user()->district }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <select disabled class="form-select" id="kodePosNasabah" name="nasabah_poscode">
                                                                <!-- Add options for cities -->
                                                                <option value="{{ Auth::user()->poscode }}" seleted>{{ Auth::user()->poscode }}</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <hr class="my-4">
                                        <h3 class="mb-4"><span class="icon btn btn-circle btn-md btn-primary pe-none mb-1"><span class="number">02</span></span> Informasi Nasabah</h3>
                                        <hr class="my-4">
                                        
                                        <div class="row gx-4">
                                            <div class="col-md-8">
                                                <div class="mb-3">
                                                    <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                                                    <input type="text" class="form-control" id="namaLengkap" name="nasabah_name">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="nomorKTP" class="form-label">Nomor KTP <span style="font-size: 12px;">(Minimal 12 digits)</span></label>
                                                    <input type="number" class="form-control" id="nomorKTP" name="nasabah_id">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="text" class="form-control" id="email" name="nasabah_email" placeholder="" autocomplete="none">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">No Telp <span style="font-size: 12px;">dimulai dari angka 0 (08xxx)</span></label>
                                                    <input type="number" class="form-control" id="phone" name="nasabah_phone" placeholder="" autocomplete="none">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                                                    <input type="date" class="form-control" id="tanggalLahir" name="nasabah_dob">
                                                </div>
                                            </div>

                                            <div class="col-xl-12 mx-auto">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <div class="mb-3">
                                                            <label for="alamatNasabah" class="form-label">Alamat</label>
                                                            <textarea style="resize: none;" class="form-control" rows="6" id="alamatNasabah" name="nasabah_address"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="provinsiNasabah" class="form-label">Provinsi & Kota</label>
                                                            <select class="form-select" id="provinsiNasabah" name="nasabah_province">
                                                                <!-- Add options for provinces -->
                                                                <option value="">Pilih Provinsi</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <select class="form-select" id="kotaNasabah" name="nasabah_city">
                                                                <!-- Add options for cities -->
                                                                <option value="">Pilih Kabupaten - Kota</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <select class="form-select" id="kecamatanNasabah" name="nasabah_district">
                                                                <!-- Add options for cities -->
                                                                <option value="">Pilih Kecamatan</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <select class="form-select" id="kodePosNasabah" name="nasabah_poscode">
                                                                <!-- Add options for cities -->
                                                                <option value="">Pilih kelurahan - Kode Pos</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <button type="button" class="btn btn-danger prev-btn btn-sm">Kembali</button>
                                        <button type="button" class="btn btn-primary next-btn btn-sm">Selanjutnya</button>
                                    </div>

                                    <!-- Summary -->
                                    <div id="step3" class="step">
                                        <hr class="my-4">
                                        <h3 class="mb-4"><span class="icon btn btn-circle btn-md btn-primary pe-none mb-1"><span class="number">03</span></span> Ringkasan</h3>
                                        <hr class="my-4">

                                        <div class="row gx-md-12 gx-xl-12 gy-12" id="summaryContainer">
                                            <div class="col-lg-8">
                                                <div class="card shadow-none bg-pale-blue">
                                                    <div class="card-body">
                                                        <h5>Data Bangunan</h5>
                                                        <div class="row gx-4 mb-4">
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Status Kepemilikan</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span class="text-start" id="summaryStatusKepemilikan"></span>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Nilai Bangunan</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span class="text-start" id="summaryNilaiBangunan"></span>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Nilai Tertanggung Lainnya</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span class="text-start" id="summaryNilaiTertanggung"></span>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Alamat</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span id="summaryAlamatBangunan"></span>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Kabupaten / Kota</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span id="summaryKotaBangunan"></span></span>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Kecamatan</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span id="summaryKecamatanBangunan"></span></span>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Kelurahan</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span id="summaryKelurahan"></span>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Provinsi</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span id="summaryProvinsiBangunan"></span>, <span id="summaryKodeposBangunan"></span>
                                                            </div>
                                                        </div>
                                                        <h5>Data Nasabah / Penanggung</h5>
                                                        <div class="row gx-4">
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Nama Lengkap</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span id="summaryNamaLengkap"></span>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Email</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span id="summaryEmail"></span>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Nomor KTP</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span id="summaryNomorKTP"></span>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Tanggal Lahir</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span id="summaryTanggalLahir"></span>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Alamat</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span id="summaryAlamatNasabah"></span>
                                                            </div>
                                                            @if (auth()->check())
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Kabubapten / Kota</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span>{{ Auth::user()->city }}</span>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Kecamatan</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span>{{ Auth::user()->district }}</span>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Kelurahan</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span>
                                                                @php
                                                                    $poscode = Auth::user()->poscode;
                                                                    $parts = explode('-', $poscode);
                                                                    $extractedPoscode = isset($parts[0]) ? $parts[0] : '';
                                                                @endphp    
                                                                {{ $extractedPoscode }}</span>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Provinsi</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span>{{ Auth::user()->province }}</span>, <span>
                                                                @php
                                                                    $poscode = Auth::user()->poscode;
                                                                    $parts = explode('-', $poscode);
                                                                    $extractedPoscode = isset($parts[1]) ? $parts[1] : '';
                                                                @endphp    
                                                                {{ $extractedPoscode }}</span>
                                                            </div>
                                                            @else
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Kabubapten / Kota</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span id="summaryKotaNasabah"></span></span>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Kecamatan</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span id="summaryKecamatanNasabah"></span>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Kelurahan</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span id="summaryKelurahanNasabah"></span>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Provinsi</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span id="summaryProvinsiNasabah"></span>, <span id="summaryKodePosNasabah"></span>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" name="biaya_materai" value="{{ $landing->materai_fee }}">
                                            <input type="hidden" name="biaya_admin" value="{{ $landing->admin_fee }}">
                                            <input type="hidden" name="nilai_premi" value="{{ $onlineproduct->min_price }}">
                                            <input type="hidden" name="rate" value="{{ $onlineproduct->rate }}">
                                            <input type="hidden" name="product_id" value="{{ $onlineproduct->id }}">

                                            <div class="col-lg-4">
                                                <div class="table-responsive">
                                                    <table class="table table-order">
                                                        <tbody>
                                                            <tr>
                                                                <td class="ps-0"><strong class="text-dark">Nilai Premi</strong></td>
                                                                <td class="pe-0 text-end">
                                                                    <p class="price" id="premi_kebakaran">{{ format_uang($onlineproduct->min_price) }}</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-0"><strong class="text-dark">Biaya Materai</strong></td>
                                                                <td class="pe-0 text-end">
                                                                    <p class="price">{{ format_uang($landing->materai_fee) }}</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-0"><strong class="text-dark">Biaya Admin</strong></td>
                                                                <td class="pe-0 text-end">
                                                                    <p class="price">{{ format_uang($landing->admin_fee) }}</p>
                                                                </td>
                                                            </tr>
                                                            @if (auth()->check())
                                                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                            @endif
                                                            <input type="hidden" name="referal_code" value="{{ $referal_code ?? '' }}">
                                                            <input type="hidden" name="referal_code_upline" value="{{ $referal_code ?? '' }}">
                                                            <tr>
                                                                <td class="ps-0"><strong class="text-dark">Total Bayar</strong></td>
                                                                <td class="pe-0 text-end">
                                                                    <p class="price text-dark fw-bold" id="summaryTotalBayar"></p>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="same-address">
                                                    <label class="form-check-label" for="same-address">Saya setuju dengan semua <a href="{{ env('APP_URL') }}kebijakan-privasi" target="_blank"
                                                            rel="noopener noreferrer">kebijakan privasi</a> & <a href="{{ env('APP_URL') }}aturan-pengguna" target="_blank"
                                                            rel="noopener noreferrer">aturan pengunan</a> yang berlaku
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="save-info">
                                                    <label class="form-check-label" for="save-info">Saya menyatakan data sudah benar</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="save-share">
                                                    <label class="form-check-label" for="save-share">Saya bersedia data dialihkan ke pihak lain</label>
                                                </div>
                                                <button type="submit" class="btn btn-primary next-btn btn-sm rounded w-100 mt-4 paymentProcess" disabled>Proses Pembayaran</button>
                                                <button type="button" class="btn btn-danger prev-btn btn-sm rounded w-100 mt-2">Kembali</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif ($onlineproduct->id == '2')
                <div id="wizard_Default" class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="container">
                                <form id="insuranceForm" action="/transaction-kecelakaan" method="POST">
                                    @csrf
                                    <!-- Step 1 -->
                                    <div id="step1" class="step">
                                        @if (auth()->check())
                                        <hr class="my-4">
                                        <h3 class="mb-4"><span class="icon btn btn-circle btn-md btn-primary pe-none mb-1"><span class="number">01</span></span> Data Anda (silakan klik selanjutnya)</h3>
                                        <hr class="my-4">

                                        <div class="row gx-4">
                                            <div class="col-md-8">
                                                <div class="mb-3">
                                                    <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                                                    <input readonly type="text" class="form-control" id="namaLengkap" name="nasabah_name" value="{{ Auth::user()->name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="nomorKTP" class="form-label">Nomor KTP <span style="font-size: 12px;">(Minimal 12 digits)</span></label>
                                                    <input readonly type="number" class="form-control" id="nomorKTP" name="nasabah_id" value="{{ Auth::user()->ktp }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input readonly type="text" class="form-control" id="email" name="nasabah_email" placeholder="" autocomplete="none" value="{{ Auth::user()->email }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">No Telp <span style="font-size: 12px;">dimulai dari angka 0 (08xxx)</span></label>
                                                    <input readonly type="number" class="form-control" id="phone" name="nasabah_phone" placeholder="" autocomplete="none" value="{{ Auth::user()->phone }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                                                    <input readonly type="date" class="form-control" id="tanggalLahir" name="nasabah_dob" value="{{ Auth::user()->dob }}">
                                                </div>
                                            </div>

                                            <div class="col-xl-12 mx-auto">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <div class="mb-3">
                                                            <label for="alamatNasabah" class="form-label">Alamat</label>
                                                            <textarea readonly style="resize: none;" class="form-control" rows="6" id="alamatNasabah" name="nasabah_address">{{ Auth::user()->address }}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="provinsiNasabah" class="form-label">Provinsi & Kota</label>
                                                            <select disabled class="form-select" id="provinsiNasabah" name="nasabah_province">
                                                                <!-- Add options for provinces -->
                                                                <option value="{{ Auth::user()->province }}" selected>{{ Auth::user()->province }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <select disabled class="form-select" id="kotaNasabah" name="nasabah_city">
                                                                <!-- Add options for cities -->
                                                                <option value="{{ Auth::user()->city }}" seleted>{{ Auth::user()->city }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <select disabled class="form-select" id="kecamatanNasabah" name="nasabah_district">
                                                                <!-- Add options for cities -->
                                                                <option value="{{ Auth::user()->district }}" seleted>{{ Auth::user()->district }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <select disabled class="form-select" id="kodePosNasabah" name="nasabah_poscode">
                                                                <!-- Add options for cities -->
                                                                <option value="{{ Auth::user()->poscode }}" seleted>{{ Auth::user()->poscode }}</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <hr class="my-4">
                                        <h3 class="mb-4"><span class="icon btn btn-circle btn-md btn-primary pe-none mb-1"><span class="number">01</span></span> Informasi Nasabah</h3>
                                        <hr class="my-4">

                                        <div class="row gx-4">
                                            <div class="col-md-8">
                                                <div class="mb-3">
                                                    <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                                                    <input type="text" class="form-control" id="namaLengkap" name="nasabah_name">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="nomorKTP" class="form-label">Nomor KTP (Minimal 12 digits)</label>
                                                    <input type="number" class="form-control" id="nomorKTP" name="nasabah_id">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="nasabah_email" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">No. Telp</label>
                                                    <input placeholder="dimulai dari angka 0 (08xxx)" type="number" class="form-control" id="phone" name="nasabah_phone" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                                                    <input type="date" class="form-control" id="tanggalLahir" name="nasabah_dob">
                                                </div>
                                            </div>
                                            <div class="col-xl-12 mx-auto">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <div class="mb-3">
                                                            <label for="alamatNasabah" class="form-label">Alamat</label>
                                                            <textarea style="resize: none;" class="form-control" rows="6" id="alamatNasabah" name="nasabah_address"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="provinsiNasabah" class="form-label">Kota & Provinsi</label>
                                                            <select class="form-select" id="provinsiNasabah" name="nasabah_province">
                                                                <option value="" selected>Pilih Provinsi</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <select class="form-select" id="kotaNasabah" name="nasabah_city">
                                                                <option value="">Pilih Kabupatan - Kota</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <select class="form-select" id="kecamatanNasabah" name="nasabah_district">
                                                                <option value="">Pilih Kecamatan</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <select class="form-select" id="kodePosNasabah" name="nasabah_poscode">
                                                                <option value="">Pilih Kelurahan - Kode Pos</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--/column -->
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <button type="button" class="btn btn-primary next-btn btn-sm">Selanjutnya</button>
                                    </div>

                                    <!-- Step 2 -->
                                    <div id="step2" class="step">
                                        <hr class="my-4">
                                        <h3 class="mb-4"><span class="icon btn btn-circle btn-md btn-primary pe-none mb-1"><span class="number">02</span></span> Ahli Waris <span style="font-size: 12px;">(Minimal berumur 17 Tahun)</span></h3>
                                        <hr class="my-4">

                                        {{-- form multi input can add and remove --}}
                                        <div id="ahliWarisContainer">
                                            <div class="ahli-waris-container">
                                                <div class="row gx-4" id="ahliWaris1">
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="namaAhliWaris1" class="form-label">Nama Ahli Waris</label>
                                                            <input type="text" class="form-control" id="namaAhliWaris1" name="namaAhliWaris[]">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="nomorIdentitasAhliWaris1" class="form-label">Nomor Identitas Ahli Waris (Minimal 12 Digit)</label>
                                                            <input type="number" class="form-control" id="nomorIdentitasAhliWaris1" name="nomorIdentitasAhliWaris[]">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="hubunganStatusAhliWaris1" class="form-label">Hubungan Status Ahli Waris</label>
                                                            <select class="form-select" id="hubunganStatusAhliWaris1" name="hubunganStatusAhliWaris[]">
                                                                <option value="Suami/Istri">Suami/Istri</option>
                                                                <option value="Anak">Anak</option>
                                                                <option value="Orangtua">Orangtua</option>
                                                                <option value="Saudara Kandung">Saudara Kandung</option>
                                                                <option value="Saudara dari ayah/ibu">Saudara dari ayah/ibu</option>
                                                                <option value="Saudara sepupu">Saudara sepupu</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="emailAhliWaris1" class="form-label">Email</label>
                                                            <input type="email" class="form-control" id="emailAhliWaris1" name="emailAhliWaris[]">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="ttlAhliWaris1" class="form-label">Tempat Lahir</label>
                                                            <input type="text" class="form-control" id="ttlAhliWaris1" name="ttlAhliWaris[]">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="tglAhliWaris1" class="form-label">Tanggal Lahir</label>
                                                            <input type="date" class="form-control" id="tglAhliWaris1" name="tglAhliWaris[]">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--<button type="button" class="btn btn-info btn-sm" id="addAhliWaris">Tambah Ahli Waris</button>-->
                                        <button type="button" class="btn btn-danger prev-btn btn-sm">Kembali</button>
                                        <button type="button" class="btn btn-primary next-btn btn-sm">Selanjutnya</button>
                                    </div>

                                    <!-- Step 3 -->
                                    <div id="step3" class="step">
                                        <input type="hidden" name="biaya_materai" value="{{ $landing->materai_fee }}">
                                        <input type="hidden" name="biaya_admin" value="{{ $landing->admin_fee }}">
                                        <input type="hidden" name="nilai_premi" value="{{ $onlineproduct->min_price }}">
                                        <input type="hidden" name="rate" value="{{ $onlineproduct->rate }}">
                                        <input type="hidden" name="product_id" value="{{ $onlineproduct->id }}">
                                        <hr class="my-4">
                                        <h3 class="mb-4"><span class="icon btn btn-circle btn-md btn-primary pe-none mb-1"><span class="number">03</span></span> Ringkasan</h3>
                                        <hr class="my-4">

                                        <div class="row gx-md-12 gx-xl-12 gy-12" id="summaryContainer">
                                            <div class="col-lg-8">
                                                <div class="card shadow-none bg-pale-blue">
                                                    <div class="card-body">
                                                        <h5>Informasi Nasabah</h5>
                                                        <div class="row gx-4 mb-4">
                                                            <div class="col-md-4">
                                                                <span class="card-text">Nama Lengkap</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                - <span id="summaryNamaLengkap"></span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <span class="card-text">Email</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                - <span id="summaryEmail"></span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <span class="card-text">Nomor KTP</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                - <span id="summaryNomorKTP"></span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <span class="card-text">Tanggal Lahir</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                - <span id="summaryTanggalLahir"></span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <span class="card-text">Alamat</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                - <span id="summaryAlamatNasabah"></span>
                                                            </div>
                                                            @if (auth()->check())
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Kabubapten / Kota</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span>{{ Auth::user()->city }}</span>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Kecamatan</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span>{{ Auth::user()->district }}</span>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Kelurahan</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span>
                                                                @php
                                                                    $poscode = Auth::user()->poscode;
                                                                    $parts = explode('-', $poscode);
                                                                    $extractedPoscode = isset($parts[0]) ? $parts[0] : '';
                                                                @endphp    
                                                                {{ $extractedPoscode }}</span>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Provinsi</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span>{{ Auth::user()->province }}</span>, <span>
                                                                @php
                                                                    $poscode = Auth::user()->poscode;
                                                                    $parts = explode('-', $poscode);
                                                                    $extractedPoscode = isset($parts[1]) ? $parts[1] : '';
                                                                @endphp    
                                                                {{ $extractedPoscode }}</span>
                                                            </div>
                                                            @else
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Kabupaten / Kota</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span id="summaryKotaNasabah"></span>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Kecamatan</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span id="summaryKecamatanNasabah"></span>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Kelurahan</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span id="summaryKelurahanNasabah"></span>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <span class="card-text">Provinsi</span>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                - <span id="summaryProvinsiNasabah"></span>, <span id="summaryKodePosNasabah"></span>
                                                            </div>
                                                            @endif   
                                                        </div>
                                                        <h5>Informasi Ahli Waris</h5>
                                                        <div class="ahliWarisSummary"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="table-responsive">
                                                    <table class="table table-order">
                                                        <tbody>
                                                            <tr>
                                                                <td class="ps-0"><strong class="text-dark">Nilai Premi</strong></td>
                                                                <td class="pe-0 text-end">
                                                                    <p class="price">{{ format_uang($onlineproduct->min_price) }}</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-0"><strong class="text-dark">Biaya Materai</strong></td>
                                                                <td class="pe-0 text-end">
                                                                    <p class="price">{{ format_uang($landing->materai_fee) }}</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-0"><strong class="text-dark">Biaya Admin</strong></td>
                                                                <td class="pe-0 text-end">
                                                                    <p class="price">{{ format_uang($landing->admin_fee) }}</p>
                                                                </td>
                                                            </tr>
                                                            @if (auth()->check())
                                                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                            @endif
                                                            <input type="hidden" name="referal_code" value="{{ $referal_code ?? '' }}">
                                                            <input type="hidden" name="referal_code_upline" value="{{ $referal_code ?? '' }}">
                                                            <tr>
                                                                <td class="ps-0"><strong class="text-dark">Total Bayar</strong></td>
                                                                <td class="pe-0 text-end">
                                                                    <p class="price text-dark fw-bold" id="summaryTotalBayar"></p>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="same-address">
                                                    <label class="form-check-label" for="same-address">Saya setuju dengan semua 
                                                        <a href="{{ env('APP_URL') }}kebijakan-privasi" target="_blank"
                                                            rel="noopener noreferrer">kebijakan privasi</a> & <a href="{{ env('APP_URL') }}aturan-pengguna" target="_blank"
                                                            rel="noopener noreferrer">aturan pengunan
                                                        </a> yang berlaku
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="save-info">
                                                    <label class="form-check-label" for="save-info">Saya menyatakan data sudah benar</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="save-share">
                                                    <label class="form-check-label" for="save-share">Saya bersedia data dialihkan ke pihak lain</label>
                                                </div>
                                                <button type="submit" class="btn btn-primary next-btn btn-sm rounded w-100 mt-4 paymentProcess" disabled>Proses Pembayaran</button>
                                                <button type="button" class="btn btn-danger prev-btn btn-sm rounded w-100 mt-2">Kembali</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Confirmation Modal --}}
        <div class="modal fade modal-center mt-4" id="confirmationModal" tabindex="-1">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-12 col-lg-8 mb-4 mb-lg-0 my-auto align-items-center">
                                <p class="mb-2">Apakah data sudah benar...?</p>
                            </div>
                            <div class="col-md-5 col-lg-4 text-lg-end my-auto">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cek</button>
                                <button type="button" class="btn btn-primary  btn-sm" id="confirmNext">Ya</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('before-script')
        <script src="/js/formatRupiah.js"></script>
        <script src="/js/formatTanggal.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        @if ($onlineproduct->id == '1')
            <script>
                function formatRupiah(angka, prefix) {
                    var number_string = angka.replace(/[^,\d]/g, '').toString(),
                        split = number_string.split(','),
                        sisa = split[0].length % 3,
                        rupiah = split[0].substr(0, sisa),
                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                    if (ribuan) {
                        separator = sisa ? '.' : '';
                        rupiah += separator + ribuan.join('.');
                    }

                    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
                }

                var nilaiBangunan = document.getElementById('nilaiBangunan');
                nilaiBangunan.addEventListener('keyup', function(e) {
                    nilaiBangunan.value = formatRupiah(this.value);
                });

                var nilaiTertanggung = document.getElementById('nilaiTertanggung');
                nilaiTertanggung.addEventListener('keyup', function(e) {
                    nilaiTertanggung.value = formatRupiah(this.value);
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
                            kecamatan.innerHTML = `
                                <option value="" selected disabled>Pilih Kecamatan</option>
                            `
                            for (let i = 0; i < kecamatanLength; i++) {
                                var option = document.createElement('option');
                                option.value = data[i].id_districts + '-' + data[i].name_districts;
                                option.textContent = data[i].name_districts;
                                kecamatan.appendChild(option);
                            }
                            // default selected first option
                            kecamatan.value = kecamatan.options[0].value;
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                })
                $('#kecamatanNasabah').on('change', function() {
                    $('#kodePosNasabah').empty();
                    var kecamatanId = this.value;
                    console.log(kecamatanId.split('-')[1]);
                    fetch('/api/address/postcode/' + kecamatanId.split('-')[1])
                        .then((response) => {
                            return response.json();
                        })
                        .then((data) => {
                            var kodePos = document.getElementById('kodePosNasabah');
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
                            // default selected first option
                            kodePos.value = kodePos.options[0].value;
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                })
            </script>
        @endif

        @if ($onlineproduct->id == '2')
            <script>
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
                            provinsiNasabah.appendChild(option);
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
                            // default selected first option
                            kecamatan.selectedIndex = 0;
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                })
                $('#kecamatanNasabah').on('change', function() {
                    $('#kodePosNasabah').empty();
                    var kecamatanId = this.value;
                    console.log(kecamatanId.split('-')[1]);
                    fetch('/api/address/postcode/' + kecamatanId.split('-')[1])
                        .then((response) => {
                            return response.json();
                        })
                        .then((data) => {
                            var kodePos = document.getElementById('kodePosNasabah');
                            kodePos.innerHTML = `
                                <option value="" selected disabled>Pilih Kelurahan - Kode Pos</option>
                            `
                            var kodePosLength = data.length;
                            for (let i = 0; i < kodePosLength; i++) {
                                var option = document.createElement('option');
                                option.value = data[i].name_villages + '-' + data[i].poscode;
                                option.textContent = data[i].name_villages + ' - ' + data[i].poscode;
                                kodePos.appendChild(option);
                            }
                            // default selected first option
                            kodePos.selectedIndex = 0;
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                })
            </script>
        @endif
        
        <script>
            $(document).ready(function() {
            // Add an event listener to the checkbox
            $('#save-share').change(function() {
                // Check if the checkbox is checked
                if ($(this).prop('checked')) {
                $('.paymentProcess').removeClass('btn-primary').addClass('btn-success').prop('disabled', false);
                } else {
                $('.paymentProcess').removeClass('btn-danger').addClass('btn-primary').prop('disabled', true);
                }
            });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#showloading').hide();
                let currentStep = 1;
                let isAuthed = "{{ auth()->check() }}";
                let isLogin = "{{ session()->get('isLogin') ?? '' }}";
                let min_price = "{{ $onlineproduct->min_price }}";
                let max_price = "{{ $onlineproduct->max_price }}";

                $('.paymentProcess').on('click', function() {
                    $('#showloading').show();
                })

                function checkCheckboxes() {
                    var sameAddressChecked = $('#same-address').prop('checked');
                    var saveInfoChecked = $('#save-info').prop('checked');
                    return sameAddressChecked && saveInfoChecked;
                }

                // Update button state when checkboxes change
                $('#same-address, #save-info').change(function() {
                    var isChecked = checkCheckboxes();
                    $('.paymentProcess').prop('disabled', !isChecked);
                });

                if (isLogin == '1') {
                    var typeInsurance = "{{ $onlineproduct->id }}";
                    currentStep = 2;
                    if (typeInsurance == '1') {
                        $('#statusKepemilikan').val(readValueLocalStorage('statusKepemilikan'));
                        $('#nilaiBangunan').val(readValueLocalStorage('nilaiBangunan'));
                        $('#nilaiTertanggung').val(readValueLocalStorage('nilaiTertanggung'));
                        $('#alamatRumah').val(readValueLocalStorage('alamatRumah'));
                        $('#provinsi').val(readValueLocalStorage('provinsi'));
                        $('#kota').val(readValueLocalStorage('kota'));
                        $('#kecamatan').val(readValueLocalStorage('kecamatan'));
                        $('#kodePos').val(readValueLocalStorage('kodePos'));

                    } else {
                        $('#namaLengkap').val(readValueLocalStorage('namaLengkap'));
                        $('#nomorKTP').val(readValueLocalStorage('nomorKTP'));
                        $('#email').val(readValueLocalStorage('email'));
                        $('#phone').val(readValueLocalStorage('phone'));
                        $('#tempatLahir').val(readValueLocalStorage('tempatLahir'));
                        $('#tanggalLahir').val(readValueLocalStorage('tanggalLahir'));
                        $('#alamatRumah').val(readValueLocalStorage('alamatRumah'));
                    }
                }

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

                function saveToLocalStorage(key, value) {
                    localStorage.setItem(key, value);
                }

                function readValueLocalStorage(key) {
                    return localStorage.getItem(key) || '';
                }

                // Function to show the current step
                function showStep(step) {
                    $('.step').hide();
                    $(`#step${step}`).show();
                }

                function showAllAhliWaris() {
                    var ahliWarisValueInputs = [];
                    var ahliWarisValueInputsLength = $('.ahli-waris-container').length;
                    console.log($('.ahli-waris-container'));
                    for (let i = 0; i < ahliWarisValueInputsLength; i++) {
                        var ahliWarisValueInput = {
                            namaAhliWaris: $('#namaAhliWaris' + (i + 1)).val(),
                            nomorIdentitasAhliWaris: $('#nomorIdentitasAhliWaris' + (i + 1)).val(),
                            hubunganStatusAhliWaris: $('#hubunganStatusAhliWaris' + (i + 1)).val(),
                            emailAhliWaris: $('#emailAhliWaris' + (i + 1)).val(),
                            ttlAhliWaris: $('#ttlAhliWaris' + (i + 1)).val(),
                            tglAhliWaris: $('#tglAhliWaris' + (i + 1)).val(),
                        };
                        ahliWarisValueInputs.push(ahliWarisValueInput);
                    }
                    $('.ahliWarisSummary').html('');
                    console.log("ahliWarisValueInputs: ", ahliWarisValueInputs);
                    for (let i = 0; i < ahliWarisValueInputs.length; i++) {
                        var ahliWarisSummaryHtml =
                            '<div class="row gx-4 mb-4">' +
                            '<div class="col-md-4">' +
                            '<span class="card-text">Nama Ahli Waris</span>' +
                            '</div>' +
                            '<div class="col-md-8">' +
                            '- <span>' + ahliWarisValueInputs[i].namaAhliWaris + '</span>' +
                            '</div>' +
                            '<div class="col-md-4">' +
                            '<span class="card-text">Nomor Identitas Ahli Waris</span>' +
                            '</div>' +
                            '<div class="col-md-8">' +
                            '- <span>' + ahliWarisValueInputs[i].nomorIdentitasAhliWaris + '</span>' +
                            '</div>' +
                            '<div class="col-md-4">' +
                            '<span class="card-text">Hubungan Status Ahli Waris</span>' +
                            '</div>' +
                            '<div class="col-md-8">' +
                            '- <span>' + ahliWarisValueInputs[i].hubunganStatusAhliWaris + '</span>' +
                            '</div>' +
                            '<div class="col-md-4">' +
                            '<span class="card-text">Email</span>' +
                            '</div>' +
                            '<div class="col-md-8">' +
                            '- <span>' + ahliWarisValueInputs[i].emailAhliWaris + '</span>' +
                            '</div>' +
                            '<div class="col-md-4">' +
                            '<span class="card-text">Tempat Lahir</span>' +
                            '</div>' +
                            '<div class="col-md-8">' +
                            '- <span>' + ahliWarisValueInputs[i].ttlAhliWaris + '</span>' +
                            '</div>' +
                            '<div class="col-md-4">' +
                            '<span class="card-text">Tanggal Lahir</span>' +
                            '</div>' +
                            '<div class="col-md-8">' +
                            '- <span>' + formatTanggal(ahliWarisValueInputs[i].tglAhliWaris) + '</span>' +
                            '</div>' +
                            '</div>' +
                            '<hr style="margin-bottom: 20px; margin-top: 20px">';
                        $('.ahliWarisSummary').append(ahliWarisSummaryHtml);
                    }
                }

                // Function to validate and move to the next step
                function nextStep() {
                    if (validateStep(currentStep)) {
                        if (currentStep == 1) {
                            $('.nav-link-step1').addClass('active')
                            $('.custom-divider-step1').addClass('border-primary')
                        };
                        console.log("TEST STEP NEXT");
                        if(currentStep == 1 || currentStep == 2) {
                            $('#confirmationModal').modal('show');
                        }
                    }
                }

                $('#confirmNext')?.on('click', function() {
                    $('#confirmationModal').modal('hide')
                    currentStep++;
                    if (currentStep == 3) {
                        showAllAhliWaris()
                    }
                    $('#showValidation').html('');
                    $('.nav-link-step' + currentStep).addClass('active');
                    $('.custom-divider-step' + currentStep).addClass('border-primary');
                    showStep(currentStep);
                    updateProgressBar(currentStep);
                })

                // Function to move to the previous step
                function prevStep() {
                    $('.nav-link-step' + currentStep).removeClass('active');
                    $('.custom-divider-step' + currentStep).removeClass('border-primary');
                    currentStep--;
                    showStep(currentStep);
                    updateProgressBar(currentStep);
                }

                // Function to update progress bar
                function updateProgressBar(step) {
                    const progressPercentage = (step - 1) * 33.33; // Each step takes 33.33% of the progress bar
                    $('.progress-bar').css('width', `${progressPercentage}%`);
                }

                // Event listener for next button
                $('.next-btn').on('click', function() {
                    nextStep();
                });

                // Event listener for previous button
                $('.prev-btn').on('click', function() {
                    prevStep();
                });

                // Implement this function to validate each step
                function validateStep(step) {
                    var isValid = true;
                    var typeInsurance = "{{ $onlineproduct->id }}";

                    // Validation logic for Step 1
                    if (typeInsurance == '1') {
                        if (step === 1) {
                            isValid = validateStep1KebakaranFields();
                        } else if (step === 2) {
                            isValid = validateStep2KebakaranFields();
                        }
                        // Add additional validation logic for other steps as needed

                        return isValid;
                    }

                    if (typeInsurance == '2') {
                        if (step === 1) {
                            isValid = validateStep1KecelakaanFields();
                        } else if (step === 2) {
                            isValid = validateStep2KecelakaanFields();
                        }
                        // Add additional validation logic for other steps as needed

                        return isValid;
                    }

                    // Asuransi kebakaran
                    function validateStep1KebakaranFields() {
                        var statusKepemilikan = $("#statusKepemilikan").val();
                        var nilaiBangunan = $("#nilaiBangunan").val();
                        var nilaiTertanggung = $("#nilaiTertanggung").val();
                        var alamatRumah = $("#alamatRumah").val();
                        // Add more fields as needed
                        var provinsi = $("#provinsi").val();
                        var kota = $("#kota").val();
                        var kecamatan = $("#kecamatan").val();
                        var kodePos = $("#kodePos").val();

                        // Example validation, you can customize based on your requirements
                        if (statusKepemilikan === "" || nilaiBangunan === "" || nilaiTertanggung === "" || alamatRumah === "" || provinsi === "" || kota === "" || kecamatan === "" || kodePos === "") {
                            $('#showValidation').html('<div class="alert alert-danger bg-danger p-2 text-white" role="alert"> Isi data Informasi Bangunan" secara lengkap.</div>');
                            return false;
                        }

                        var nilaiBangunanReplace = parseInt(nilaiBangunan.replaceAll('.', ''));

                        // check if nilaiBangunan >= min_price && nilaiBangunan <= max_price
                        if (nilaiBangunanReplace < min_price || nilaiBangunanReplace > max_price) {
                            $('#showValidation').html('<div class="alert alert-danger bg-danger p-2 text-white" role="alert">Nilai Bangunan harus diantara ' + formatRupiah(min_price, 'Rp. ') +
                                ' dan ' + formatRupiah(max_price, 'Rp. ') +
                                '</div>');
                            return false;
                        }

                        return true;
                    }

                    function validateStep2KebakaranFields() {
                        var namaLengkap = $("#namaLengkap").val();
                        var email = $("#email").val();
                        var nomorKTP = $("#nomorKTP").val();
                        var tanggalLahir = $("#tanggalLahir").val();
                        var alamatNasabah = $("#alamatNasabah").val();
                        var phone = $("#phone").val();
                        // Add more fields as needed
                        var provinsiNasabah = $("#provinsiNasabah").val();
                        var kotaNasabah = $("#kotaNasabah").val();
                        var kecamatanNasabah = $("#kecamatanNasabah").val();
                        var kodePosNasabah = $("#kodePosNasabah").val();

                        // Example validation, you can customize based on your requirements
                        if (namaLengkap === "" || email === "" || nomorKTP === "" || tanggalLahir === "" || alamatNasabah === "" || provinsiNasabah === "" || kotaNasabah === "" || kecamatanNasabah ===
                            "" || kodePosNasabah === "") {
                            $('#showValidation').html('<div class="alert alert-danger bg-danger p-2 text-white" role="alert">Isi data "Informasi Nasabah" secara lengkap.</div>');
                            return false;
                        }

                        // validate email
                        var emailRegex = /\S+@\S+\.\S+/;
                        if (!emailRegex.test(email)) {
                            $('#showValidation').html('<div class="alert alert-danger bg-danger p-2 text-white" role="alert">Email tidak valid.</div>');
                            return false;
                        }

                        // check if nomorKTP.length > 12
                        if (nomorKTP.length < 12) {
                            $('#showValidation').html('<div class="alert alert-danger bg-danger p-2 text-white" role="alert">Nomor KTP minimal 12 digit.</div>');
                            return false;
                        }

                        // check if phone start with 08
                        if (phone.length < 10 || (phone.charAt(0) != '0' || phone.charAt(1) != '8')) {
                            $('#showValidation').html('<div class="alert alert-danger bg-danger p-2 text-white" role="alert">Nomor telepon harus diawali dengan 08 dan minimal 10 digit.</div>');
                            return false;
                        }

                        // check if tanggal lahir is > 17 years
                        var today = new Date();
                        var birthDate = new Date(tanggalLahir);
                        var age = today.getFullYear() - birthDate.getFullYear();
                        var m = today.getMonth() - birthDate.getMonth();
                        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                            age--;
                        }
                        if (age < 17 || age > 60) {
                            $('#showValidation').html('<div class="alert alert-danger bg-danger p-2 text-white" role="alert">Usia minimal 17 tahun dan maksimal 60.</div>');
                            return false;
                        }

                        return true;
                    }

                    // Asuransi Kecelakaan
                    function validateStep1KecelakaanFields() {
                        var namaLengkap = $("#namaLengkap").val();
                        var email = $("#email").val();
                        var nomorKTP = $("#nomorKTP").val();
                        var tanggalLahir = $("#tanggalLahir").val();
                        var phone = $("#phone").val();
                        var alamatNasabah = $("#alamatNasabah").val();
                        // Add more fields as needed
                        var provinsiNasabah = $("#provinsiNasabah").val();
                        var kotaNasabah = $("#kotaNasabah").val();
                        var kecamatanNasabah = $("#kecamatanNasabah").val();
                        var kodePosNasabah = $("#kodePosNasabah").val();

                        // Example validation, you can customize based on your requirements
                        if (namaLengkap === "" || email === "" || nomorKTP === "" || tanggalLahir === "" || alamatNasabah === "" || provinsiNasabah === "" || kotaNasabah === "" ||
                            kecamatanNasabah ===
                            "" || kodePosNasabah === "") {
                            $('#showValidation').html('<div class="alert alert-danger bg-danger p-2 text-white" role="alert">Isi data "Informasi Nasabah" secara lengkap.</div>');
                            return false;
                        }

                        // validate email
                        var emailRegex = /\S+@\S+\.\S+/;
                        if (!emailRegex.test(email)) {
                            $('#showValidation').html('<div class="alert alert-danger bg-danger p-2 text-white" role="alert">Email tidak valid.</div>');
                            return false;
                        }

                        // check if nomorKTP.length > 12
                        if (nomorKTP.length < 12) {
                            $('#showValidation').html('<div class="alert alert-danger bg-danger p-2 text-white" role="alert">Nomor KTP minimal 12 digit.</div>');
                            return false;
                        }

                        // check if phone start with 08
                        if (phone.length < 10 || (phone.charAt(0) != '0' || phone.charAt(1) != '8')) {
                            $('#showValidation').html('<div class="alert alert-danger bg-danger p-2 text-white" role="alert">Nomor telepon harus diawali dengan 08 dan minimal 10 digit.</div>');
                            return false;
                        }

                        // check if tanggal lahir is > 17 years
                        var today = new Date();
                        var birthDate = new Date(tanggalLahir);
                        var age = today.getFullYear() - birthDate.getFullYear();
                        var m = today.getMonth() - birthDate.getMonth();
                        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                            age--;
                        }
                        if (age < 17 || age > 60) {
                            $('#showValidation').html('<div class="alert alert-danger bg-danger p-2 text-white" role="alert">Usia minimal 17 tahun dan maksimal 60.</div>');
                            return false;
                        }

                        return true;
                    }

                    function validateStep2KecelakaanFields() {
                        var ahliWarisContainer = $('.ahli-waris-container');

                        // validate all ahli waris fields, include email, nomor identitas, tempat lahir, tanggal lahir with loop
                        for (let i = 0; i < ahliWarisContainer.length; i++) {
                            var namaAhliWaris = $('#namaAhliWaris' + (i + 1)).val();
                            var nomorIdentitasAhliWaris = $('#nomorIdentitasAhliWaris' + (i + 1)).val();
                            var hubunganStatusAhliWaris = $('#hubunganStatusAhliWaris' + (i + 1)).val();
                            var emailAhliWaris = $('#emailAhliWaris' + (i + 1)).val();
                            var ttlAhliWaris = $('#ttlAhliWaris' + (i + 1)).val();
                            var tglAhliWaris = $('#tglAhliWaris' + (i + 1)).val();

                            if (namaAhliWaris === "" || nomorIdentitasAhliWaris === "" || hubunganStatusAhliWaris === "" || emailAhliWaris === "" || ttlAhliWaris === "" || tglAhliWaris === "") {
                                $('#showValidation').html('<div class="alert alert-danger bg-danger p-2 text-white" role="alert">Isi data "Ahli Waris" secara lengkap.</div>');
                                return false;
                            }

                            // validate email
                            var emailRegex = /\S+@\S+\.\S+/;
                            if (!emailRegex.test(emailAhliWaris)) {
                                $('#showValidation').html('<div class="alert alert-danger bg-danger p-2 text-white" role="alert">Email tidak valid.</div>');
                                return false;
                            }
                            
                            // check if nomorIdentitasAhliWaris.length > 12
                            if (nomorIdentitasAhliWaris.length < 12) {
                                $('#showValidation').html('<div class="alert alert-danger bg-danger p-2 text-white" role="alert">Nomor Identitas minimal 12 digit.</div>');
                                return false;
                            }

                            // check if tanggal lahir is > 17 years
                            var today = new Date();
                            var birthDate = new Date(tanggalLahir);
                            var age = today.getFullYear() - birthDate.getFullYear();
                            var m = today.getMonth() - birthDate.getMonth();
                            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                                age--;
                            }
                            if (age < 17 ) {
                                $('#showValidation').html('<div class="alert alert-danger bg-danger p-2 text-white" role="alert">Usia minimal 17 tahun.</div>');
                                return false;
                            }

                        }

                        return true;
                    }
                }
                // Initial display
                showStep(currentStep);
                updateProgressBar(currentStep);
            });
        </script>

        <script>
            $(document).ready(function() {
                var provinsi = document.getElementById('provinsi');
                /* Fungsi */

                // Function to update the summary based on user inputs
                function updateSummary() {
                    // get kecamata nasabah and kode pos nasabah default to first option
                    var kecamatanNasabah = $('#kecamatanNasabah').val();
                    var kodePosNasabah = $('#kodePosNasabah').val();
                    var kecamatan = $('#kecamatan').val();
                    console.log(kecamatanNasabah, kodePosNasabah, kecamatan);
                    // Step 1
                    $('#summaryAlamatBangunan').text($('#alamatRumah').val());
                    $('#summaryProvinsiBangunan').text($('#provinsi').val()?.toString()?.split('-')[1]);
                    $('#summaryKotaBangunan').text($('#kota').val()?.toString()?.split('-')[1]);
                    $('#summaryKecamatanBangunan').text($('#kecamatan').val()?.toString()?.split('-')[1]);
                    $('#summaryKodeposBangunan').text($('#kodePos').val()?.toString()?.split('-')[1]);
                    $('#summaryKelurahan').text($('#kodePos').val()?.toString()?.split('-')[0]);

                    $('#summaryStatusKepemilikan').text($('#statusKepemilikan').val());
                    $('#summaryNilaiBangunan').text('Rp. ' + $('#nilaiBangunan').val());
                    $('#summaryNilaiTertanggung').text('Rp. ' + $('#nilaiTertanggung').val());
                    // Add other Step 1 summary updates here


                    // Step 2
                    $('#summaryNamaLengkap').text($('#namaLengkap').val());
                    $('#summaryEmail').text($('#email').val());
                    $('#summaryNomorKTP').text($('#nomorKTP').val());
                    $('#summaryTanggalLahir').text(formatTanggal($('#tanggalLahir').val()));
                    $('#summaryAlamatNasabah').text($('#alamatNasabah').val());
                    $('#summaryProvinsiNasabah').text($('#provinsiNasabah').val()?.toString()?.split('-')[1]);
                    $('#summaryKotaNasabah').text($('#kotaNasabah').val()?.toString()?.split('-')[1]);
                    $('#summaryKecamatanNasabah').text(kecamatanNasabah?.toString()?.split('-')[1]);
                    $('#summaryKodePosNasabah').text(kodePosNasabah?.toString()?.split('-')[1]);
                    $('#summaryKelurahanNasabah').text(kodePosNasabah?.toString()?.split('-')[0]);
                    // Add other Step 2 summary updates here

                    // Total Bayar
                    var adminFee = parseFloat('{{ $landing->admin_fee }}');
                    var materaiFee = parseFloat('{{ $landing->materai_fee }}');
                    var insuranceFee = parseFloat('{{ $onlineproduct->min_price }}');
                    var rate = parseFloat('{{ $onlineproduct->rate }}');
                    var type = "{{ $onlineproduct->id }}";
                    var totalBayar = 0;

                    if (type == '1') {
                        var nilaiBangunan = parseFloat($('#nilaiBangunan').val().replaceAll('.', ''));
                        var nilaiTertanggung = parseFloat($('#nilaiTertanggung').val().replaceAll('.', ''));
                        $('#premi_kebakaran').html(formatRupiah(((nilaiBangunan + nilaiTertanggung) * (rate / 1000)).toString()));
                        var totalBayar = (((nilaiBangunan + nilaiTertanggung) * (rate / 1000)) + (adminFee + materaiFee));
                    } else {
                        $('#premi_kecelakaan').html(formatRupiah((insuranceFee * rate).toString()));
                        var totalBayar = (adminFee + materaiFee + insuranceFee) * rate;
                    }

                    $('#summaryTotalBayar').text(formatRupiah(totalBayar.toString(), 'Rp. '));
                }

                // Event listener for input changes
                $('#insuranceForm :input').on('change', function() {
                    updateSummary();
                });

                // Initial update on page load
                updateSummary();

                var ahliWarisCounter = 1;

                // Event listener for adding Ahli Waris
                $("#addAhliWaris").click(function() {
                    ahliWarisCounter++;

                    var ahliWarisHtml =
                        '<div class="ahli-waris-container mt-3 mb-3" id="ahliWaris' + ahliWarisCounter + '">' +
                        '<hr style="margin-bottom: 20px; margin-top: 20px">' +
                        '<div class="row gx-4">' +
                        '<div class="col-md-4">' +
                        '<div class="mb-3">' +
                        '<label for="namaAhliWaris' + ahliWarisCounter + '" class="form-label">Nama Ahli Waris</label>' +
                        '<input type="text" class="form-control" id="namaAhliWaris' + ahliWarisCounter + '" name="namaAhliWaris[]" >' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-md-4">' +
                        '<div class="mb-3">' +
                        '<label for="nomorIdentitasAhliWaris' + ahliWarisCounter + '" class="form-label">Nomor Identitas Ahli Waris (Optional)</label>' +
                        '<input type="number" class="form-control" id="nomorIdentitasAhliWaris' + ahliWarisCounter + '" name="nomorIdentitasAhliWaris[]" >' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-md-4">' +
                        '<div class="mb-3">' +
                        '<label for="hubunganStatusAhliWaris' + ahliWarisCounter + '" class="form-label">Hubungan Status Ahli Waris</label>' +
                        '<select class="form-select" id="hubunganStatusAhliWaris' + ahliWarisCounter + '" name="hubunganStatusAhliWaris[]" >' +
                        '<option value="Suami/Istri">Suami/Istri</option>' +
                        '<option value="Anak">Anak</option>' +
                        '<option value="Orangtua">Orangtua</option>' +
                        '<option value="Saudara Kandung">Saudara Kandung</option>' +
                        '<option value="Saudara dari ayah/ibu">SSaudara dari ayah/ibu</option>' +
                        '<option value="Saudara sepupu">Saudara sepupu</option>' +
                        '</select>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-md-4">' +
                        '<div class="mb-3">' +
                        '<label for="emailAhliWaris' + ahliWarisCounter + '" class="form-label">Email</label>' +
                        '<input type="email" class="form-control" id="emailAhliWaris' + ahliWarisCounter + '" name="emailAhliWaris[]" >' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-md-4">' +
                        '<div class="mb-3">' +
                        '<label for="ttlAhliWaris' + ahliWarisCounter + '" class="form-label">Tempat Lahir</label>' +
                        '<input type="text" class="form-control" id="ttlAhliWaris' + ahliWarisCounter + '" name="ttlAhliWaris[]" >' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-md-4">' +
                        '<div class="mb-3">' +
                        '<label for="tglAhliWaris' + ahliWarisCounter + '" class="form-label">Tanggal Lahir</label>' +
                        '<input type="date" class="form-control" id="tglAhliWaris' + ahliWarisCounter + '" name="tglAhliWaris[]" >' +
                        '</div>' +
                        '</div>' +

                        '</div>' +
                        '<div class="d-flex justify-content-end"><button class="remove-ahli-waris btn btn-danger btn-sm" data-counter="' + ahliWarisCounter + '">Hapus</button></div>' +
                        '</div>';

                    $("#ahliWarisContainer").append(ahliWarisHtml);

                    // Add event listener for removing Ahli Waris
                    $(".remove-ahli-waris").click(function() {
                        var counter = $(this).data("counter");
                        $("#ahliWaris" + counter).remove();
                    });
                });

            });
        </script>
    @endpush


@endsection
