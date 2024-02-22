@extends('auth.layouts.app')
<!-- set title -->
@section('title')

@section('content')

    <div class="middle-content container-xxl p-0">
        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 ">

                <div class="row gx-md-5 gy-5 text-center">
                    @foreach ($offlineproduct as $d)
                        <div class="col-md-6 col-xl-3">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <img src="{{ asset('/img/landing/' . $d->icon) }}" class="svg-inject icon-svg icon-svg-md text-yellow mb-3" alt="" />
                                    <h6>{{ $d->name }}</h6>
                                    <a href="{{ asset('dashboard/user/belibaruoffline/' . $d->slug) }}" class="btn btn-secondary more hover link-yellow">beli</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


            </div>

        </div>
    </div>


@endsection
