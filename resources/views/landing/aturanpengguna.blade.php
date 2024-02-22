@extends('landing.layouts.app')

<!-- set title -->
@section('title', 'Aturan Pengguna')

@section('content')

            <section class="wrapper bg-warning px-0 pb-6 mt-0 min-vh-8">
                <div class="containerv pb-10 pt-md-2 pb-md-10">
                </div>
            </section>

            <section class="wrapper bg-light">
                <div class="container py-5 px-2 py-md-5">
                    <div class="col-md-12 col-lg-12 col-xxl-12 mx-auto text-center" data-cues="zoomIn" data-group="page-title" data-interval="-200">
                        <h3 class="display-1  mb-4">{!! $landing->aturan_title !!}</h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <p class="mb-3">{!! $landing->aturan_desc !!}</p>
                        </div>
                    </div>
                </div>
            </section>

@endsection