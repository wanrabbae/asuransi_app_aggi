@extends('auth.layouts.app')
<!-- set title -->
@section('title')

    @push('after-style')
        <link rel="stylesheet" type="text/css" href="{{ asset('/back') }}/src/plugins/src/table/datatable/datatables.css">
    @endpush

@section('content')

    <div class="middle-content container-xxl p-0">
        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 ">
                <div class="usr-tasks ">

                    <div class="widget-content widget-content-area">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="nasabah" class="form-label">Total Nasabah</label>
                                <input readonly type="text" name="name" value="{{ $getJumlahAllNasabahByAgentReferalCode }}" class="form-control" id="nasabah">
                            </div>
                            <div class="col-md-4">
                                <label for="online" class="form-label">Total Online Premi</label>
                                <input readonly type="text" name="text" value="{{ format_uang($sumTransactionByNasabahAgentOnline) }}" class="form-control" id="online">
                            </div>
                            <div class="col-md-4">
                                <label for="offline" class="form-label">Total Offline Premi</label>
                                <input readonly type="text" name="offline" value="{{ format_uang($sumTransactionByNasabahAgentOffline) }}" class="form-control" id="offline">
                            </div>
                        </div>
                    </div>

                    <div class="widget-content widget-content-area mt-4">
                        <h4 class="wallet-title">Data Nasabah</h4>
                        <div class="table-responsive mt-4">
                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Transaction id</th>
                                        <th>Kategori</th>
                                        <th>Produk</th>
                                        <th>Nasabah</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Nilai</th>
                                    </tr>
                                    <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactionByNasabahAgent as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->transaction_id }}</td>
                                            <td></td>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                                            <td>{{ format_uang($item->total_payment) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
