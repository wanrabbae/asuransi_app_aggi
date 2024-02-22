@extends('admin.layouts.app')
<!-- set title -->
@section('title')

@push('after-style')
    <link rel="stylesheet" type="text/css" href="{{ asset ('/back/src/plugins/css/light/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('/back/src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
@endpush

@section('content')

                    <div class="row seperator-header layout-top-spacing">
                    
                        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                            <div class="d-flex justify-content-sm-end justify-content-center mb-2">
                                <a class="btn btn-primary" href="{{ route('dashboard.userdata.createagent') }}" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                                </a>
                            </div> 
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
                                                @if($d->roles==0)
                                                <td>{{ $d->name }} - ({{ $d->agent_code }})</td>
                                                @else
                                                <td>{{ $d->name }} - </td>
                                                @endif 
                                                <td>{{ $d->email }}</td>
                                                <td>
                                                    @if($d->roles==0)
                                                        Mitra
                                                    @elseif($d->roles==1)
                                                        Member
                                                    @elseif($d->roles==2)
                                                        Affliator
                                                    @elseif($d->roles==3)
                                                        Affliator
                                                    @endif                                                
                                                </td>
                                                <td>
                                                    @if($d->is_active == 1)
                                                        Active
                                                    @else
                                                        Inactive
                                                    @endif                                                
                                                </td>
                                                
                                                <td>
                                                    <a href="{{ route('dashboard.userdata.editagent', [$d->id]) }}" class="btn btn-outline-primary" title="Detail & Edit">
                                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                    </a>
                                                    <a href="{{ route('dashboard.userdata.nasabahagent', [$d->id]) }}" class="btn btn-outline-warning" title="Data Transaksi">
                                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                                                    </a>
                                                    <a href="{{ route('dashboard.userdata.datanasabahagent', [$d->id]) }}" class="btn btn-outline-success" title="Data Nasabah">
                                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
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
                                                @if($d->roles==0)
                                                <td>{{ $d->name }} - ({{ $d->agent_code }})</td>
                                                @else
                                                <td>{{ $d->name }} - </td>
                                                @endif 
                                                <td>{{ $d->email }}</td>
                                                <td>
                                                    @if($d->roles==0)
                                                        Mitra
                                                    @elseif($d->roles==1)
                                                        Member
                                                    @elseif($d->roles==2)
                                                        Affliator
                                                    @elseif($d->roles==3)
                                                        Affliator
                                                    @endif                                                
                                                </td>
                                                <td>
                                                    @if($d->is_active == 1)
                                                        Active
                                                    @else
                                                        Inactive
                                                    @endif                                                
                                                </td>                                                
                                                <td>
                                                    <a href="{{ route('dashboard.userdata.show', [$d->id]) }}" class="btn btn-outline-primary" title="Detail">
                                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                                    </a>
                                                    <a href="{{ route('dashboard.userdata.nasabahagent', [$d->id]) }}" class="btn btn-outline-warning" title="Data Transaksi">
                                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                                                    </a>
                                                    <a href="{{ route('dashboard.userdata.datanasabahagent', [$d->id]) }}" class="btn btn-outline-success" title="Data Nasabah">
                                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
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