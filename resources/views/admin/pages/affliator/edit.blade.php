@extends('admin.layouts.app')
<!-- set title -->
@section('title')

@section('content')

                    <div class="row">
                        <div id="browser_default" class="col-lg-12 layout-spacing col-md-6 mt-4">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 mt-2">
                                            <h4>Detail Data Affiliator - {{ $data->name }}</h4>
                                        </div>                 
                                    </div>
                                </div>
                                
                                <div class="widget-content widget-content-area p-4">
                                     @error('email')
                                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                        <strong>{{ $message }}</strong>
                                    </div>                                   
                                    @enderror
                                    @error('password')
                                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                        <strong>{{ $message }}</strong>
                                    </div>                         
                                    @enderror
                                    <form method="POST" action="{{ route('dashboard.userdata.updateaffliator',[$data->id]) }}" enctype="multipart/form-data" class="row g-3">
                                    @csrf
                                    @method('PUT')
                                        <div class="col-md-4">
                                            <label for="name" class="form-label">Nama</label>
                                            <input readonly id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $data->name }}" required autocomplete="name" autofocus>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="created_at" class="form-label">Tanggal Mendaftar</label>
                                            <input readonly id="created_at" type="text" class="form-control" name="created_at" value="{{ \Carbon\Carbon::parse($data->created_at)->format('d F Y') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="password" class="form-label">Ganti Password</label>
                                            <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <label for="roles" class="form-label">Status</label>
                                            <select class="form-control" id="is_active" name="is_active" type="text">
                                                <option value="{{ $data->is_active }}">
                                                                @if($data->is_active == 1)
                                                                    Active
                                                                @elseif ($data-> is_active == 0)
                                                                    Inactive
                                                                @endif </option>
                                                <option disabled>----------</option>
                                                <option value="0">Inactive</option>
                                                <option value="1">Active</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="referal_code" class="form-label">Refferal Code</label>
                                            <input readonly id="referal_code" type="text" class="form-control" name="referal_code" value="{{ $data->referal_code }}">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="referal_code_upline" class="form-label">Upline Code</label>
                                            <input readonly id="referal_code_upline" type="text" class="form-control" name="referal_code_upline" value="{{ $data->referal_code_upline }}">
                                        </div>                                        
                                        <div class="col-md-3">
                                            <label for="phone" class="form-label">No Telp</label>
                                            <input readonly id="phone" type="text" class="form-control" name="phone" value="{{ $data->phone }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input readonly id="email" type="email" class="form-control" name="email" value="{{ $data->email }}" required autocomplete="email">
                                        </div>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                                                                
                                        <div  class="col-md-2">
                                            <label for="roles" class="form-label">Level</label>
                                            <input readonly id="roles" type="roles" class="form-control" name="roles" 
                                            value="@if($data->roles==0)Agent @elseif($data->roles==1)Member @elseif($data->roles==2)Affiliator @elseif($data->roles==3)Agen Request @endif" >
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <label for="address" class="form-label">Alamat</label>
                                            <input readonly id="address" type="text" class="form-control" name="address" value="{{ $data->address }}" autocomplete="none">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="city" class="form-label">Kota/Kabupaten</label>
                                            <input readonly id="city" type="text" class="form-control" name="city" value="{{ $data->city }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="province" class="form-label">Provinsi</label>
                                            <input readonly id="province" type="text" class="form-control" name="province" value="{{ $data->province }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="poscode" class="form-label">Kode Pos</label>
                                            <input readonly id="poscode" type="text" class="form-control" name="poscode" value="{{ $data->poscode }}">
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <hr class="mt-4">
                                        </div>

                                        <div class="col-md-3">
                                            <label for="npwp" class="form-label">NPWP</label>
                                            <input readonly id="npwp" type="text" class="form-control" name="npwp" value="{{ $data->npwp }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="bank" class="form-label">Nama Bank</label>
                                            <input readonly id="bank" type="text" class="form-control" name="bank" value="{{ $data->bank }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="account_name" class="form-label">Nama Pemilik</label>
                                            <input readonly id="account_name" type="text" class="form-control" name="account_name" value="{{ $data->account_name }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="account_number" class="form-label">No Rekening</label>
                                            <input readonly id="account_number" type="text" class="form-control" name="account_number" value="{{ $data->account_number }}">
                                        </div>
                                        <div class="col-md-12">
                                            <hr class="mt-4">
                                            <button class="btn btn-primary" type="submit">Simpan</button>
                                            <a class="btn btn-warning" href="{{ route('dashboard.userdata.affliator') }}" role="button">Back</a>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>            


@endsection