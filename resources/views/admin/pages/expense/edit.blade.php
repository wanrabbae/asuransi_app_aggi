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
                                            <h4>Edit Nota {{ $data->nota_number }}</h4>
                                        </div>                 
                                    </div>
                                </div>
                               
                                <div class="widget-content widget-content-area p-4">
                                    <form method="POST" action="{{ route('dashboard.expensedata.update',[$data->id]) }}" enctype="multipart/form-data" class="row g-3">
                                    @csrf
                                    @method('PUT')
                                        <div class="col-md-4">
                                            <label for="nota_number" class="form-label">No Nota</label>
                                            <input value="{{ $data->nota_number }}" id="nota_number" type="text" class="form-control" name="nota_number" required >
                                        </div>
                                        <div class="col-md-4">
                                            <label for="name" class="form-label">Nama</label>
                                            <input value="{{ $data->name }}" id="name" type="text" class="form-control" name="name" required autocomplete="none">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="amount" class="form-label">Jumlah</label>
                                            <input value="{{ $data->amount }}" id="amount" type="number" class="form-control" name="amount" required >
                                        </div>
                                        <div class="col-md-4">
                                            <label for="pic" class="form-label">PIC</label>
                                            <input value="{{ $data->pic }}" id="pic" type="text" class="form-control" name="pic" required >
                                        </div>
                                        <div class="col-md-4">
                                            <label for="date" class="form-label">Tanggal Nota</label>
                                            <input value="{{ $data->date }}" id="date" type="date" class="form-control" name="date" required >
                                        </div>
                                        <div class="col-md-4">
                                            <label for="img" class="form-label">Images Nota</label>
                                            <input value="{{ $data->img }}" id="img" accept="image/*" type="file" class="form-control" name="img">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="description">Description</label>
                                            <textarea  type="text" class="form-control mb-3" id="description" name="description" rows="2">{{ $data->description }}</textarea>                                            
                                        </div>                                          
                                        
                                        <div class="col-md-6">
                                            <button class="btn btn-primary" type="submit">Submit Product</button>
                                            <a class="btn btn-warning" href="{{ route('dashboard.expensedata.index') }}" role="button">Back</a>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


@endsection