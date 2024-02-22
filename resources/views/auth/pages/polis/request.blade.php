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
                        <h4 class="wallet-title">Polis Dipesan</h4>
                        <div class="table-responsive mt-4">
                            <table class="table table-bordered">

                                <thead>
                                    <tr class="text-center">
                                        <th width="5%">No</th>
                                        <th width="20%">Nama Produk</th>
                                        <th>No Transaksi</th>
                                        <th>Total Pembayaran</th>
                                        <th width="15%">Tanggal Pembelian</th>
                                        <th width="10%">Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                </thead>
                                <tbody>
                                    @foreach ($polises as $item)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->transaction_id }}</td>
                                            <td>{{ format_uang($item->total_payment) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                                            <td>
                                                @if ($item->payment && $item->payment->expired <= \Carbon\Carbon::now())
                                                    Expired
                                                @else
                                                    Di pesan
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('dashboard.polis.show', [$item->id]) }}" class="btn btn-outline-primary">
                                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round" class="css-i6dzq1">
                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                    </svg>
                                                </a>
                                                @if ($item->payment && $item->payment->expired <= \Carbon\Carbon::now())
                                                    <a target="_blank" href="{{ $item->payment->url_payment }}" class="btn btn-success btn-sm">Payment Link</a>
                                                @elseif($item->payment && $item->payment->expired >= \Carbon\Carbon::now())
                                                    <a href="{{ route('dashboard.polis.show', [$item->id]) }}" class="btn btn-outline-primary">
                                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round" class="css-i6dzq1">
                                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                        </svg>
                                                    </a>
                                                @endif
                                            </td>
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
