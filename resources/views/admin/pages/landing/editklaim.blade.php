@extends('admin.layouts.app')
<!-- set title -->
@section('title')

@section('content')

                    <div class="account-settings-container layout-top-spacing">
    
                        <div class="account-content">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h2>EDIT KLAIM PAGE</h2>
                                </div>
                            </div>

                            <form class="section general-info" method="POST" action="{{ route('dashboard.landingdata.updateklaim',[$data->id]) }}" enctype="multipart/form-data" class="row g-3">
                            @csrf
                            @method('PUT')                            
                            <div class="tab-content" id="animateLineContent-4">
                                
                                <div class="tab-pane fade show active" id="animated-underline-company" role="tabpanel" aria-labelledby="company-info">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                            <div class="info">                                                    
                                                <div class="row">
                                                    <div class="col-lg-11 mx-auto">
                                                        <div class="row">
                                                            <div class="col-md-12 mt-1">
                                                                <div class="form-group text-end">
                                                                    <button class="btn btn-primary" type="submit">Submit Data</button>
                                                                    <a class="btn btn-warning" href="{{ route('dashboard.landingdata.klaim') }}" role="button">Back</a>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                                <div class="form">
                                                                    <div class="row">
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="title_header_klaim">Title Header</label>
                                                                                <textarea  type="text" class="form-control mb-3" id="title_header_klaim" name="title_header_klaim" rows="2">{{ $data->title_header_klaim }}</textarea>
                                                                            </div>
                                                                        </div>  
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="desc_header_klaim">Des Header</label>
                                                                                <textarea  type="text" class="form-control mb-3" id="desc_header_klaim" name="desc_header_klaim" rows="2">{{ $data->desc_header_klaim }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="title_body_klaim">Title Body Klaim</label>
                                                                                <textarea  type="text" class="form-control mb-3" id="title_body_klaim" name="title_body_klaim" rows="2">{{ $data->title_body_klaim }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="desc_body_klaim">Desc Body Klaim</label>
                                                                                <textarea  type="text" class="form-control mb-3" id="desc_body_klaim" name="desc_body_klaim" rows="2">{{ $data->desc_body_klaim }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="title_step_1_klaim">Title Step 1 Klaim</label>
                                                                                <input type="text" class="form-control mb-3" id="title_step_1_klaim" name="title_step_1_klaim" value="{{ $data->title_step_1_klaim }}" >
                                                                            </div>
                                                                        </div> 
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="desc_step_1_klaim">Desc Step 1 Klaim</label>
                                                                                <input type="text" class="form-control mb-3" id="desc_step_1_klaim" name="desc_step_1_klaim" value="{{ $data->desc_step_1_klaim }}" >
                                                                            </div>
                                                                        </div> 
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="title_step_2_klaim">Title Step 2 Klaim</label>
                                                                                <input type="text" class="form-control mb-3" id="title_step_2_klaim" name="title_step_2_klaim" value="{{ $data->title_step_2_klaim }}" >
                                                                            </div>
                                                                        </div> 
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="desc_step_2_klaim">Desc Step 2 Klaim</label>
                                                                                <input type="text" class="form-control mb-3" id="desc_step_2_klaim" name="desc_step_2_klaim" value="{{ $data->desc_step_2_klaim }}" >
                                                                            </div>
                                                                        </div> 
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="title_step_3_klaim">Title Step 3 Klaim</label>
                                                                                <input type="text" class="form-control mb-3" id="title_step_3_klaim" name="title_step_3_klaim" value="{{ $data->title_step_3_klaim }}" >
                                                                            </div>
                                                                        </div> 
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="desc_step_3_klaim">Desc Step 3 Klaim</label>
                                                                                <input type="text" class="form-control mb-3" id="desc_step_3_klaim" name="desc_step_3_klaim" value="{{ $data->desc_step_3_klaim }}" >
                                                                            </div>
                                                                        </div> 
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="title_step_4_klaim">Title Step 4 Klaim</label>
                                                                                <input type="text" class="form-control mb-3" id="title_step_4_klaim" name="title_step_4_klaim" value="{{ $data->title_step_4_klaim }}" >
                                                                            </div>
                                                                        </div> 
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="desc_step_4_klaim">Desc Step 4 Klaim</label>
                                                                                <input type="text" class="form-control mb-3" id="desc_step_4_klaim" name="desc_step_4_klaim" value="{{ $data->desc_step_4_klaim }}" >
                                                                            </div>
                                                                        </div>                                                                  
                                                                                                                                                
                                                                        <div class="col-md-6 mb-3 mt-3">
                                                                            <div class="card style-3">
                                                                                <img style="max-height: 120px; min-height: 120px; max-width:250px; min-width: 250px;" src="{{ asset('/img/landing/'.$data->img_header_klaim) }}" class="card-img-top mw-100" alt="...">
                                                                                <div class="card-body px-0 py-0 align-self-center">
                                                                                    <h5 class="card-title mb-3">Img Header Klaim</h5>
                                                                                    <input type="file" class="form-control mb-3" name="img_header_klaim" accept="image/*">
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
                                        </div>
                                    </div>
                                </div>

                            </div>
                            </form>
                        </div>
                        
                    </div>

@endsection