@extends('admin.layouts.app')
<!-- set title -->
@section('title')


@section('content')

                    <div class="row">
                        <div id="browser_default" class="col-lg-8 layout-spacing col-md-8 mt-4 offset-2">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Add New Product</h4>
                                        </div>                 
                                    </div>
                                </div>
                               
                                <div class="widget-content widget-content-area p-4">
                                    <form method="POST" action="{{ route('dashboard.offlineproductdata.store') }}" enctype="multipart/form-data" class="row g-3">
                                    @csrf
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Product Name</label>
                                            <input id="name" type="text" value="{{ old('name') }}" class="form-control" name="name" required >
                                        </div>
                                        <div class="col-md-6">
                                            <label for="icon" class="form-label">Icon SVG</label>
                                            <input id="icon" type="file" accept="image/*" class="form-control" name="icon" required >
                                        </div>
                                        <div class="col-md-12">
                                            <label for="description">Benefit Description</label>
                                            <textarea class="form-control mb-3" id="my-editor" name="description" required>
                                                {!! old('content') !!}
                                            </textarea>                                            
                                        </div>                                        
                                        
                                        <div class="col-md-6">
                                            <button class="btn btn-primary" type="submit">Submit Product</button>
                                            <a class="btn btn-warning" href="{{ route('dashboard.onlineproductdata.index') }}" role="button">Back</a>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

@push('after-script')
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
    </script>
    <script>
    CKEDITOR.replace('my-editor', options);
    </script>
@endpush

@endsection