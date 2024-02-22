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
                                            <h4>Edit Product {{ $data->name }}</h4>
                                        </div>                 
                                    </div>
                                </div>
                               
                                <div class="widget-content widget-content-area p-4">
                                    <form method="POST" action="{{ route('dashboard.offlineproductdata.update',[$data->id]) }}" enctype="multipart/form-data" class="row g-3">
                                    @csrf
                                    @method('PUT')
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Nama Produk</label>
                                            <input value="{{ $data->name }}" id="name" type="text" class="form-control" name="name" required autocomplete="none">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="komisi" class="form-label">Komisi Produk (dalam persen)</label>
                                            <input value="{{ $data->komisi }}" id="komisi" type="number" class="form-control" name="komisi" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="status_product" class="form-label">Status Produk</label>
                                            <select class="form-control" id="status_product" name="status_product" type="text">
                                                <option value="{{ $data->status_product }}"> 
                                                @if($data->status_product==1)
                                                    Aktif
                                                @elseif($data->status_product==2)
                                                    Tidak Aktif
                                                @endif </option>
                                                <option disabled>----------</option>
                                                <option value="1">Active</option>
                                                <option value="2">Tidak Aktif</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="icon" class="form-label">Icon Produk (file SVG)</label>
                                            <input value="{{ $data->icon }}" id="icon" accept="image/*" type="file" class="form-control" name="icon">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="my-editor">Deskripsi Halaman Depan</label>
                                            <textarea class="form-control mb-3" id="my-editor" name="description" required>
                                                {!! $data->description !!}
                                            </textarea>                                            
                                        </div>  
                                        
                                        <div class="col-md-6">
                                            <button class="btn btn-primary" type="submit">Simpan</button>
                                            <a class="btn btn-warning" href="{{ route('dashboard.offlineproductdata.index') }}" role="button">Back</a>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>   
    
@push('after-script')
    <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
    </script>
    <script>
    CKEDITOR.replace('my-editor', {
        uiColor: '#054d4a',
    }, options);
    </script>
@endpush


@endsection