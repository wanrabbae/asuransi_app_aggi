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
                        <form action="{{ route('dashboard.offlinetransaction.paid.filter') }}" method="get">
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
                                <div class="col-xl-4" style="margin-top: 30px;">
                                    <button type="submit" id="searchBtn" class="btn btn-primary btn-lg">
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
                                    <a class="btn btn-success btn-lg" style="margin-left: 5px;" id="submitCheck">Submit</a>

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
                            <th scope="col" width="5%">
                                <div class="form-check form-check-primary">
                                    <input class="form-check-input" id="checkbox_parent_all" type="checkbox">
                                </div>
                            </th>
                            <th>Kode Pesanan</th>
                            <th>Produk</th>
                            <th>Tanggal Pembelian</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="form-check form-check-primary">
                                        <input class="form-check-input checkbox_child" value="{{ $item->id }}" type="checkbox">
                                    </div>
                                </td>
                                <td>{{ $item->transaction_id }}</td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->payment->updated_at)->format('d F Y') }}</td>
                                <td>
                                    <a href="{{ route('dashboard.offlinetransaction.show', [$item->id]) }}" class="btn btn-outline-primary">
                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                            class="css-i6dzq1">
                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>

    </div>

    @push('after-script')
        <script>
            checkall('checkbox_parent_all', 'checkbox_child');
            checkall('hover_parent_all', 'hover_child');
            checkall('striped_parent_all', 'striped_child');
            checkall('bordered_parent_all', 'bordered_child');
            checkall('mixed_parent_all', 'mixed_child');
            checkall('noSpacing_parent_all', 'noSpacing_child');
            checkall('custom_mixed_parent_all', 'custom_mixed_child');

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
                var url = "/dashboard/offlinetransaction/paid/excel";
                var urlDownload = url + '?start_date=' + start_date + '&end_date=' + end_date;
                window.location.href = urlDownload;
                localStorage.clear();
            });
            var submitCheck = document.getElementById('submitCheck');
            submitCheck.addEventListener('click', function() {
                var checkbox_child = document.getElementsByClassName('checkbox_child');
                var checkbox_child_value = [];
                for (var i = 0; i < checkbox_child.length; i++) {
                    if (checkbox_child[i].checked) {
                        checkbox_child_value.push(checkbox_child[i].value);
                    }
                }
                console.log(checkbox_child_value);
                var url = "/dashboard/offlinetransaction/paid/submit";
                var urlDownload = url + '?checkbox_child_value=' + checkbox_child_value;
                window.location.href = urlDownload;
            });
        </script>
    @endpush

@endsection
