@extends('admin.layouts.app')
<!-- set title -->
@section('title')

    @push('after-style')
        <link href="{{ asset('/back') }}/src/plugins/src/apex/apexcharts.css" rel="stylesheet" type="text/css">
        <link href="{{ asset('/back') }}/src/assets/css/light/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/back') }}/src/assets/css/dark/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    @endpush

@section('content')

    <div class="middle-content container-xxl p-0">
        <div class="row layout-top-spacing">

            <div id="flLoginForm" class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="statbox widget box box-shadow">
                    @if ($errors->any())
                        <div class="alert alert-danger bg-danger p-2 text-white" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li style="">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success bg-success p-2 text-white" role="alert">{{ Session::get('success') }}</div>
                    @endif
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Update Profil</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <form method="POST" action="{{ route('dashboard.admin_updateprofile') }}" class="row g-3">
                            @csrf
                            @method('PUT')
                            <div class="col-md-12">
                                <label for="name" class="form-label">Nama</label>
                                <input required type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" id="name" autocomplete="name">
                            </div>
                            <div class="col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input required type="email" name="email" value="{{ Auth::user()->email }}" class="form-control" id="email" autocomplete="email">
                            </div>
                            <div class="col-md-12">
                                <label for="password" class="form-label">Password Baru <span style="font-size: 9px; color:red;">(isi jika ingin diganti)</span></label>
                                <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
                            </div>
                            <div class="col-12 mt-4">
                                <a href="" class="btn btn-outline-primary mb-2" data-bs-toggle="modal" data-bs-target="#submitdModal">
                                    Update Profil
                                </a>
                            </div>
                            <!-- Modal Update data  -->
                            <div class="modal fade modal-notification" id="submitdModal" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
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
                                            <p class="modal-text">Simpan perubahan data ?</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-denger" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('after-script')
        <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
        <script src="{{ asset('/back') }}/src/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- END GLOBAL MANDATORY SCRIPTS -->
    @endpush

@endsection
