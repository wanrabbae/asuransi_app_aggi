@extends('admin.layouts.app')
<!-- set title -->
@section('title')


@section('content')

                    <div class="row">
                        <div id="browser_default" class="col-12 mt-4">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Edit Data Faq</h4>
                                        </div>                 
                                    </div>
                                </div>

                                @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>                         
                                @endif
                               
                                <div class="widget-content widget-content-area p-4">
                                    <form method="POST" action="{{route('dashboard.landingdata.updatefaq', $data->id) }}" enctype="multipart/form-data" class="row g-3">
                                    @csrf
                                    @method('PUT') 

                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" width="35%">Title</th>
                                                    <th scope="col" >Description</th>
                                                </tr>
                                                <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="">
                                                        <input type="text" name="title" value="{{ $data->title }}" class="form-control" required>
                                                    </td>
                                                    <td class="">
                                                        <textarea name="desc" id="desc" cols="80" rows="8" class="form-control" required>{{ $data->desc }}</textarea>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button class="btn btn-primary" type="submit">Submit Data</button>
                                        <a class="btn btn-warning" href="{{ route('dashboard.landingdata.faq') }}" role="button">Back</a>
                                    </div>
                                    

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

@endsection