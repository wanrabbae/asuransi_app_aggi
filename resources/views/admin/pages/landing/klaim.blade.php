@extends('admin.layouts.app')
<!-- set title -->
@section('title')


@section('content')

                    <div class="account-settings-container layout-top-spacing">
    
                        <div class="account-content"></div>
                        
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h2>Klaim Page</h2>
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
                                                            <a href="{{ route('dashboard.landingdata.editklaim', [$d->id]) }}" class="btn btn-outline-primary">
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

                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="title_header_klaim">Title Header</label>
                                                                                    <textarea readonly type="text" class="form-control mb-3 text-white bg-dark" id="title_header_klaim" name="title_header_klaim" rows="2">{{ $d->title_header_klaim }}</textarea>
                                                                                </div>
                                                                            </div>                                                                            
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="desc_header_klaim">Desc Header</label>
                                                                                    <textarea readonly type="text" class="form-control mb-3 text-white bg-dark" id="desc_header_klaim" name="desc_header_klaim" rows="2">{{ $d->desc_header_klaim }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="title_body_klaim">Title Body</label>
                                                                                    <textarea readonly type="text" class="form-control mb-3 text-white bg-dark" id="title_body_klaim" name="title_body_klaim" rows="2">{{ $d->title_body_klaim }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="desc_body_klaim">Desc Body</label>
                                                                                    <textarea readonly type="text" class="form-control mb-3 text-white bg-dark" id="desc_body_klaim" name="desc_body_klaim" rows="2">{{ $d->desc_body_klaim }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="title_step_1_klaim">Title Step 1</label>
                                                                                    <input readonly type="text" class="form-control mb-3 text-white bg-dark" id="title_step_1_klaim" name="title_step_1_klaim" value="{{ $d->title_step_1_klaim }}" >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="desc_step_1_klaim">Desc Step 1</label>
                                                                                    <input readonly type="text" class="form-control mb-3 text-white bg-dark" id="desc_step_1_klaim" name="desc_step_1_klaim" value="{{ $d->desc_step_1_klaim }}" >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="title_step_2_klaim">Title Step 2</label>
                                                                                    <input readonly type="text" class="form-control mb-3 text-white bg-dark" id="title_step_2_klaim" name="title_step_2_klaim" value="{{ $d->title_step_2_klaim }}" >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="desc_step_2_klaim">Desc Step 2</label>
                                                                                    <input readonly type="text" class="form-control mb-3 text-white bg-dark" id="desc_step_2_klaim" name="desc_step_2_klaim" value="{{ $d->desc_step_2_klaim }}" >
                                                                                </div>
                                                                            </div>   
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="title_step_3_klaim">Title Step 3</label>
                                                                                    <input readonly type="text" class="form-control mb-3 text-white bg-dark" id="title_step_3_klaim" name="title_step_3_klaim" value="{{ $d->title_step_3_klaim }}" >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="desc_step_3_klaim">Desc Step 3</label>
                                                                                    <input readonly type="text" class="form-control mb-3 text-white bg-dark" id="desc_step_3_klaim" name="desc_step_3_klaim" value="{{ $d->desc_step_3_klaim }}" >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="title_step_4_klaim">Title Step 4</label>
                                                                                    <input readonly type="text" class="form-control mb-4 text-white bg-dark" id="title_step_4_klaim" name="title_step_4_klaim" value="{{ $d->title_step_4_klaim }}" >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="desc_step_4_klaim">Desc Step 4</label>
                                                                                    <input readonly type="text" class="form-control mb-4 text-white bg-dark" id="desc_step_4_klaim" name="desc_step_4_klaim" value="{{ $d->desc_step_4_klaim }}" >
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="col-md-6 mb-3 mt-3">
                                                                                <div class="card style-3 text-white bg-dark">
                                                                                    <img style="max-height: 120px; min-height: 120px; max-width:250px; min-width: 250px;" src="{{ asset('/img/landing/'.$d->img_header_klaim) }}" class="card-img-top mw-100" alt="...">
                                                                                    <div class="card-body px-0 py-0 align-self-center">
                                                                                        <h5 class="card-title mb-3">Header Klaim Images</h5>
                                                                                    </div>
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