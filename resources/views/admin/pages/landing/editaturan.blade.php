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
                                            <h4>Edit Halaman Aturan - Pengguna</h4>
                                        </div>                 
                                    </div>
                                </div>
                               
                                <div class="widget-content widget-content-area p-4">
                                    <form method="POST" action="{{route('dashboard.landingdata.updateaturan',[$data->id]) }}" enctype="multipart/form-data" class="row g-3">
                                    @csrf
                                    @method('PUT')
                                        <div class="col-md-12">
                                            <label for="aturan_title" class="form-label">Title Header Aturan - Pengguna</label>
                                            <input type="text" class="form-control mb-3" id="aturan_title" name="aturan_title" value="{{ $data->aturan_title }}" >
                                        </div>                                       
                                        
                                        <div class="col-md-12">
                                            <label for="aturan_desc">Aturan Pengguna Description</label>
                                            <textarea class="form-control mb-3" id="aturan_desc" name="aturan_desc" rows="50" required>
                                                {!! $data->aturan_desc !!}
                                            </textarea>                                            
                                        </div>                                       
                                        
                                        <div class="col-md-6">
                                            <button class="btn btn-primary" type="submit">Submit Data</button>
                                            <a class="btn btn-warning" href="{{ route('dashboard.landingdata.aturan') }}" role="button">Back</a>
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
    CKEDITOR.replace('aturan_desc', {
        uiColor: '#054d4a',
    }, options);
    </script>
@endpush


@endsection