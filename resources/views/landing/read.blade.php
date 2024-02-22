@extends('landing.layouts.app')

<!-- set title -->
@section('title', 'Artikel')

@section('content')

        <section class="wrapper bg-warning px-0 pb-6 mt-0 min-vh-8">
            <div class="containerv pb-10 pt-md-2 pb-md-10">
            </div>
        </section>

        <section class="wrapper bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 mx-auto">
                        <div class="blog single mt-0">
                            <div class="card bg-none">
                                <div class="card-body">
                                    <div class="">
                                        <article class="post">
                                            <div class="post-content mb-5">
                                                <h2 class="h2 mb-4 text-center">{{ ($artikel->title) }}</h2>
                                                 <div class="row g-6 mt-3 mb-10">
                                                    <div class="col-md-12">
                                                        <figure class="hover-scale rounded cursor-dark"><a href="{{ asset('/img/artikel/'.$artikel->artikel_img) }}" data-glightbox="description: {{ ($artikel->title) }}" data-gallery="post"> <img src="{{ asset('/img/artikel/'.$artikel->artikel_img) }}" alt="" /></a></figure>
                                                    </div>
                                                </div>
                                                <blockquote class="fs-18 my-8" style="text-align: justify;">
                                                <p>{!! ($artikel->description) !!}</p>
                                                <footer class="blockquote-footer">AGGIKU</footer>
                                                </blockquote>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="container py-10 py-md-10">
                <div class="swiper-container nav-bottom nav-color mb-14" data-margin="30" data-dots="false" data-nav="true" data-items-lg="3" data-items-md="2" data-items-xs="1">
                    <div class="swiper overflow-visible pb-2">
                        <div class="swiper-wrapper">
                            @foreach ($readartikel as $d)
                            <div class="swiper-slide">
                                <article>
                                    <div class="card shadow-lg">
                                    <figure class="card-img-top overlay overlay-1"><a href="{{ asset('read/'. $d->slug) }}"> <img style="max-height: 280px;" src="{{ asset('/img/artikel/'.$d->artikel_img) }}" alt="" /></a>
                                        <figcaption>
                                        <h5 class="from-top mb-0">Read More</h5>
                                        </figcaption>
                                    </figure>
                                    <div class="card-body p-6">
                                        <div class="post-header">
                                        <div class="post-category">
                                            <a href="{{ asset('read/'. $d->slug) }}" class="hover" rel="category">{{ $d->category->name }}</a>
                                        </div>
                                        <!-- /.post-category -->
                                        <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark" href="{{ asset('read/'. $d->slug) }}">{{ Str::limit($d->title, 50) }}</a></h2>
                                        </div>
                                        <!-- /.post-header -->
                                        <div class="post-footer">
                                        <ul class="post-meta d-flex mb-0">
                                            <li class="post-date"><i class="uil uil-calendar-alt"></i><span>{{ tanggal_local($d->created_at) }}</span></li>
                                        </ul>
                                        <!-- /.post-meta -->
                                        </div>
                                        <!-- /.post-footer -->
                                    </div>
                                    <!--/.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </article>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection