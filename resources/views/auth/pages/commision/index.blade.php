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
                        <h4 class="wallet-title">Poinku</h4>
                        <div class="table-responsive mt-4">
                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th width="8%">No</th>
                                        <th>No Permintaan</th>
                                        <th width="25%">Jumlah Poin</th>
                                        <th width="20%">Tanggal</th>
                                        <th width="20%">Status</th>
                                    </tr>
                                    <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                </thead>
                                <tbody>
                                    @foreach ($redeemPoins as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->redeem_code }}</td>
                                            <td>{{ number_format($item->redeem_amount ?? 0, 0, ',', '.') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                                            <td>{{ $item->redeem_status }}</td>
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
