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
                                    @error('name')
                                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror                                    
                                    <form id="form_id" method="POST" action="{{ route('dashboard.onlineproductdata.update',[$data->id]) }}" enctype="multipart/form-data" class="row g-3">
                                    @csrf
                                    @method('PUT')
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Nama Produk</label>
                                            <input value="{{ $data->name }}" id="name" type="text" class="form-control" name="name" required autocomplete="none">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="komisi" class="form-label">Komisi Produk (dalam persen)</label>
                                            <input value="{{ $data->komisi }}" id="komisi" type="number" class="form-control" name="komisi" required >
                                        </div>
                                        <div class="col-md-6">
                                            <label for="price_show" class="form-label">Harga yang ditampilkan</label>
                                            <input value="{{ $data->price_show }}" id="price_show" type="text" class="form-control" name="price_show" required>
                                        </div>                                       
                                        <div class="col-md-6">
                                            <label for="rate" class="form-label">Rate</label>
                                            <input value="{{ $data->rate }}" id="rate" type="text" pattern="\d+(\.\d{1,5})" title="Please enter a valid number" class="form-control" name="rate" required>
                                            <div id="rate-error" class="error-message" style="display: none;">(gunakan desimal minimal 1 digit setelah 0 contoh: 0.294)</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="min_price" class="form-label">Minimal Pertangungan</label>
                                            <input value="{{ format_uang($data->min_price) }}" id="min_price" type="text" class="form-control" name="min_price" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="max_price" class="form-label">Maksimal Pertangungan</label>
                                            <input value="{{ format_uang($data->max_price) }}" id="max_price" type="text" class="form-control" name="max_price" required>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <label for="description">Benefit produk</label>
                                            <textarea class="form-control mb-3" id="description" name="description" required>
                                                {!! $data->description !!}
                                            </textarea>                                            
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <label for="title_landing" class="form-label">Title Halaman Depan</label>
                                            <input value="{{ $data->title_landing }}" id="title_landing" type="text" class="form-control" name="title_landing" required >
                                        </div>
                                        <div class="col-md-12">
                                            <label for="desc_landing" class="form-label">Deskripsi Halaman Depan</label>
                                            <textarea  type="text" class="form-control mb-3" id="desc_landing" name="desc_landing" rows="2">{{ $data->desc_landing }}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="status_product" class="form-label">Status Produk</label>
                                            <select class="form-control" id="status_product" name="status_product" type="text">
                                                <option value="{{ $data->status_product }}">
                                                    @if ($data->status_product == 1)
                                                        Aktif
                                                    @elseif($data->status_product == 2)
                                                        Tidak Aktif
                                                    @endif
                                                </option>
                                                <option disabled>----------</option>
                                                <option value="1">Aktif</option>
                                                <option value="2">Tidak Aktif</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="claim_file" class="form-label">Klaim Form</label>
                                            <input value="{{ $data->claim_file }}" id="claim_file" type="file" class="form-control" name="claim_file">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="icon" class="form-label">Icon Produk (file SVG)</label>
                                            <input value="{{ $data->icon }}" id="icon" accept="image/*" type="file" class="form-control" name="icon">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="images_landing" class="form-label">Gambar Halaman Depan</label>
                                            <input value="{{ $data->images_landing }}" id="images_landing" accept="image/*" type="file" class="form-control" name="images_landing">
                                        </div>
                                        
                                        
                                        <div class="col-md-6">
                                            <button class="btn btn-primary" type="submit">Simpan</button>
                                            <a class="btn btn-warning" href="{{ route('dashboard.onlineproductdata.index') }}" role="button">Kembali</a>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>   
    
@push('after-script')
    <script src="/js/formatRupiah.js"></script>
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
    CKEDITOR.replace('description', {
        uiColor: '#054d4a',
    }, options);
    </script>

    <script>
        document.getElementById('rate').addEventListener('input', function(event) {
            if (!event.target.checkValidity()) {
                document.getElementById('rate-error').style.display = 'block';
            } else {
                document.getElementById('rate-error').style.display = 'none';
            }
        });
    </script>
    <script>
        var min_price = document.getElementById('min_price');
        min_price.addEventListener('keyup', function(e) {
            min_price.value = formatRupiah(this.value);
        }); 

        var max_price = document.getElementById('max_price');
        max_price.addEventListener('keyup', function(e) {
            max_price.value = formatRupiah(this.value);
        });
        
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('form_id').addEventListener('submit', function(e) {
                min_price.value = min_price.value.replace(/\./g, '');
                max_price.value = max_price.value.replace(/\./g, '');
            });
        });
    </script>
@endpush


@endsection