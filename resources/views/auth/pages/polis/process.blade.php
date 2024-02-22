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
                        <h4 class="wallet-title">Polis Diproses</h4>
                        <div class="table-responsive mt-4">
                            <table class="table table-bordered">

                                <thead>
                                    <tr class="text-center">
                                        <th width="5%">No</th>
                                        <th width="20%">Nama Produk</th>
                                        <th>No Transaksi</th>
                                        <th width="18%">Tanggal Pembelian</th>
                                        <th width="18%">Tanggal Jatuh Tempo</th>
                                        <th width="15%">Status</th>
                                        <th width="10%">Aksi</th>
                                    </tr>
                                    <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                </thead>
                                <tbody>
                                    @foreach ($polises as $item)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->transaction_id }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->jatuh_tempo)->format('d F Y') }}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                    Request
                                                @elseif($item->status == 2)
                                                    Pending
                                                @elseif($item->status == 3)
                                                    Paid
                                                @elseif($item->status == 4)
                                                    Process
                                                @elseif($item->status == 5)
                                                    Completed
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('dashboard.polis.show', [$item->id]) }}" class="btn btn-success btn-sm">Detail</a>
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
