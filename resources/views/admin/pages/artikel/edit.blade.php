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
                                            <h4>Edit Data Artikel {{ $data->title }}</h4>
                                        </div>                 
                                    </div>
                                </div>
                               
                                <div class="widget-content widget-content-area p-4">
                                    <form method="POST" action="{{ route('dashboard.artikeldata.update',[$data->id]) }}" enctype="multipart/form-data" class="row g-3">
                                    @csrf
                                    @method('PUT')
                                        <div class="col-md-12">
                                            <label for="title" class="form-label">Title Artikel</label>
                                            <input value="{{ $data->title }}" id="title" type="text" class="form-control" name="title" required >
                                        </div>
                                        <div class="col-md-6">
                                            <label for="artikel_img" class="form-label">Images</label>
                                            <input value="{{ $data->artikel_img }}" id="artikel_img" accept="image/*" type="file" class="form-control" name="artikel_img">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="category_id" class="form-label">Category</label>
                                            <select class="form-select" name="category_id" id="category_id">
                                                <option  selected  value="{{ $data->category_id }}">{{ $data->category->name }}</option>
                                                <option  disabled ="">-------------------</option>
                                                @foreach ($cat as $d)
                                                <option value="{{ $d->id }}">{{ $d->name }}</option> 
                                                @endforeach
                                            </select>
                                        </div>                                       
                                        
                                        <div class="col-md-12">
                                            <label for="description">Description</label>
                                            <textarea class="form-control mb-3" id="description" name="description" required>
                                                {!! $data->description !!}
                                            </textarea>                                          
                                        </div>                                        
                                        
                                        <div class="col-md-6">
                                            <button class="btn btn-primary" type="submit">Submit Product</button>
                                            <a class="btn btn-warning" href="{{ route('dashboard.artikeldata.index') }}" role="button">Back</a>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

@push('after-script')
    <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
    </script>
    <script>
    CKEDITOR.replace('description', options);
    </script>
@endpush


@endsection