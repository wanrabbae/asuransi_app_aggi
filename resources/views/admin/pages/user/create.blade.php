@extends('admin.layouts.app')
<!-- set title -->
@section('title')

@section('content')

                    <div class="row">
                        <div id="browser_default" class="col-lg-12 layout-spacing col-md-12 mt-4">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Add New Member</h4>
                                        </div>                 
                                    </div>
                                </div>
                               
                                <div class="widget-content widget-content-area p-4">
                                     @error('email')
                                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                        <strong>{{ $message }}</strong>
                                    </div>                                   
                                    @enderror

                                    @error('password')
                                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                        <strong>{{ $message }}</strong>
                                    </div>                         
                                    @enderror
                                    <form method="POST" action="{{ route('dashboard.userdata.store') }}" enctype="multipart/form-data" class="row g-3">
                                    @csrf
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Name</label>
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        </div>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="col-md-6">
                                            <label for="password" class="form-label">Password</label>
                                            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="password-confirm" class="form-label">Confirm  Password</label>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <button class="btn btn-primary" type="submit">Submit member</button>
                                            <a class="btn btn-warning" href="{{ route('dashboard.userdata.index') }}" role="button">Back</a>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>            


@endsection