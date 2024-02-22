@extends('admin.layouts.app')
<!-- set title -->
@section('title')


@section('content')

                    <div class="account-settings-container layout-top-spacing">
    
                        <div class="account-content"></div>
                        
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h2>FAQ Page</h2>
                                </div>
                            </div>
                            
                            @foreach ($landing as $d)
                            <div class="tab-content" id="animateLineContent-4">
                                <div class="tab-pane fade show active" id="header" role="tabpanel" aria-labelledby="header">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                                <form class="section general-info">
                                                    <div class="info">
                                                        <div class="col-md-12 mt-1">
                                                            <div class="form-group text-end">
                                                                <a href="{{ route('dashboard.landingdata.createfaq') }}" class="btn btn-outline-primary">
                                                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="middle-content container-xxl p-0">                    
                                                            <div class="faq">                                        
                                                                <div class="faq-layouting layout-spacing">                                            
                                                                    <div class="fq-tab-section">
                                                                        <div class="row">
                                                                            <div class="col-md-12">                                        
                                                                                <h2>Frequently Asked <span>Questions</span></h2>                                                                          
                                                                                
                                                                                <div class="table-responsive">
                                                                                    <table class="table table-bordered" id="table">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th scope="col" width="35%">Title</th>
                                                                                                <th scope="col" >Description</th>
                                                                                                <th class="text-center" scope="col">Action</th>
                                                                                            </tr>
                                                                                            <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            @foreach ($faqs as $d)
                                                                                            <tr>
                                                                                                <td class="">
                                                                                                    <input readonly type="text" name="title" value="{{ $d->title }}" class="form-control" required>
                                                                                                </td>
                                                                                                <td class="">
                                                                                                    <textarea readonly name="desc"  cols="80" rows="6" class="form-control" required>{{ $d->desc }}</textarea>
                                                                                                </td>
                                                                                                <td class="text-center">
                                                                                                    <a href="{{ route('dashboard.landingdata.editfaq', [$d->id]) }}" class="btn btn-outline-primary">
                                                                                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                                                                    </a>
                                                                                                </td>
                                                                                            </tr>
                                                                                            @endforeach
                                                                                        </tbody>
                                                                                    </table>
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
                            </div>
                            @endforeach
                            
                        </div>
                        

@endsection