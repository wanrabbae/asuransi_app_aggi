@extends('landing.layouts.app')

<!-- set title -->
@section('title', 'Klaim')

@section('content')

    <section class="wrapper bg-warning px-0 pb-6 mt-0 min-vh-8">
        <div class="containerv pb-10 pt-md-2 pb-md-10">
        </div>
    </section>

    <section class="wrapper bg-light">
        <div class="container pt-15 pt-md-15 pb-15 pb-md-15">

            <div class="row text-center mb-10">
                <div class="col-md-10 col-lg-9 col-xxl-8 mx-auto">
                    <h3 class="display-6 px-xl-10 mb-0">{{ $landing->title_body_klaim }}</h3>
                    <h2 class="fs-18 text-uppercase text-muted mb-3 mt-4">{{ $landing->desc_body_klaim }}</h2>
                </div>
            </div>
            <div class="row gx-lg-8 gx-xl-12 gy-6 process-wrapper line">
                <div class="col-md-6 col-lg-3"> <span class="icon btn btn-circle btn-lg btn-primary pe-none mb-4"><span class="number">01</span></span>
                    <h4 class="mb-1">{{ $landing->title_step_1_klaim }}</h4>
                    <p>{{ $landing->desc_step_1_klaim }}</p>
                </div>
                <div class="col-md-6 col-lg-3"> <span class="icon btn btn-circle btn-lg btn-primary pe-none mb-4"><span class="number">02</span></span>
                    <h4 class="mb-1">{{ $landing->title_step_2_klaim }}</h4>
                    <p>{{ $landing->desc_step_2_klaim }}</p>
                </div>
                <div class="col-md-6 col-lg-3"> <span class="icon btn btn-circle btn-lg btn-primary pe-none mb-4"><span class="number">03</span></span>
                    <h4 class="mb-1">{{ $landing->title_step_3_klaim }}</h4>
                    <p>{{ $landing->desc_step_3_klaim }}</p>
                </div>
                <div class="col-md-6 col-lg-3"> <span class="icon btn btn-circle btn-lg btn-primary pe-none mb-4"><span class="number">04</span></span>
                    <h4 class="mb-1">{{ $landing->title_step_4_klaim }}</h4>
                    <p>{{ $landing->desc_step_4_klaim }}</p>
                </div>
            </div>


            <div class="container pt-8 pt-md-8 pb-8 pb-md-8">
                <div class="row mb-2">
                    <div class="col-lg-8 mx-auto text-center">
                        <h2 class="fs-16 text-uppercase text-primary mb-3">Klaim Form</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 mx-auto">
                        <form action="/product/claim/download/" method="get">
                            <div class="form input-group">
                                <select class="form-select" name="id" aria-label="Default select example">
                                    <option selected>Pilih Produk</option>
                                    @foreach ($products as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary" type="submit">Unduh</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>





@endsection
