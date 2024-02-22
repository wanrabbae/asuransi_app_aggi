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
                                <a class="btn btn-primary" href="" role="button" data-bs-toggle="modal" data-bs-target="#addtargetModal">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>    
                                </a>
                            </div>
                            <!-- Modal Create -->
                            <div class="modal fade register-modal" id="addtargetModal" tabindex="-1" role="dialog" aria-labelledby="addtargetModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    
                                        <div class="modal-header mt-2" id="addtargetModalLabel">
                                            <h4 class="modal-title">Add New Target</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                        </div>
                                        <div class="modal-body">                                            
                                            <form method="POST" action="{{ route('dashboard.targetdata.store') }}" enctype="multipart/form-data" class="mt-0">
                                             @csrf
                                                <div class="form-group">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                                <input placeholder="Target Name" id="name" type="text" class="form-control mb-2 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                </div>
                                                <div class="form-group">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                                <input placeholder="Target 1" id="target_1" type="text" class="form-control mb-2" name="target_1" required>
                                                </div>
                                                <div class="form-group">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                                <input placeholder="Fee 1" id="percentage_1" type="text" class="form-control mb-2" name="percentage_1" required>
                                                </div>
                                                <div class="form-group">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                                <input placeholder="Target 2" id="target_2" type="text" class="form-control mb-2" name="target_2" required>
                                                </div>
                                                <div class="form-group">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                                <input placeholder="Fee 2" id="percentage_2" type="text" class="form-control mb-2" name="percentage_2" required>
                                                </div>
                                                <div class="form-group">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                                <input placeholder="Target 3" id="target_3" type="text" class="form-control mb-2" name="target_3" required>
                                                </div>
                                                <div class="form-group">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                                <input placeholder="Fee 3" id="percentage_3" type="text" class="form-control mb-2" name="percentage_3" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary mt-2 mb-2 w-100">Submit Data</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area br-8">
                                
                                <table id="crudTable" class="table table-striped dt-table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="6%">No</th>
                                            <th>Name</th>
                                            <th width="12%">Target 1</th>
                                            <th width="10%">Fee 1 (%)</th>
                                            <th width="12%">Target 2</th>
                                            <th width="10%">Fee 2 (%)</th>
                                            <th width="12%">Target 3 </th>
                                            <th width="10%">Fee 3 (%)</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $d)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $d->name }}</td>
                                            <td>{{ format_uang($d->target_1) }}</td>                                            
                                            <td>{{ $d->percentage_1 }}</td>
                                            <td>{{ format_uang($d->target_2) }}</td>                                            
                                            <td>{{ $d->percentage_2 }}</td>
                                            <td>{{ format_uang($d->target_3) }}</td>
                                            <td>{{ $d->percentage_3 }}</td>
                                            <td>
                                                <a class="btn btn-primary" href="" role="button" data-bs-toggle="modal" data-bs-target="#targeteditModal{{ $d->id }}">
                                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg> 
                                                </a>
                                            </td>                                            
                                        </tr>                                        
                                        
                                        <!-- Modal Edit -->
                                        <div class="modal fade register-modal" id="targeteditModal{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="targeteditModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                
                                                    <div class="modal-header mt-2" id="targeteditModalLabel">
                                                        <h4 class="modal-title">Edit Target - {{ $d->name }}</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('dashboard.targetdata.update',[$d->id]) }}" enctype="multipart/form-data" class="row g-3">
                                                        @csrf
                                                        @method('PUT')
                                                            <div class="form-group">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                                            <input placeholder="Target Name" id="name" type="text" class="form-control mb-2 @error('name') is-invalid @enderror" name="name" value="{{ $d->name }}" required autocomplete="name" autofocus>
                                                            @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                            </div>
                                                            <div class="form-group">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                                            <input placeholder="Target 1" id="target_1" type="text" class="form-control mb-2" name="target_1" value="{{ $d->target_1 }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                                            <input placeholder="Fee 1" id="percentage_1" type="text" class="form-control mb-2" name="percentage_1" value="{{ $d->percentage_1 }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                                            <input placeholder="Target 2" id="target_2" type="text" class="form-control mb-2" name="target_2" value="{{ $d->target_2 }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                                            <input placeholder="Fee 2" id="percentage_2" type="text" class="form-control mb-2" name="percentage_2" value="{{ $d->percentage_2 }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                                            <input placeholder="Target 3" id="target_3" type="text" class="form-control mb-2" name="target_3" value="{{ $d->target_3 }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                                            <input placeholder="Fee 3" id="percentage_3" type="text" class="form-control mb-2" name="percentage_3" value="{{ $d->percentage_3 }}" required>
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


@endsection