@extends('admin.layouts.app')
<!-- set title -->
@section('title')


@section('content')

                    <div class="row">
                        <div id="browser_default" class="col-lg-12 layout-spacing col-md-12 mt-4 ">
                            <div id="browser_default" class="col-lg-12 layout-spacing col-md-12 mt-0">
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

                                <form method="POST" action="{{ route('dashboard.landingdata.storefaq') }}" enctype="multipart/form-data" class="row g-3">
                                @csrf

                                    <div id="tableBordered" class="col-lg-12 col-12 layout-spacing">
                                        <div class="statbox widget box box-shadow">
                                            <div class="widget-header">
                                                <div class="row">
                                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                        <h4>Add New FAQs</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content widget-content-area">

                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" width="35%">Title</th>
                                                                <th scope="col" >Description</th>
                                                                <th class="text-center" scope="col">Action</th>
                                                            </tr>
                                                            <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="">
                                                                    <input type="text" name="addMoreInputFields[0][title]" class="form-control" required>
                                                                </td>
                                                                <td class="">
                                                                    <textarea name="addMoreInputFields[0][desc]" id="desc" cols="80" rows="4" class="form-control" required></textarea>
                                                                </td>
                                                                <td class="text-center">
                                                                    <button type="button" name="add" id="add" class="badge badge-light-success">Add More</button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <button class="btn btn-primary" type="submit">Submit Data</button>
                                                    <a class="btn btn-warning" href="{{ route('dashboard.landingdata.faq') }}" role="button">Back</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

@push('after-script')
<script>
    var i = 0;
    $('#add').click(function() {
        ++i
        $('#table').append(
            '<tr>' +
                '<td><input type="text" name="addMoreInputFields['+i+'][title]" class="form-control" /></td>' +
                '<td class=""><textarea name="addMoreInputFields['+i+'][desc]" class="form-control cols="80" rows="4"></textarea></td>' +
                '<td class="text-center"><button type="button" class="badge badge-light-danger remove-table-row"> Remove </button></td>' +
            '</tr>'
        );
    });
    
    $(document).on('click','.remove-table-row', function(){
        $(this).parents('tr').remove();
    });
</script>    
@endpush

@endsection