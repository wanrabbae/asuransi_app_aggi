@extends('admin.layouts.app')
<!-- set title -->
@section('title')

@section('content')

                    <div class="account-settings-container layout-top-spacing">
    
                        <div class="account-content">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h2>Edit Admin fee</h2>
                                </div>
                            </div>

                            <form class="section general-info" method="POST" action="{{ route('dashboard.landingdata.updatefee',[$data->id]) }}" enctype="multipart/form-data" class="row g-3">
                            @csrf
                            @method('PUT')                            
                            <div class="tab-content" id="animateLineContent-4">
                                
                                <div class="tab-pane fade show active" id="animated-underline-fee" role="tabpanel" aria-labelledby="fee-info">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                            <div class="info">                                                    
                                                <div class="row">
                                                    <div class="col-lg-11 mx-auto">
                                                        <div class="row">
                                                            <div class="col-md-12 mt-1">
                                                                <div class="form-group text-end">
                                                                    <button class="btn btn-primary" type="submit">Submit Data</button>
                                                                    <a class="btn btn-warning" href="{{ route('dashboard.landingdata.fee') }}" role="button">Back</a>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                                <div class="form">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                                <label for="admin_fee">Admin Fee</label>
                                                                            <div class="form-group">
                                                                                <input type="text" class="form-control mb-3" id="admin_fee" name="admin_fee" value="{{ $data->admin_fee }}" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="materai_fee">Materai</label>
                                                                                <input type="text" class="form-control mb-3" id="materai_fee" name="materai_fee" value="{{ $data->materai_fee }}" >
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