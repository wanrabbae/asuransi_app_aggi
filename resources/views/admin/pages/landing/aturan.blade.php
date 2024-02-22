@extends('admin.layouts.app')
<!-- set title -->
@section('title')


@section('content')

                    <div class="account-settings-container layout-top-spacing">
    
                        <div class="account-content"></div>
                        
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h2>Aturan Page</h2>
                                </div>
                            </div>
                            
                            @foreach ($landing as $d)
                            <div class="tab-content" id="animateLineContent-4">
                                <div class="tab-pane fade show active" id="header" role="tabpanel" aria-labelledby="header">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                            <form class="section general-info">
                                                <div class="info">
                                                    <div class="col-md-12 mt-1">
                                                        <div class="form-group text-end">
                                                            <a href="{{ route('dashboard.landingdata.editaturan', [$d->id]) }}" class="btn btn-outline-primary">
                                                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-11 mx-auto">
                                                            <div class="row">
                                                                <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                                    <div class="form">
                                                                        <div class="row">

                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    {!! $d->aturan_desc !!}
                                                                                </div>
                                                                            </div>                                                                           
                                                                            
                                                                        </div>                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>                                       
                                    </div>
                                </div>   
                            </div>
                            @endforeach
                            
                        </div>
                        

@endsection