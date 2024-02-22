@extends('admin.layouts.app')
<!-- set title -->
@section('title')

@section('content')

    <div class="row">
        <div id="browser_default" class="col-lg-12 layout-spacing col-md-6 mt-4">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Detail Data Admin - {{ $data->name }}</h4>
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
                    <form method="POST" action="{{ route('dashboard.userdata.updateadmin', [$data->id]) }}" enctype="multipart/form-data" class="row g-3">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $data->name }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ $data->email }}" required autocomplete="email">
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="col-md-6">
                            <label for="roles" class="form-label">Level</label>
                            <select class="form-control" id="roles" name="roles" type="text">
                                <option value="{{ $data->roles }}">
                                    @if ($data->roles == 1)
                                        Admin Staff
                                    @elseif($data->roles == 2)
                                        Finance
                                    @elseif($data->roles == 3)
                                        Under Writing
                                    @endif
                                </option>
                                <option disabled>----------</option>
                                <option value="1">Admin Staff</option>
                                <option value="2">Finance</option>
                                <option value="3">Under Writing</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password (Change Password)</label>
                            <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                            <a class="btn btn-warning" href="{{ route('dashboard.userdata.admin') }}" role="button">Back</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


@endsection
