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
                                        <input readonly value="{{  $data['product']->name }}" type="text" class="form-control text-white bg-dark" id="status_bangunan">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="nilai_bangunan" class="col-form-label">No Transaksi</label>
                                        <input readonly value="{{ $data['transaction_id'] }}" type="text" class="form-control text-white bg-dark" id="nilai_bangunan">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="nilai_lainnya" class="col-form-label">Tanggal Tansaksi</label>
                                        <input readonly value="{{ tanggal_local($data->created_at) ?? '' }}" type="text" class="form-control text-white bg-dark" id="nilai_lainnya">
                                    </div>
                                    @if ($data->no_polis != null)
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
                                    <h5 class="mt-2">Informasi Pembayaran</h5>
                                    <hr>
                                </div>
                                <form class="row g-3 px-4">
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
                                    @if ($data['payment']->status == 3)
                                        <div class="col-md-3 mb-4">
                                            <label for="status" class="col-form-label">Status Pembayaran</label>
                                            <input readonly
                                                value="@if ($data->status == 1) Request
                                        @elseif($data->status == 2) Pending 
                                        @elseif($data->status == 3) Paid 
                                        @elseif($data->status == 4) Process 
                                        @elseif($data->status == 5) Completed 
                                        @elseif($data->status_offline == 1) Request 
                                        @elseif($data->status_offline == 2) Followup 
                                        @elseif($data->status_offline == 3) Payment 
                                        @elseif($data->status_offline == 4) Paid 
                                        @elseif($data->status_offline == 5) Process 
                                        @elseif($data->status_offline == 6) Completed 
                                        @endif"
                                                type="text" class="form-control text-white bg-dark" id="status">
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="payment_method" class="col-form-label">Metode Pembayaran</label>
                                            <input readonly type="text" class="form-control text-white bg-dark" id="payment_method">
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="payment_id" class="col-form-label">No Pembayaran</label>
                                            <input readonly value="{{ $data->payment->id ?? '' }}" type="text" class="form-control text-white bg-dark" id="payment_id">
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="payment_date" class="col-form-label">Tanggal Pembayaran</label>
                                            <input readonly value="{{ tanggal_local($data->payment->updated_at) ?? '' }}" type="text" class="form-control text-white bg-dark" id="payment_date">
                                        </div>
                                    @elseif ($data['payment']->ipaymu_trx_id != null)
                                        <div class="col-md-3 mb-4">
                                            <label for="status" class="col-form-label">Status Pembayaran</label>
                                            <input readonly
                                                value="@if ($data->status == 1) Request
                                        @elseif($data->status == 2) Pending 
                                        @elseif($data->status == 3) Paid 
                                        @elseif($data->status == 4) Process 
                                        @elseif($data->status == 5) Completed 
                                        @elseif($data->status_offline == 1) Request 
                                        @elseif($data->status_offline == 2) Followup 
                                        @elseif($data->status_offline == 3) Payment 
                                        @elseif($data->status_offline == 4) Paid 
                                        @elseif($data->status_offline == 5) Process 
                                        @elseif($data->status_offline == 6) Completed 
                                        @endif"
                                                type="text" class="form-control text-white bg-dark" id="status">
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="payment_method" class="col-form-label">Metode Pembayaran</label>
                                            <input readonly value="{{ $data->payment->payment_method ?? '' }}" type="text" class="form-control text-white bg-dark" id="payment_method">
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="payment_id" class="col-form-label">No Pembayaran</label>
                                            <input readonly value="{{ $data->payment->ipaymu_trx_id ?? '' }}" type="text" class="form-control text-white bg-dark" id="payment_id">
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="payment_date" class="col-form-label">Tanggal Pembayarn</label>
                                            <input readonly value="{{ tanggal_local($data->payment->updated_at) ?? '' }}" type="text" class="form-control text-white bg-dark" id="payment_date">
                                        </div>
                                    @elseif ($data['payment']->status == 1)
                                        <div class="col-md-3 mb-4">
                                            <label for="status" class="col-form-label">Status Pembayaran</label>
                                            <input readonly
                                                value="@if ($data->status == 1) Request
                                        @elseif($data->status == 2) Pending 
                                        @elseif($data->status == 3) Paid 
                                        @elseif($data->status == 4) Process 
                                        @elseif($data->status == 5) Completed 
                                        @elseif($data->status_offline == 1) Request 
                                        @elseif($data->status_offline == 2) Followup 
                                        @elseif($data->status_offline == 3) Payment 
                                        @elseif($data->status_offline == 4) Paid 
                                        @elseif($data->status_offline == 5) Process 
                                        @elseif($data->status_offline == 6) Completed 
                                        @endif"
                                                type="text" class="form-control text-white bg-dark" id="status">
                                        </div>
                                        <div class="col-md-9 mb-4">
                                            <label for="payment_method" class="col-form-label">Link Pembayaran</label>
                                            <input readonly value="{{ $data->payment->url_payment ?? '' }}" type="text" class="form-control text-white bg-dark" id="payment_method">
                                        </div>
                                    @elseif ($data['payment']->status == 2)
                                        <div class="col-md-6 mb-4">
                                            <label for="status" class="col-form-label">Status Pembayaran</label>
                                            <input readonly
                                                value="@if ($data->status == 1) Request
                                        @elseif($data->status == 2) Pending 
                                        @elseif($data->status == 3) Paid 
                                        @elseif($data->status == 4) Process 
                                        @elseif($data->status == 5) Completed 
                                        @elseif($data->status_offline == 1) Request 
                                        @elseif($data->status_offline == 2) Followup 
                                        @elseif($data->status_offline == 3) Payment 
                                        @elseif($data->status_offline == 4) Paid 
                                        @elseif($data->status_offline == 5) Process 
                                        @elseif($data->status_offline == 6) Completed 
                                        @endif"
                                                type="text" class="form-control text-white bg-dark" id="status">
                                        </div>
                                        <div class="col-md-9 mb-4">
                                            <label for="payment_method" class="col-form-label">Link Pembayaran</label>
                                            <input readonly value="{{ $data->payment->url_payment ?? '' }}" type="text" class="form-control text-white bg-dark" id="payment_method">
                                        </div>
                                    @endif
                                </form>
                                <div class="px-4">
                                    <hr>
                                </div>
                                <div class="row mb-3 px-4 mt-4">
                                    <div class="col-sm-5">
                                        <button onclick="history.back()" class="btn btn-warning btn-lg">Back</button>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
