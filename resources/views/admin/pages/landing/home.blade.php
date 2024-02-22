@extends('admin.layouts.app')
<!-- set title -->
@section('title')


@section('content')

                    <div class="account-settings-container layout-top-spacing">
    
                        <div class="account-content"></div>
                        
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h2>Home Page</h2>
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
                                                            <a href="{{ route('dashboard.landingdata.edithome', [$d->id]) }}" class="btn btn-outline-primary">
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
                                                                                    <label for="head_title">Head Title</label>
                                                                                    <textarea readonly type="text" class="form-control mb-3 text-white bg-dark" id="head_title" name="head_title" rows="1">{{ $d->head_title }}</textarea>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="head_desc">Head Description</label>
                                                                                    <textarea readonly type="text" class="form-control mb-3 text-white bg-dark" id="head_desc" name="head_desc" rows="1">{{ $d->head_desc }}</textarea>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="title_product">Title Product</label>
                                                                                    <input readonly type="text" class="form-control mb-3 text-white bg-dark" id="title_product" name="title_product" value="{{ $d->title_product }}" >
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="title_product_2">Title Product Desc</label>
                                                                                    <input readonly type="text" class="form-control mb-3 text-white bg-dark" id="title_product_2" name="title_product_2" value="{{ $d->title_product_2 }}" >
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 mb-3 mt-2">
                                                                                <div class="card style-3 text-white bg-dark">                                                                                    
                                                                                    <img style="max-height: 120px; min-height: 120px; max-width:250px; min-width: 250px;" src="{{ asset('/img/landing/'.$d->head_image) }}" class="card-img-top" alt="...">
                                                                                    <div class="card-body px-0 py-0 align-self-center">
                                                                                        <h5 class="card-title mb-3">Head Images</h5>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <hr>

                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="title_join">Join Title</label>
                                                                                    <textarea readonly type="text" class="form-control mb-3 text-white bg-dark" id="title_join" name="title_join" rows="2">{{ $d->title_join }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="desc_join">Join Description</label>
                                                                                    <textarea readonly type="text" class="form-control mb-3 text-white bg-dark" id="desc_join" name="desc_join" rows="2">{{ $d->desc_join }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="title_join_1">Title Join Benefit 1</label>
                                                                                    <input readonly type="text" class="form-control mb-3 text-white bg-dark" id="title_join_1" name="title_join_1" value="{{ $d->title_join_1 }}" >
                                                                                </div>
                                                                            </div>                                                                            
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="title_join_2">Title Join Benefit 1</label>
                                                                                    <input readonly type="text" class="form-control mb-3 text-white bg-dark" id="title_join_2" name="title_join_2" value="{{ $d->title_join_2 }}" >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="join_1">Join Benefit 1</label>
                                                                                    <textarea readonly type="text" class="form-control mb-3 text-white bg-dark" id="join_1" name="join_1" rows="2">{{ $d->join_1 }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="join_2">Join Benefit 2</label>
                                                                                    <textarea readonly type="text" class="form-control mb-3 text-white bg-dark" id="join_2" name="join_2" rows="2">{{ $d->join_2 }}</textarea>
                                                                                </div>
                                                                            </div> 
                                                                            
                                                                            <div class="col-md-6 mb-3 mt-3">
                                                                                <div class="card style-3 text-white bg-dark">
                                                                                    <img style="max-height: 120px; min-height: 120px; max-width:250px; min-width: 250px;" src="{{ asset('/img/landing/'.$d->image_join) }}" class="card-img-top mw-100" alt="...">
                                                                                    <div class="card-body px-0 py-0 align-self-center">
                                                                                        <h5 class="card-title mb-3">Join Images</h5>
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