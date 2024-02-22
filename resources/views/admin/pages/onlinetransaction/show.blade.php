@extends('admin.layouts.app')
<!-- set title -->
@section('title')

@section('content')
    <div class="row seperator-header layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="col-lg-12 layout-spacing">

                <div class="row">
                    <div class="col-lg-12 layout-spacing">
                        <div class="statbox widget box box-shadow">

                            <div class="widget-content widget-content-area br-8">
                                <div class="px-4">
                                    <hr>
                                    <h5 class="mt-2">Informasi Transaksi</h5>
                                    <hr>
                                </div>
                                <form class="row g-3 px-4">
                                    <div class="col-md-4">
                                        <label for="status_bangunan" class="col-form-label">Nama Produk Asuransi</label>
                                        <input readonly value="{{ $data['product']->name }}" type="text" class="form-control text-white bg-dark" id="status_bangunan">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="nilai_bangunan" class="col-form-label">No Transaksi</label>
                                        <input readonly value="{{ $data['transaction_id'] }}" type="text" class="form-control text-white bg-dark" id="nilai_bangunan">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="nilai_lainnya" class="col-form-label">Tanggal Transaksi</label>
                                        <input readonly value="{{ tanggal_local($data->created_at) ?? '' }}" type="text" class="form-control text-white bg-dark" id="nilai_lainnya">
                                    </div>
                                    @if ($data->status == 5)
                                        <div class="col-md-4">
                                            <label for="status_bangunan" class="col-form-label">No Polis</label>
                                            <input readonly value="{{ $data['no_polis'] }}" type="text" class="form-control text-white bg-dark" id="status_bangunan">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="nilai_bangunan" class="col-form-label">Tanggal Polis</label>
                                            <input readonly value="{{ tanggal_local($data['payment']->updated_at) ?? '' }}" type="text" class="form-control text-white bg-dark" id="nilai_bangunan">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="nilai_lainnya" class="col-form-label">Tanggal Akhir Polis</label>
                                            <input readonly value="{{ tanggal_local($data->jatuh_tempo) ?? '' }}" type="text" class="form-control text-white bg-dark" id="nilai_lainnya">
                                        </div>
                                    @endif
                                </form>

                                <div class="px-4">
                                    <hr>
                                    <h5 class="mt-2">Nasabah</h5>
                                    <hr>
                                </div>
                                <div class="row mb-3 mt-4 px-4">
                                    <label for="nasabah_name" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input readonly value="{{ $data->nasabah_name }}" type="text" class="form-control text-white bg-dark" id="nasabah_name">
                                    </div>
                                </div>
                                <div class="row mb-3 px-4">
                                    <label for="nasabah_dob" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-4 mb-3">
                                        <input readonly value="{{ tanggal_local($data->nasabah_dob) }}" type="text" class="form-control text-white bg-dark" id="nasabah_dob">
                                    </div>
                                    <label for="nasabah_phone" class="col-sm-2 col-form-label">Telp</label>
                                    <div class="col-sm-4">
                                        <input readonly value="{{ $data->nasabah_phone }}" type="text" class="form-control text-white bg-dark" id="nasabah_phone">
                                    </div>
                                </div>
                                <div class="row mb-3 px-4">
                                    <label for="nasabah_id" class="col-sm-2 col-form-label">No Identitas (KTP)</label>
                                    <div class="col-sm-4">
                                        <input readonly value="{{ $data->nasabah_id }}" type="text" class="form-control text-white bg-dark mb-3" id="nasabah_id">
                                    </div>
                                    <label for="nasabah_email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-4">
                                        <input readonly value="{{ $data->nasabah_email }}" type="email" class="form-control text-white bg-dark" id="nasabah_email">
                                    </div>
                                </div>
                                <div class="row mb-3 px-4">
                                    <label for="nasabah_address" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-6">
                                        <textarea readonly class="form-control text-white bg-dark mb-2" name="nasabah_address" id="nasabah_address" rows="9">{{ $data->nasabah_address }}</textarea>
                                    </div>
                                    <div class="col-sm-4">
                                        <input readonly value="{{ $data->nasabah_city }}" type="text" class="form-control text-white bg-dark mb-2" id="nasabah_city">
                                        <input readonly value="{{ $data->nasabah_district }}" type="text" class="form-control text-white bg-dark mb-2" id="nasabah_district">
                                        <input readonly value="{{ $data->nasabah_province }}" type="text" class="form-control text-white bg-dark mb-2" id="nasabah_province">
                                        <input readonly value="{{ $data->nasabah_poscode }}" type="text" class="form-control text-white bg-dark mb-2" id="nasabah_poscode">
                                    </div>
                                </div>

                                @if ($data->tertanggung_name != null)
                                    <div class="px-4">
                                        <hr>
                                        <h5 class="mt-2">Informasi Tertanggung</h5>
                                        <hr>
                                    </div>
                                    <div class="row mb-3 mt-4 px-4">
                                        <label for="tertanggung_name" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input readonly value="{{ $data->tertanggung_name }}" type="text" class="form-control text-white bg-dark" id="tertanggung_name">
                                        </div>
                                    </div>
                                    <div class="row mb-3 mt-4 px-4">
                                        <label for="tertanggung_id" class="col-sm-2 col-form-label">No KTP</label>
                                        <div class="col-sm-4 mb-3">
                                            <input readonly value="{{ $data->tertanggung_id }}" type="text" class="form-control text-white bg-dark" id="tertanggung_id">
                                        </div>
                                        <label for="tertanggung_work" class="col-sm-2 col-form-label">Pekerjaan</label>
                                        <div class="col-sm-4 mb-3">
                                            <input readonly value="{{ $data->tertanggung_work }}" type="text" class="form-control text-white bg-dark" id="tertanggung_work">
                                        </div>
                                    </div>
                                    <div class="row mb-3 px-4">
                                        <label for="tertanggung_pob" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                        <div class="col-sm-4 mb-3">
                                            <input readonly value="{{ $data->tertanggung_pob }}" type="text" class="form-control text-white bg-dark" id="tertanggung_pob">
                                        </div>
                                        <label for="tertanggung_dob" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                        <div class="col-sm-4 mb-3">
                                            <input readonly value="{{ tanggal_local($data->tertanggung_dob) }}" type="text" class="form-control text-white bg-dark" id="tertanggung_dob">
                                        </div>
                                    </div>
                                    <div class="row mb-3 px-4">
                                        <label for="tertanggung_phone" class="col-sm-2 col-form-label">Telp</label>
                                        <div class="col-sm-4 mb-3">
                                            <input readonly value="{{ $data->tertanggung_phone }}" type="text" class="form-control text-white bg-dark" id="tertanggung_phone">
                                        </div>
                                        <label for="tertanggung_email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-4">
                                            <input readonly value="{{ $data->tertanggung_email }}" type="email" class="form-control text-white bg-dark" id="tertanggung_email">
                                        </div>
                                    </div>
                                    <div class="row mb-3 px-4">
                                        <label for="nasabah_address" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-6">
                                            <textarea readonly class="form-control text-white bg-dark mb-2" name="nasabah_address" id="tertanggung_address" rows="9">{{ $data->tertanggung_address }}</textarea>
                                        </div>
                                        <div class="col-sm-4">
                                            <input readonly value="{{ $data->tertanggung_city }}" type="text" class="form-control text-white bg-dark mb-2" id="tertanggung_city">
                                            <input readonly value="{{ $data->tertanggung_district }}" type="text" class="form-control text-white bg-dark mb-2" id="tertanggung_district">
                                            <input readonly value="{{ $data->tertanggung_province }}" type="text" class="form-control text-white bg-dark mb-2" id="tertanggung_province">
                                            <input readonly value="{{ $data->tertanggung_poscode }}" type="text" class="form-control text-white bg-dark mb-2" id="tertanggung_poscode">
                                        </div>
                                    </div>

                                    <div class="px-4">
                                        <hr>
                                        <h5 class="mt-2">Ahli Waris</h5>
                                        <hr>
                                    </div>
                                    @foreach ($data['ahliwaris'] as $d)
                                        <div class="row mb-3 px-4">
                                            <label for="name" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-4 mb-3">
                                                <input readonly value="{{ $d->name }}" type="text" class="form-control text-white bg-dark" id="name">
                                            </div>
                                            <label for="relationship" class="col-sm-2 col-form-label">Hubungan</label>
                                            <div class="col-sm-4">
                                                <input readonly value="{{ $d->relationship }}" type="text" class="form-control text-white bg-dark" id="relationship">
                                            </div>
                                        </div>
                                        <div class="row mb-3 px-4">
                                            <label for="no_id" class="col-sm-2 col-form-label">No Identitas</label>
                                            <div class="col-sm-4 mb-3">
                                                <input readonly value="{{ $d->no_id }}" type="text" class="form-control text-white bg-dark" id="no_id">
                                            </div>
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-4">
                                                <input readonly value="{{ $d->email }}" type="email" class="form-control text-white bg-dark" id="email">
                                            </div>
                                        </div>
                                        <div class="row mb-3 px-4">
                                            <label for="pob" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                            <div class="col-sm-4 mb-3">
                                                <input readonly value="{{ $d->pob }}" type="text" class="form-control text-white bg-dark" id="pob">
                                            </div>
                                            <label for="dob" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                            <div class="col-sm-4">
                                                <input readonly value="{{ tanggal_local($d->dob) }}" type="text" class="form-control text-white bg-dark" id="dob">
                                            </div>
                                        </div>
                                        <div class="px-4">
                                            <hr>
                                        </div>
                                    @endforeach

                                @endif

                                @if ($data->nilai_bangunan != null)
                                    <div class="px-4">
                                        <hr>
                                        <h5 class="mt-2">Informasi Bangunan</h5>
                                        <hr>
                                    </div>
                                    <form class="row g-3 px-4">
                                        <div class="col-md-4">
                                            <label for="status_bangunan" class="col-form-label">Status Kepemilikan</label>
                                            <input readonly value="{{ $data->status_bangunan }}" type="text" class="form-control text-white bg-dark" id="status_bangunan">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="nilai_bangunan" class="col-form-label">Nilai Bangunan</label>
                                            <input readonly value="{{ format_uang($data->nilai_bangunan) }}" type="text" class="form-control text-white bg-dark" id="nilai_bangunan">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="nilai_lainnya" class="col-form-label">Nilai Lainnya</label>
                                            <input readonly value="{{ format_uang($data->nilai_lainnya) }}" type="text" class="form-control text-white bg-dark" id="nilai_lainnya">
                                        </div>
                                    </form>
                                    <div class="row mb-3 px-4 mt-3">
                                        <label for="address_bangunan" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-6">
                                            <textarea readonly class="form-control text-white bg-dark mb-2" name="address_bangunan" id="address_bangunan" rows="9">{{ $data->address_bangunan }}</textarea>
                                        </div>
                                        <div class="col-sm-4">
                                            <input readonly value="{{ $data->kota_bangunan }}" type="text" class="form-control text-white bg-dark mb-2" id="kota_bangunan">
                                            <input readonly value="{{ $data->district_bangunan }}" type="text" class="form-control text-white bg-dark mb-2" id="district_bangunan">
                                            <input readonly value="{{ $data->province_bangunan }}" type="text" class="form-control text-white bg-dark mb-2" id="province_bangunan">
                                            <input readonly value="{{ $data->poscode_bangunan }}" type="text" class="form-control text-white bg-dark mb-2" id="poscode_bangunan">
                                        </div>
                                    </div>
                                @endif

                                <div class="px-4">
                                    @if ($data->tertanggung_name != null)
                                        <h5 class="mt-2">Informasi Pembayaran</h5>
                                        <hr>
                                    @elseif ($data->tertanggung_name == null)
                                        <hr>
                                        <h5 class="mt-2">Informasi Pembayaran</h5>
                                        <hr>
                                    @endif
                                </div>
                                <form class="row g-3 px-4">                                    
                                    @if ($data['payment']->status == 3)
                                        <div class="col-md-3">
                                            <label for="nilai_premi" class="col-form-label">Nilai Premi</label>
                                            <input readonly value="{{ format_uang($data->nilai_premi) }}" type="text" class="form-control text-white bg-dark" id="nilai_premi">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="biaya_materai" class="col-form-label">Biaya Materai</label>
                                            <input readonly value="{{ format_uang($data->biaya_materai) }}" type="text" class="form-control text-white bg-dark" id="biaya_materai">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="biaya_admin" class="col-form-label">Biaya Admin</label>
                                            <input readonly value="{{ format_uang($data->biaya_admin) }}" type="text" class="form-control text-white bg-dark" id="biaya_admin">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="total_payment" class="col-form-label">Total Pembayaran</label>
                                            <input readonly value="{{ format_uang($data->total_payment) }}" type="text" class="form-control text-white bg-dark" id="total_payment">
                                        </div>
                                        @if ($data->payment && $data->payment->expired < \Carbon\Carbon::now())
                                        <div class="col-md-3">
                                            <label for="status" class="col-form-label">Status Pembayaran</label>
                                            <input readonly value="Pembayaran Expired" type="text" class="form-control text-white bg-dark" id="status">
                                        </div>
                                        @elseif($data->payment && $data->payment->expired >= \Carbon\Carbon::now())
                                        <div class="col-md-3">
                                            <label for="status" class="col-form-label">Status Pembayaran</label>
                                            <input readonly value="Menunggu Pembayaran" type="text" class="form-control text-white bg-dark" id="status">
                                        </div>
                                        @endif
                                        <div class="col-md-9 mb-4">
                                            <label for="payment_method" class="col-form-label">Link Pembayaran</label>
                                            <div class="clipboard-input">
                                                <input readonly type="text" class="form-control text-white bg-dark" id="copy-basic-input"
                                                value="{{ $data->payment->url_payment ?? '' }}">
                                                <div class="copy-icon jsclipboard cbBasic" data-bs-trigger="click" title="Copied" data-clipboard-target="#copy-basic-input">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-copy">
                                                        <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($data['payment']->status == 2)
                                        <div class="col-md-2">
                                            <label for="nilai_premi" class="col-form-label">Nilai Premi</label>
                                            <input readonly value="{{ format_uang($data->nilai_premi) }}" type="text" class="form-control text-white bg-dark" id="nilai_premi">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="biaya_materai" class="col-form-label">Biaya Materai</label>
                                            <input readonly value="{{ format_uang($data->biaya_materai) }}" type="text" class="form-control text-white bg-dark" id="biaya_materai">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="biaya_admin" class="col-form-label">Biaya Admin</label>
                                            <input readonly value="{{ format_uang($data->biaya_admin) }}" type="text" class="form-control text-white bg-dark" id="biaya_admin">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="total_payment" class="col-form-label">Total Pembayaran</label>
                                            <input readonly value="{{ format_uang($data->total_payment) }}" type="text" class="form-control text-white bg-dark" id="total_payment">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="status" class="col-form-label">Status Pembayaran</label>
                                            <input readonly value="Pembayaran Expired" type="text" class="form-control text-white bg-dark" id="status">
                                        </div>
                                    @elseif ($data['payment']->status == 1)
                                        <div class="col-md-3">
                                            <label for="nilai_premi" class="col-form-label">Nilai Premi</label>
                                            <input readonly value="{{ format_uang($data->nilai_premi) }}" type="text" class="form-control text-white bg-dark" id="nilai_premi">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="biaya_materai" class="col-form-label">Biaya Materai</label>
                                            <input readonly value="{{ format_uang($data->biaya_materai) }}" type="text" class="form-control text-white bg-dark" id="biaya_materai">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="biaya_admin" class="col-form-label">Biaya Admin</label>
                                            <input readonly value="{{ format_uang($data->biaya_admin) }}" type="text" class="form-control text-white bg-dark" id="biaya_admin">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="total_payment" class="col-form-label">Total Pembayaran</label>
                                            <input readonly value="{{ format_uang($data->total_payment) }}" type="text" class="form-control text-white bg-dark" id="total_payment">
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="status" class="col-form-label">Status Pembayaran</label>
                                            <input readonly value="Berhasil" type="text" class="form-control text-white bg-dark" id="status">
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="payment_method" class="col-form-label">Metode Pembayaran</label>
                                            <input readonly value="{{$data->payment->payment_method ?? '' }}" type="text" class="form-control text-white bg-dark"
                                                id="payment_method">
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="payment_id" class="col-form-label">No Pembayaran</label>
                                            <input readonly value="{{$data->payment->ipaymu_trx_id ?? '' }}" type="text" class="form-control text-white bg-dark"
                                                id="payment_id">
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="payment_date" class="col-form-label">Tanggal Pembayaran</label>
                                            <input readonly value="{{ tanggal_local($data->payment->updated_at) ?? '' }}" type="text" class="form-control text-white bg-dark"
                                                id="payment_date">
                                        </div>
                                    @elseif ($data['payment']->status == 0)
                                        <div class="col-md-3">
                                            <label for="nilai_premi" class="col-form-label">Nilai Premi</label>
                                            <input readonly value="{{ format_uang($data->nilai_premi) }}" type="text" class="form-control text-white bg-dark" id="nilai_premi">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="biaya_materai" class="col-form-label">Biaya Materai</label>
                                            <input readonly value="{{ format_uang($data->biaya_materai) }}" type="text" class="form-control text-white bg-dark" id="biaya_materai">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="biaya_admin" class="col-form-label">Biaya Admin</label>
                                            <input readonly value="{{ format_uang($data->biaya_admin) }}" type="text" class="form-control text-white bg-dark" id="biaya_admin">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="total_payment" class="col-form-label">Total Pembayaran</label>
                                            <input readonly value="{{ format_uang($data->total_payment) }}" type="text" class="form-control text-white bg-dark" id="total_payment">
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="status" class="col-form-label">Status Pembayaran</label>
                                            <input readonly value="Menunggu Pembayaran" type="text" class="form-control text-white bg-dark" id="status">
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="payment_method" class="col-form-label">Metode Pembayaran</label>
                                            <input readonly value="{{$data->payment->payment_method ?? '' }}" type="text" class="form-control text-white bg-dark"
                                                id="payment_method">
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="payment_id" class="col-form-label">No Pembayaran</label>
                                            <input readonly value="{{ $data->payment->ipaymu_trx_id ?? '' }}" type="text" class="form-control text-white bg-dark"
                                                id="payment_id">
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="payment_date" class="col-form-label">Tanggal Pembayaran</label>
                                            <input readonly value="{{ tanggal_local($data->payment->updated_at) ?? '' }}" type="text" class="form-control text-white bg-dark"
                                                id="payment_date">
                                        </div>                                        
                                    @endif
                                </form>
                                <div class="px-4">
                                    <hr>
                                </div>
                                <div class="row mb-3 px-4 mt-4">
                                    <div class="col-sm-5">
                                        <button onclick="history.back()" class="btn btn-warning btn-lg">Back</button>
                                        <a href="/dashboard/onlinetransaction/print/{{ $data->id }}" class="btn btn-primary btn-lg" style="margin-left: 5px;">Print</a>
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
        <script src="{{ asset('/back') }}/src/plugins/src/clipboard/clipboard.min.js"></script>
        <script src="{{ asset('/back') }}/src/plugins/src/clipboard/custom-clipboard.min.js"></script>
    @endpush

@endsection
