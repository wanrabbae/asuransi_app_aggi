@extends('auth.layouts.app')
<!-- set title -->
@section('title')

@section('content')

    <div class="middle-content container-xxl p-0">

        <div class="row layout-spacing ">

            <div id="flLoginForm" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Profil</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        @error('password')
                            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        <form method="POST" action="{{ route('dashboard.updateprofile', [Auth::user()->id]) }}" enctype="multipart/form-data" class="row g-3">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required autocomplete="none">
                            </div>
                            <div class="col-md-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input id="phone" type="number" class="form-control" name="phone" value="{{ Auth::user()->phone }}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="password" class="form-label">Password (Change Password)</label>
                                <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
                            </div>
                            <div class="col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input id="address" type="text" class="form-control" name="address" value="{{ Auth::user()->address }}" required autocomplete="none">
                            </div>
                            <div class="col-md-2">
                                <label for="city" class="form-label">City</label>
                                <input id="city" type="text" class="form-control" name="city" value="{{ Auth::user()->city }}" required>
                            </div>
                            <div class="col-md-2">
                                <label for="province" class="form-label">Province</label>
                                <input id="province" type="text" class="form-control" name="province" value="{{ Auth::user()->province }}" required>
                            </div>
                            <div class="col-md-2">
                                <label for="poscode" class="form-label">Zip</label>
                                <input id="poscode" type="number" class="form-control" name="poscode" value="{{ Auth::user()->poscode }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="bank" class="form-label">Bank</label>
                                <input id="bank" type="text" class="form-control" name="bank" value="{{ Auth::user()->bank }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="account_name" class="form-label">Account Name</label>
                                <input id="account_name" type="text" class="form-control" name="account_name" value="{{ Auth::user()->account_name }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="account_number" class="form-label">Account Number</label>
                                <input id="account_number" type="text" class="form-control" name="account_number" value="{{ Auth::user()->account_number }}" required>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Submit data</button>
                                <a class="btn btn-warning" href="{{ route('dashboard.profile') }}" role="button">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>


@endsection
