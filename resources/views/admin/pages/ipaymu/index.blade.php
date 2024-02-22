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
            <div class="card">
                <div class="card-header">
                    <h5>Ipaymu Configuration</h5>
                </div>
                <div class="card-body">
                    <form action="/dashboard/ipaymu/store" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="apikey">Ipaymu API Key</label>
                            <input type="text" name="apikey" class="form-control" id="apikey" placeholder="API Key" value="{{ $data['ipaymu_key'] }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="vaNumber">Ipaymu VA Number</label>
                            <input type="text" name="vaNumber" class="form-control" id="vaNumber" placeholder="API Key" value="{{ $data['ipaymu_va'] }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="ipaymu_url">Ipaymu URL</label>
                            <input type="text" name="ipaymu_url" class="form-control" id="ipaymu_url" placeholder="API Key" value="{{ $data['ipaymu_url'] }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="ipaymu_callback_url">Ipaymu Callback URL</label>
                            <input type="text" name="ipaymu_callback_url" class="form-control" id="ipaymu_callback_url" placeholder="API Key" value="{{ $data['ipaymu_callback'] }}">
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>


@endsection
