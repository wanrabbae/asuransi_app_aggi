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
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 mb-4">
                            
                            <div class="card h-100">
                                <div class="text-center p-4">
                                <img src="{{ asset('/img/landing/'.$d->icon) }}" height="150px" width="150px" class="card-img-top" alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title mb-3">{{ $d->name }}</h5>
                                    <ul>
                                        <li class="pricing__feature">Rate <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></span> {{ $d->rate }}</li>
                                        <li class="pricing__feature">Minimal Premi <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></span> {{ format_uang($d->min_price) }}</li>
                                        <li class="pricing__feature">maksimal Premi <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></span> {{ format_uang($d->max_price) }}</li>
                                        <li class="pricing__feature">Komisi <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></span> {{ $d->komisi }} %</li>
                                    </ul>
                                    <p >Benefit</p>
                                    <p>{!! $d->description !!}</p>
                                </div>
                                <a href="{{ route('dashboard.onlineproductdata.edit', [$d->id]) }}" class="btn btn-secondary m-4">Edit</a>
                                
                            </div>
                            
                        </div>
                        @endforeach

                        

                    </div>           

                </div>
            </div>
        </div>
    </div>



@endsection