@extends('admin.layouts.app')
<!-- set title -->
@section('title')

    @push('after-style')
        <link rel="stylesheet" type="text/css" href="{{ asset('/back/src/plugins/css/light/table/datatable/dt-global_style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/back/src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
    @endpush

@section('content')
    <div class="row seperator-header layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area br-8">
                        <form action="{{ route('dashboard.onlinetransaction.complete.filter') }}" method="get">
                            <div class="row py-4 px-4">
                                <div class="col-xl-3 mb-4">
                                    <div class="form-group">
                                        <label for="start_date">Date From</label>
                                        <input id="start_date" type="date" name="start_date" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-xl-3 mb-4">
                                    <div class="form-group">
                                        <label for="end_date">Date To</label>
                                        <input id="end_date" type="date" name="end_date" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-xl-3" style="margin-top: 30px;">
                                    <button type="submit" id="searchBtn" class="btn btn-primary btn-lg">
                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                            <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        </svg>
                                    </button>
                                    <a id="downloadBtn" class="btn btn-outline-primary btn-lg" style="margin-left: 5px;">
                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                            class="css-i6dzq1">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                            <line x1="16" y1="13" x2="8" y2="13"></line>
                                            <line x1="16" y1="17" x2="8" y2="17"></line>
                                            <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="widget-content widget-content-area br-8">

                <table id="crudTable" class="table table-striped dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Polis</th>
                            <th>Kode Pesanan</th>
                            <th>Produk</th>
                            <th>Jatuh Tempo</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->no_polis }}</td>
                                <td>{{ $item->transaction_id }}</td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->jatuh_tempo)->format('d F Y') }}</td>
                                <td>
                                    <a href="{{ route('dashboard.onlinetransaction.show', [$item->id]) }}" class="btn btn-outline-primary" title="Detail Data">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </a>
                                    <a href="/dashboard/onlinetransaction/polis/download/{{ $item->id }}" class="btn btn-outline-warning" title="Unduh Polis">
                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                            class="css-i6dzq1">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                            <polyline points="7 10 12 15 17 10"></polyline>
                                            <line x1="12" y1="15" x2="12" y2="3"></line>
                                        </svg>
                                    </a>
                                    <a href="/dashboard/onlinetransaction/premi/download/{{ $item->id }}" class="btn btn-outline-danger" title="Unduh Nota Premi">
                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                            class="css-i6dzq1">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                            <polyline points="7 10 12 15 17 10"></polyline>
                                            <line x1="12" y1="15" x2="12" y2="3"></line>
                                        </svg>
                                    </a>
                                    @if ($item->nota_komisi != null)
                                    <a href="/dashboard/onlinetransaction/komisi/download/{{ $item->id }}" class="btn btn-outline-success" title="Unduh Nota Komisi">
                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                            class="css-i6dzq1">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                            <polyline points="7 10 12 15 17 10"></polyline>
                                            <line x1="12" y1="15" x2="12" y2="3"></line>
                                        </svg>
                                    </a>
                                    @endif
                                    @if (Auth::guard('admin')->user()->roles != 2)
                                    <a class="btn btn-outline-secondary" href="" role="button" data-bs-toggle="modal" data-bs-target="#onlinetrxeditModal{{ $item->id }}" title="Revisi Polis">
                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                            class="css-i6dzq1">
                                            <polyline points="21 8 21 21 3 21 3 8"></polyline>
                                            <rect x="1" y="3" width="22" height="5"></rect>
                                            <line x1="10" y1="12" x2="14" y2="12"></line>
                                        </svg>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            <!-- Modal revisi -->
                            <div class="modal fade register-modal" id="onlinetrxeditModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="onlinetrxeditModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">

                                        <div class="modal-header mt-2" id="onlinetrxeditModalLabel">
                                            <h4 class="modal-title">Revisi Polis - {{ $item->nasabah_name }}</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" class="feather feather-x">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('dashboard.onlinetransaction.revisipolis', [$item->id]) }}" enctype="multipart/form-data" class="row g-3">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                                        <polyline points="9 18 15 12 9 6"></polyline>
                                                    </svg>
                                                    <input placeholder="No Polis" id="no_polis" type="text" class="form-control mb-2" name="no_polis" value="{{ $item->no_polis }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                                        <polyline points="9 18 15 12 9 6"></polyline>
                                                    </svg>
                                                    <input placeholder="Polis" id="polis" type="file" class="form-control mb-2" name="polis" value="{{ $item->polis }}" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary mt-2 mb-2 w-100">Submit Data</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>

    </div>

    @push('after-script')
        <script>
            var downloadBtn = document.getElementById('downloadBtn');
            var searchBtn = document.getElementById('searchBtn');

            searchBtn.addEventListener('click', function() {
                var start_date = document.getElementById('start_date').value;
                var end_date = document.getElementById('end_date').value;
                localStorage.setItem('start_date', start_date);
                localStorage.setItem('end_date', end_date);
                console.log("test tost");
            })

            downloadBtn.addEventListener('click', function() {
                var start_date = localStorage.getItem('start_date');
                var end_date = localStorage.getItem('end_date');
                var url = "/dashboard/onlinetransaction/complete/excel";
                var urlDownload = url + '?start_date=' + start_date + '&end_date=' + end_date;
                window.location.href = urlDownload;
            });
        </script>
    @endpush

@endsection
