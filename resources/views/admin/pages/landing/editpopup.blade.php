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
                                            <h4>Edit Data PopUp</h4>
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
                                    <form method="POST" action="{{route('dashboard.landingdata.updatepopup', $data->id) }}" enctype="multipart/form-data" class="row g-3">
                                    @csrf
                                    @method('PUT') 

                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" width="50%">Title</th>
                                                    <th scope="col" width="25%">Images</th>
                                                    <th scope="col" >Status</th>
                                                </tr>
                                                <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="">
                                                        <input readonly type="text" name="name" value="{{ $data->name }}" class="form-control" required>
                                                    </td>
                                                    <td class="">
                                                        <div class="card style-2 mb-md-0 mb-4 text-white bg-dark">
                                                            <img src="{{ asset('/img/landing/'.$data->popup) }}" class="card-img-top " alt="...">                                                                                                    
                                                            <div class="card-body px-0 py-0 align-self-center mt-4">
                                                                <input type="file" class="form-control" name="popup" accept="image/*">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="">
                                                        <select class="form-control" id="status" name="status" type="text">
                                                            <option value="{{ $data->status }}">
                                                                @if($data->status == 0)
                                                                    Active
                                                                @elseif ($data-> status == 1)
                                                                    Inactive
                                                                @endif </option>
                                                            <option disabled>----------</option>
                                                            <option value="0">Active</option>
                                                            <option value="1">Inactive</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button class="btn btn-primary" type="submit">Submit Data</button>
                                        <a class="btn btn-warning" href="{{ route('dashboard.landingdata.popup') }}" role="button">Back</a>
                                    </div>
                                    

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

@endsection