@extends('auth.layouts.app')
<!-- set title -->
@section('title')

@section('content')

    <div class="middle-content container-xxl p-0">
        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 ">
                <div class="usr-tasks ">
                    <div class="widget-content widget-content-area">
                        <h4 class="wallet-title">Notifikasi transaksi</h4>
                        <div class="table-responsive mt-4">
                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th class="text-center" width="6%">No</th>
                                        <th width="15%">Tanggal</th>
                                        <th width="25%">ID Transaksi</th>
                                        <th>Pesan</th>
                                    </tr>
                                    <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                </thead>
                                <tbody>
                                    @foreach ($notifications as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                                            <td>{{ $item->transaction->transaction_id }}</td>
                                            <td>{{ $item->notif_detail->message }}</td>
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