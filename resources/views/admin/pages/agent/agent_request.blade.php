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
            @error('email')
                <div class="alert alert-light-danger alert-dismissible fade show border-0 mb-4" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-x close" data-bs-dismiss="alert">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button> <strong>Error!</strong> {{ $message }}.
                </div>
            @enderror
            @error('password')
                <div class="alert alert-light-danger alert-dismissible fade show border-0 mb-4" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-x close" data-bs-dismiss="alert">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button> <strong>Error!</strong> {{ $message }}.
                </div>
            @enderror
            <div class="widget-content widget-content-area br-8">
                @if(Auth::guard('admin')->user()->roles == 0)
                    <table id="crudTable" class="table table-striped dt-table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->email }}</td>
                                    <td>Mitra Request</td>
                                    <td>
                                        @if ($d->is_active == 1)
                                            Active
                                        @else
                                            Inactive
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('dashboard.userdata.editagentrequest', [$d->id]) }}" class="btn btn-outline-primary" title="Detail & Edit">
                                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                        </a>
                                        <a href="{{ route('dashboard.userdata.agent.request.reject', $d->id) }}" class="btn btn-outline-danger" title="Reject request">
                                            Reject
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                @elseif(Auth::guard('admin')->user()->roles == 3)
                    <table id="crudTable" class="table table-striped dt-table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->email }}</td>
                                    <td>Mitra Request</td>
                                    <td>
                                        @if ($d->is_active == 1)
                                            Active
                                        @else
                                            Inactive
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('dashboard.userdata.editagentrequest', [$d->id]) }}" class="btn btn-outline-primary" title="Detail & Approval">
                                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                        </a>
                                        <a href="{{ route('dashboard.userdata.agent.request.reject', $d->id) }}" class="btn btn-outline-danger" title="Reject Request">
                                            Reject
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                @endif

            </div>
        </div>

    </div>


@endsection
