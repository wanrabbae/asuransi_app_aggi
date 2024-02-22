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
                                            <h4>Add New Data</h4>
                                        </div>                 
                                    </div>
                                </div>
                               
                                <div class="widget-content widget-content-area p-4">
                                    <form method="POST" action="{{ route('dashboard.expensedata.store') }}" enctype="multipart/form-data" class="row g-3">
                                    @csrf
                                        <div class="col-md-4">
                                            <label for="nota_number" class="form-label">No Nota</label>
                                            <input id="nota_number" type="text" value="{{ old('nota_number') }}" class="form-control" name="nota_number" required >
                                        </div>
                                        <div class="col-md-4">
                                            <label for="name" class="form-label">Nama</label>
                                            <input id="name" type="text" value="{{ old('name') }}" class="form-control" name="name" required autocomplete="none">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="amount" class="form-label">Jumlah</label>
                                            <input id="amount" type="number" value="{{ old('amount') }}" class="form-control" name="amount" required autocomplete="none">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="pic" class="form-label">PIC</label>
                                            <input id="pic" type="text" value="{{ old('pic') }}" class="form-control" name="pic" required autocomplete="none">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="date" class="form-label">Tanggal Nota</label>
                                            <input id="date" type="date" value="{{ old('date') }}" class="form-control" name="date" required autocomplete="none">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="img" class="form-label">Images Nota</label>
                                            <input id="img" type="file" accept="image/*" class="form-control" name="img" required >
                                        </div>                                      
                                        
                                        <div class="col-md-12">
                                            <label for="description">Description</label>
                                            <textarea  type="text" class="form-control mb-3" id="description" name="description" rows="2">{{ old('description') }}</textarea>                                            
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