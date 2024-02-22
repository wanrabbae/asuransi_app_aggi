@extends('admin.layouts.app')
<!-- set title -->
@section('title')

@push('after-style')
    <link href="{{ asset('/back') }}/src/assets/css/light/components/media_object.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('/back') }}/src/assets/css/dark/components/media_object.css" rel="stylesheet" type="text/css">
@endpush

@section('content')

    <div class="row">
        <div class="col-lg-12 layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow" >
                <div class="widget-content widget-content-area br-8 py-4">
                    
                    <div class="row">
                        
                        @foreach ($data as $d)
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 mb-4">
                            <div class="card">
                                <img src="{{ asset('/img/landing/'.$d->icon) }}" class="img-thumbnail card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <p class="card-text">{{ $d->name }}</p>
                                    <p class="card-text"> @if($d->status_product==1)
                                                    Active
                                                @elseif($d->status_product==2)
                                                    Inactive
                                                @endif</p>
                                    <a href="{{ route('dashboard.offlineproductdata.edit', [$d->id]) }}" class="btn btn-secondary mt-3 d-md-block">Edit</a>
                                </div>
                            </div>                            
                        </div>
                        @endforeach
                    </div>           

                </div>
            </div>
        </div>
    </div>



@endsection