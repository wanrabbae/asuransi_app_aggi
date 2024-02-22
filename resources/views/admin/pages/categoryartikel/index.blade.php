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
                                <a class="btn btn-primary" href="" role="button" data-bs-toggle="modal" data-bs-target="#categoryartikelModal">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>    
                                </a>
                            </div>
                            <!-- Modal Create -->
                            <div class="modal fade register-modal" id="categoryartikelModal" tabindex="-1" role="dialog" aria-labelledby="categoryartikelModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    
                                        <div class="modal-header mt-2" id="categoryartikelModalLabel">
                                            <h4 class="modal-title">Add New Category</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                        </div>
                                        <div class="modal-body">                                            
                                            <form method="POST" action="{{ route('dashboard.categoryartikeldata.store') }}" enctype="multipart/form-data" class="mt-0">
                                             @csrf
                                                <div class="form-group">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                                <input placeholder="Categoory Name" id="name" type="text" class="form-control mb-2 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
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
                                            <th>No</th>
                                            <th width="70%">Name</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $d)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $d->name }}</td>                                            
                                            <td>
                                                <!-- <a href="{{ route('dashboard.categoryartikeldata.edit', [$d->id]) }}" class="btn btn-outline-primary">
                                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                </a> -->
                                                <a class="btn btn-primary" href="" role="button" data-bs-toggle="modal" data-bs-target="#categoryartikeleditModal{{ $d->id }}">
                                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg> 
                                                </a>
                                                <a href="" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#categooryartikeldeletedModal{{ $d->id }}">
                                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>    
                                                </a>
                                            </td>                                            
                                        </tr>                                        
                                        <!-- Modal delete -->
                                        <div class="modal fade modal-notification" id="categooryartikeldeletedModal{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document" id="standardModalLabel">
                                                <div class="modal-content">
                                                <div class="modal-body text-center">
                                                    <div class="icon-content">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                                                    </div>
                                                    <p class="modal-text">Are you sure you want to delete this category - {{ $d->name }} ?</p>
                                                </div>
                                                <div class="modal-footer justify-content-between">                                                    
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Discard</button>
                                                    <form action="{{ route('dashboard.categoryartikeldata.destroy', [$d->id] )}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn" data-bs-dismiss="modal"><i class="flaticon-cancel-12"></i> Delete</button>
                                                    </form>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Create -->
                                        <div class="modal fade register-modal" id="categoryartikeleditModal{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="categoryartikeleditModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                
                                                    <div class="modal-header mt-2" id="categoryartikeleditModalLabel">
                                                        <h4 class="modal-title">Edit Category - {{ $d->name }}</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('dashboard.categoryartikeldata.update',[$d->id]) }}" enctype="multipart/form-data" class="row g-3">
                                                        @csrf
                                                        @method('PUT')
                                                            <div class="form-group">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                                            <input placeholder="Categoory Name" id="name" type="text" class="form-control mb-2 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                            @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
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