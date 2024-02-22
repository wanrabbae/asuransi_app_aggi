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
                        <h4 class="wallet-title">Polis Aktif</h4>
                        <div class="table-responsive mt-4">
                            <table class="table table-bordered">

                                <thead>
                                    <tr class="text-center">
                                        <th width="5%">No</th>
                                        <th>Nama Produk</th>
                                        <th width="18%">Status</th>
                                        <th width="18%">Tanggal Permintaan</th>
                                        <th width="10%">Aksi</th>
                                    </tr>
                                    <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                </thead>
                                <tbody>
                                    @foreach ($polises as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->product->name }}</td>
                                            <td class="text-center">
                                                @if ($item->payment && $item->payment->expired <= \Carbon\Carbon::now())
                                                    Expired
                                                @elseif ($item->status == 1)
                                                    Request
                                                @elseif($item->status == 3)
                                                    Paid
                                                @elseif($item->status == 4)
                                                    Process
                                                @elseif($item->status == 5)
                                                    Completed
                                                @elseif ($item->payment && $item->payment->expired >= \Carbon\Carbon::now())
                                                    Pending
                                                @else
                                                    Expired
                                                @endif
                                            </td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                                            <td class="text-center">
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
