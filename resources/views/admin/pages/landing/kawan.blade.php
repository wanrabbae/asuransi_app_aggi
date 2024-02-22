@extends('admin.layouts.app')
<!-- set title -->
@section('title')


@section('content')

                    <div class="account-settings-container layout-top-spacing">
    
                        <div class="account-content"></div>
                        
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h2>Kawan aggiku page</h2>
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
                                                            <a href="{{ route('dashboard.landingdata.editkawan', [$d->id]) }}" class="btn btn-outline-primary">
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
                                                                            <!-- header -->
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="kawan_head_title">Header Title</label>
                                                                                    <textarea readonly type="text" class="form-control mb-3 text-white bg-dark" id="kawan_head_title" name="kawan_head_title" rows="2">{{ $d->kawan_head_title }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="kawan_head_desc">Header Description</label>
                                                                                    <textarea readonly type="text" class="form-control mb-3 text-white bg-dark" id="kawan_head_desc" name="kawan_head_desc" rows="2">{{ $d->kawan_head_desc }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 mb-3 mt-3">
                                                                                <div class="card style-3 text-white bg-dark">
                                                                                    <img style="max-height: 120px; min-height: 120px; max-width:250px; min-width: 250px;" src="{{ asset('/img/landing/'.$d->kawan_content_img) }}" class="card-img-top mw-100" alt="...">
                                                                                    <div class="card-body px-0 py-0 align-self-center">
                                                                                        <h5 class="card-title mb-3">Footer Content Images</h5>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <!-- content -->
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="kawan_content_title">Title Content</label>
                                                                                    <input readonly type="text" class="form-control mb-3 text-white bg-dark" id="kawan_content_title" name="kawan_content_title" value="{{ $d->kawan_content_title }}" >
                                                                                </div>
                                                                            </div>  
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="kawan_content_title_2">Desc Description</label>
                                                                                    <textarea readonly type="text" class="form-control mb-3 text-white bg-dark" id="kawan_content_title_2" name="kawan_content_title_2" rows="1">{{ $d->kawan_content_title_2 }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="kawan_content_video">Video</label>
                                                                                    <input readonly type="text" class="form-control mb-3 text-white bg-dark" id="kawan_content_video" name="kawan_content_video" value="{{ $d->kawan_content_video }}" >
                                                                                </div>
                                                                            </div> 
                                                                            <div class="col-md-6 mb-3 mt-4">
                                                                                <div class="card style-3 text-white bg-dark">
                                                                                    <img style="max-height: 120px; min-height: 120px; max-width:250px; min-width: 250px;" src="{{ asset('/img/landing/'.$d->kawan_content_video_img) }}" class="card-img-top mw-100" alt="...">
                                                                                    <div class="card-body px-0 py-0 align-self-center">
                                                                                        <h5 class="card-title mb-3">Video Images</h5>
                                                                                    </div>
                                                                                </div>
                                                                            </div>                                                                            
                                                                            <hr>
                                                                            <!-- svg content -->
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label for="kawan_content_title_svg_1">Title Content SVG 1</label>
                                                                                    <input readonly type="text" class="form-control mb-3 text-white bg-dark" id="kawan_content_title_svg_1" name="kawan_content_title_svg_1" value="{{ $d->kawan_content_title_svg_1 }}" >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label for="kawan_content_title_svg_2">Title Content SVG 2</label>
                                                                                    <input readonly type="text" class="form-control mb-3 text-white bg-dark" id="kawan_content_title_svg_2" name="kawan_content_title_svg_2" value="{{ $d->kawan_content_title_svg_2 }}" >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label for="kawan_content_title_svg_3">Title Content SVG 3</label>
                                                                                    <input readonly type="text" class="form-control mb-3 text-white bg-dark" id="kawan_content_title_svg_3" name="kawan_content_title_svg_3" value="{{ $d->kawan_content_title_svg_3 }}" >
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label for="kawan_content_desc_svg_1">Desc Content SVG 1</label>
                                                                                    <textarea readonly type="text" class="form-control mb-3 text-white bg-dark" id="kawan_content_desc_svg_1" name="kawan_content_desc_svg_1" rows="2">{{ $d->kawan_content_desc_svg_1 }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label for="kawan_content_desc_svg_2">Desc Content SVG 2</label>
                                                                                    <textarea readonly type="text" class="form-control mb-3 text-white bg-dark" id="kawan_content_desc_svg_2" name="kawan_content_desc_svg_2" rows="2">{{ $d->kawan_content_desc_svg_2 }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label for="kawan_content_desc_svg_3">Desc Content SVG 3</label>
                                                                                    <textarea readonly type="text" class="form-control mb-3 text-white bg-dark" id="kawan_content_desc_svg_3" name="kawan_content_desc_svg_3" rows="2">{{ $d->kawan_content_desc_svg_3 }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="col-md-4 mb-3 mt-3">
                                                                                <div class="card style-3 text-white bg-dark">
                                                                                    <img style="max-height: 120px; min-height: 120px; max-width:150px; min-width: 150px;" src="{{ asset('/img/landing/'.$d->kawan_content_svg_1) }}" class="card-img-top mw-100" alt="...">
                                                                                    <div class="card-body px-0 py-0 align-self-center">
                                                                                        <h5 class="card-title mb-3">Content SVG 1</h5>
                                                                                    </div>
                                                                                </div>
                                                                            </div> 
                                                                            <div class="col-md-4 mb-3 mt-3">
                                                                                <div class="card style-3 text-white bg-dark">
                                                                                    <img style="max-height: 120px; min-height: 120px; max-width:150px; min-width: 150px;" src="{{ asset('/img/landing/'.$d->kawan_content_svg_2) }}" class="card-img-top mw-100" alt="...">
                                                                                    <div class="card-body px-0 py-0 align-self-center">
                                                                                        <h5 class="card-title mb-3">Content SVG 2</h5>
                                                                                    </div>
                                                                                </div>
                                                                            </div> 
                                                                            <div class="col-md-4 mb-3 mt-3">
                                                                                <div class="card style-3 text-white bg-dark">
                                                                                    <img style="max-height: 120px; min-height: 120px; max-width:150px; min-width: 150px;" src="{{ asset('/img/landing/'.$d->kawan_content_svg_3) }}" class="card-img-top mw-100" alt="...">
                                                                                    <div class="card-body px-0 py-0 align-self-center">
                                                                                        <h5 class="card-title mb-3">Content SVG 3</h5>
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