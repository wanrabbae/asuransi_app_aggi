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
                        <form action="{{ route('dashboard.poindata.index.filter') }}" method="get">
                            <div class="row py-4 px-4">
                                <div class="col-xl-2 col-md-2 mb-4">
                                    <div class="form-group">
                                        <label for="date">Date From</label>
                                        <input id="start_date" type="date" name="start_date" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-2 mb-4">
                                    <div class="form-group">
                                        <label for="date">Date To</label>
                                        <input id="end_date" type="date" name="end_date" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-2 mb-4" style="margin-top: 30px;">
                                    <button id="searchBtn" type="submit" class="btn btn-primary btn-lg">
                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                            <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        </svg>
                                    </button>
                                    <a class="btn btn-outline-primary btn-lg" id="downloadBtn" style="margin-left: 5px;">
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
                                <div class="col-xl-3 col-md-3 mb-4">
                                    <div class="form-group">
                                        <label for="">Poins</label>
                                        <input readonly type="text" value="{{ format_uang($countData) }}" name="" class="form-control text-white bg-dark" placeholder="">
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-3 mb-4">
                                    <div class="form-group">
                                        <label for="">Total Poins</label>
                                        <input readonly type="text" value="{{ format_uang($countDataFilter) }}" name="" class="form-control text-white bg-dark" placeholder="">
                                    </div>
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
                            {{-- <th>Transaction id</th> --}}
                            <th>User</th>
                            {{-- <th>Produk</th> --}}
                            <th>Poin</th>
                            <th>Redeem</th>
                            <th>Sisa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ format_uang($item->total_commissions_peruser) }}</td>
                                <td>{{ format_uang($item->redeem_poins_peruser) }}</td>
                                <td>{{ format_uang($item->net_commissions_peruser) }}</td>
                            </tr>
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
                var url = "/dashboard/poindata/excel";
                var urlDownload = url + '?start_date=' + start_date + '&end_date=' + end_date;
                window.location.href = urlDownload;
                localStorage.clear();
            });
        </script>
    @endpush

@endsection
