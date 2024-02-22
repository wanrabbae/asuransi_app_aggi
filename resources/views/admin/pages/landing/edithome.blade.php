@extends('admin.layouts.app')
<!-- set title -->
@section('title')

@section('content')

                    <div class="account-settings-container layout-top-spacing">
    
                        <div class="account-content">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h2>Edit Home Page</h2>
                                </div>
                            </div>

                            <form class="section general-info" method="POST" action="{{ route('dashboard.landingdata.updatehome',[$data->id]) }}" enctype="multipart/form-data" class="row g-3">
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
                                                                    <a class="btn btn-warning" href="{{ route('dashboard.landingdata.home') }}" role="button">Back</a>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                                <div class="form">
                                                                    <div class="row">
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="head_title">Head Title</label>
                                                                                <textarea  type="text" class="form-control mb-3" id="head_title" name="head_title" rows="1">{{ $data->head_title }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="head_desc">Head Description</label>
                                                                                <textarea  type="text" class="form-control mb-3" id="head_desc" name="head_desc" rows="1">{{ $data->head_desc }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="title_product">Title Product</label>
                                                                                <input type="text" class="form-control mb-3" id="title_product" name="title_product" value="{{ $data->title_product }}" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="title_product_2">Title Product Desc</label>
                                                                                <input type="text" class="form-control mb-3" id="title_product_2" name="title_product_2" value="{{ $data->title_product_2 }}" >
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 mb-3 mt-2">
                                                                            <div class="card style-3">
                                                                                <img style="max-height: 120px; min-height: 120px; max-width:250px; min-width: 250px;" src="{{ asset('img/landing/'.$data->head_image) }}" class="card-img-top" alt="...">
                                                                                <div class="card-body px-0 py-0 align-self-center">
                                                                                    <h5 class="card-title mb-3">Head Images</h5>
                                                                                    <input type="file" class="form-control mb-3" name="head_image" accept="image/*">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="my-4">
                                                                            <hr>
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="title_join">Join Title</label>
                                                                                <textarea  type="text" class="form-control mb-3" id="title_join" name="title_join" rows="2">{{ $data->title_join }}</textarea>
                                                                            </div>
                                                                        </div>  
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="desc_join">Join Description</label>
                                                                                <textarea  type="text" class="form-control mb-3" id="desc_join" name="desc_join" rows="2">{{ $data->desc_join }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="title_join_1">Title Join Benefit 1</label>
                                                                                <input type="text" class="form-control mb-3" id="title_join_1" name="title_join_1" value="{{ $data->title_join_1 }}" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="title_join_2">Title Join Benefit 2</label>
                                                                                <input type="text" class="form-control mb-3" id="title_join_2" name="title_join_2" value="{{ $data->title_join_2 }}" >
                                                                            </div>
                                                                        </div>     
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="join_1">Join Benefit 1</label>
                                                                                <textarea  type="text" class="form-control mb-3" id="join_1" name="join_1" rows="2">{{ $data->join_1 }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="join_2">Join Benefit 2</label>
                                                                                <textarea  type="text" class="form-control mb-3" id="join_2" name="join_2" rows="2">{{ $data->join_2 }}</textarea>
                                                                            </div>
                                                                        </div>                                                                      
                                                                                                                                                
                                                                        <div class="col-md-6 mb-3 mt-3">
                                                                            <div class="card style-3">
                                                                                <img style="max-height: 120px; min-height: 120px; max-width:250px; min-width: 250px;" src="{{ asset('/img/landing/'.$data->image_join) }}" class="card-img-top mw-100" alt="...">
                                                                                <div class="card-body px-0 py-0 align-self-center">
                                                                                    <h5 class="card-title mb-3">Join Images</h5>
                                                                                    <input type="file" class="form-control mb-3" name="image_join" accept="image/*">
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