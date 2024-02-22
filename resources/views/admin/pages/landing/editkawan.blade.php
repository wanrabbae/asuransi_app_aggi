@extends('admin.layouts.app')
<!-- set title -->
@section('title')

@section('content')

                    <div class="account-settings-container layout-top-spacing">
    
                        <div class="account-content">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h2>EDIT KAWAN PAGE</h2>
                                </div>
                            </div>

                            <form class="section general-info" method="POST" action="{{ route('dashboard.landingdata.updatekawan',[$data->id]) }}" enctype="multipart/form-data" class="row g-3">
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
                                                                    <a class="btn btn-warning" href="{{ route('dashboard.landingdata.kawan') }}" role="button">Back</a>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                                <div class="form">
                                                                    <div class="row">
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="kawan_head_title">Header Title</label>
                                                                                <textarea  type="text" class="form-control mb-3 text-white bg-dark" id="kawan_head_title" name="kawan_head_title" rows="2">{{ $data->kawan_head_title }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="kawan_head_desc">Header Description</label>
                                                                                <textarea  type="text" class="form-control mb-3 text-white bg-dark" id="kawan_head_desc" name="kawan_head_desc" rows="2">{{ $data->kawan_head_desc }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 mb-3 mt-3">
                                                                            <div class="card style-3 text-white bg-dark">
                                                                                <img style="max-height: 120px; min-height: 120px; max-width:250px; min-width: 250px;" src="{{ asset('/img/landing/'.$data->kawan_content_img) }}" class="card-img-top mw-100" alt="...">
                                                                                <div class="card-body px-0 py-0 align-self-center">
                                                                                    <h5 class="card-title mb-3">Footer Content Images</h5>
                                                                                    <input type="file" class="form-control mb-3" name="kawan_content_img" accept="image/*">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                        <!-- content -->
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="kawan_content_title">Title Content</label>
                                                                                <input  type="text" class="form-control mb-3 text-white bg-dark" id="kawan_content_title" name="kawan_content_title" value="{{ $data->kawan_content_title }}" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="kawan_content_title_2">Desc Description</label>
                                                                                <textarea  type="text" class="form-control mb-3 text-white bg-dark" id="kawan_content_title_2" name="kawan_content_title_2" rows="1">{{ $data->kawan_content_title_2 }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="kawan_content_video">Video</label>
                                                                                <input id="kawan_content_video" type="file" class="form-control mb-3" name="kawan_content_video">
                                                                            </div>
                                                                        </div>                                                                              
                                                                        <div class="col-md-6 mb-3 mt-4">
                                                                            <div class="card style-3 text-white bg-dark">
                                                                                <img style="max-height: 120px; min-height: 120px; max-width:250px; min-width: 250px;" src="{{ asset('/img/landing/'.$data->kawan_content_video_img) }}" class="card-img-top mw-100" alt="...">
                                                                                <div class="card-body px-0 py-0 align-self-center">
                                                                                    <h5 class="card-title mb-3">Video Images</h5>
                                                                                    <input type="file" class="form-control mb-3" name="kawan_content_video_img" accept="image/*">
                                                                                </div>
                                                                            </div>
                                                                        </div>                                                                            
                                                                        <hr>
                                                                        <!-- svg content -->
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="kawan_content_title_svg_1">Title Content SVG 1</label>
                                                                                <input type="text" class="form-control mb-3" id="kawan_content_title_svg_1" name="kawan_content_title_svg_1" value="{{ $data->kawan_content_title_svg_1 }}" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="kawan_content_title_svg_2">Title Content SVG 2</label>
                                                                                <input type="text" class="form-control mb-3" id="kawan_content_title_svg_2" name="kawan_content_title_svg_2" value="{{ $data->kawan_content_title_svg_2 }}" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="kawan_content_title_svg_3">Title Content SVG 3</label>
                                                                                <input  type="text" class="form-control mb-3 text-white bg-dark" id="kawan_content_title_svg_3" name="kawan_content_title_svg_3" value="{{ $data->kawan_content_title_svg_3 }}" >
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="kawan_content_desc_svg_1">Desc Content SVG 1</label>
                                                                                <textarea  type="text" class="form-control mb-3 text-white bg-dark" id="kawan_content_desc_svg_1" name="kawan_content_desc_svg_1" rows="2">{{ $data->kawan_content_desc_svg_1 }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="kawan_content_desc_svg_2">Desc Content SVG 2</label>
                                                                                <textarea  type="text" class="form-control mb-3 text-white bg-dark" id="kawan_content_desc_svg_2" name="kawan_content_desc_svg_2" rows="2">{{ $data->kawan_content_desc_svg_2 }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="kawan_content_desc_svg_3">Desc Content SVG 3</label>
                                                                                <textarea  type="text" class="form-control mb-3 text-white bg-dark" id="kawan_content_desc_svg_3" name="kawan_content_desc_svg_3" rows="2">{{ $data->kawan_content_desc_svg_3 }}</textarea>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="kawan_content_svg_1">Img Content SVG 1</label>
                                                                                <input id="kawan_content_svg_1" type="file" class="form-control mb-3" name="kawan_content_svg_1" accept="image/*">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="kawan_content_svg_2">Img Content SVG 2</label>
                                                                                <input id="kawan_content_svg_2" type="file" class="form-control mb-3" name="kawan_content_svg_2" accept="image/*">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="kawan_content_svg_3">Img Content SVG 3</label>
                                                                                <input id="kawan_content_svg_3" type="file" class="form-control mb-3" name="kawan_content_svg_3" accept="image/*">
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