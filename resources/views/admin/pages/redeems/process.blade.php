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

                    <div class="widget-content widget-content-area">
                        <form action="{{ route('dashboard.redeemdata.process.Filter') }}" method="get">
                            <div class="row py-4 px-4">
                                <div class="col-xl-3 col-md-3 mb-4">
                                    <div class="form-group">
                                        <label for="date">Date From</label>
                                        <input id="start_date" type="date" name="start_date" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-3 mb-4">
                                    <div class="form-group">
                                        <label for="date">Date To</label>
                                        <input id="end_date" type="date" name="end_date" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-3" style="margin-top: 30px;">
                                    <button type="submit" id="searchBtn" class="btn btn-primary btn-lg">
                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                            <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        </svg>
                                    </button>
                                    <a id="submitCheck" class="btn btn-success btn-lg" style="margin-left: 5px;" id="submitCheck">Submit</a>
                                </div>
                                <div class="col-xl-3 col-md-3 mb-4">
                                    <div class="form-group">
                                        <label for="">Total Process</label>
                                        <input readonly type="text" value="{{ $countData }}" name="" class="form-control text-white bg-dark" placeholder="">
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
                            <th scope="col" width="5%">
                                <div class="form-check form-check-primary">
                                    <input class="form-check-input" id="checkbox_parent_all" type="checkbox">
                                </div>
                            </th>
                            <th>Nama User</th>
                            <th>Redeem Code</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Action</th>
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
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->redeem_code }}</td>
                                <td>{{ $item->redeem_amount }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->redeem_request_date)->format('d F Y') }}</td>
                                <td>{{ $item->redeem_status }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        {{-- @foreach ($data as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->email }}</td>
                            <td>
                                @if ($d->roles == 0)
                                    Agent
                                @elseif($d->roles == 1)
                                    Member
                                @endif
                            </td>
                            <td>
                                @if ($d->is_active == 1)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('dashboard.userdata.edit', [$d->id]) }}" class="btn btn-outline-primary">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                    </svg>
                                </a>
                                <a href="" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deletedModal{{ $d->id }}">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        <!-- Modal delete -->
                        <div class="modal fade modal-notification" id="deletedModal{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document" id="standardModalLabel">
                                <div class="modal-content">
                                    <div class="modal-body text-center">
                                        <div class="icon-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                            </svg>
                                        </div>
                                        <p class="modal-text">Are you sure you want to delete this Member - {{ $d->name }} ?</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Discard</button>
                                        <form action="{{ route('dashboard.userdata.destroy', [$d->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn" data-bs-dismiss="modal"><i class="flaticon-cancel-12"></i> Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach --}}

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    @push('after-script')
        <script>
            var downloadBtn = document.getElementById('downloadBtn');
            var searchBtn = document.getElementById('searchBtn');

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
                var url = "/dashboard/redeemdata/process/submit";
                var urlDownload = url + '?checkbox_child_value=' + checkbox_child_value;
                window.location.href = urlDownload;
            });

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
                var url = "/dashboard/redeemdata/process/excel";
                var urlDownload = url + '?start_date=' + start_date + '&end_date=' + end_date;
                window.location.href = urlDownload;
                localStorage.clear();
            });
        </script>
    @endpush

@endsection
