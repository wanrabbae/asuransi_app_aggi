@extends('landing.layouts.app')

@section('title', 'Home')

@section('content')

    <section class="video-wrapper bg-overlay bg-overlay-gradient px-0 mt-0 min-vh-80">
        <video poster="{{ asset('/img/landing/' . $landing->head_image) }}" src="{{ asset('/img/landing/' . $landing->head_image) }}"></video>
        <div class="video-content">
            <div class="container text-center">
                <div class="row">
                    <div class="col-lg-8 col-xl-6 text-center text-white mx-auto">
                        <h1 class="display-1 fs-54 text-white mb-5"><span class="rotator-zoom">{{ $landing->head_title }}</span></h1>
                        <p class="lead fs-24 mb-0 mx-xxl-8">{{ $landing->head_desc }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="wrapper bg-light">
        @foreach ($popup01 as $item)  
        @if ($item->status == 0)
        <div class="modal fade modal-popup" id="modal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content text-center">
                    <div class="modal-body">
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="row">
                            <div class="col-md-12">
                                <figure><img src="{{ asset('/img/landing/' . $item->popup) }}" alt="" /></figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        @endif
        @endforeach
        

        <div class="container py-8 py-md-8">
            <div class="row">
                <div class="col-md-10 col-lg-8 col-xl-7 col-xxl-6 mx-auto text-center">
                    <h3 class="fs-15 text-uppercase text-muted mb-3">{{ $landing->title_product }}</h3>
                    <h4 class="display-4 mb-10">{{ $landing->title_product_2 }}</h4>
                </div>
            </div>
            <div class="position-relative">
                <div class="row gx-md-8 gx-xl-10">
                    @foreach ($onlineproduct as $d)
                        <div class="col-lg-6  mb-4">
                            <div class="card bg-soft-leaf">
                                <div class="col-md-12 col-lg-12">
                                    <div class="pricing card text-center">
                                        <div class="card-body mb-5">

                                            <img src="{{ asset('/img/landing/' . $d->icon) }}" class="svg-inject icon-svg icon-svg-md text-primary mb-3" alt="" />
                                            <br>
                                            <h4 class="card-title">{{ $d->name }}</h4>
                                                <div class="prices text-dark">
                                                    <div class="price price-show"><span class="price-currency">Rp. </span><span class="price-value">{{ $d->price_show }}</span> <span
                                                            class="price-duration">/ Tahun</span></div>
                                                </div>
                                                <!--/.prices -->
                                                <div class="mt-7 mb-8 text-start">
                                                    {!! $d->description !!}
                                                </div>
                                                <a href="{{ asset('onlinedetails/' . $d->slug) }}" class="btn btn-outline-gradient gradient-3 px-8 mb-4">Ajukan</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/.card -->
                        </div>
                    @endforeach
                    <!-- /column -->
                </div>
            </div>
        </div>
    </section>

    <section class="wrapper bg-light">
        <div class="container py-15 py-md-12">
            <div class="row">
                <div class="col-md-10 col-lg-8 col-xl-7 col-xxl-6 mx-auto text-center">
                    <h2 class="fs-15 text-uppercase text-muted mb-3">PRODUK ASURANSI AGGIKU</h2>
                    <h3 class="display-4 mb-10">Asuransi Sesuai Kebutuhan Anda</h3>
                </div>
            </div>
            <div class="position-relative">
                <div class="shape rounded-circle bg-soft-blue rellax w-16 h-16" data-rellax-speed="1" style="bottom: -0.5rem; right: -2.2rem; z-index: 0;"></div>
                <div class="shape bg-dot primary rellax w-16 h-17" data-rellax-speed="1" style="top: -0.5rem; left: -2.5rem; z-index: 0;"></div>
                <div class="row gx-md-5 gy-5 text-center">
                    @foreach ($offlineproduct as $d)
                        <div class="col-md-6 col-xl-3">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <img src="{{ asset('/img/landing/' . $d->icon) }}" class="svg-inject icon-svg icon-svg-md text-yellow mb-3" alt="" />
                                    <h6>{{ $d->name }}</h6>
                                    <a href="{{ asset('offlinedetails/' . $d->slug) }}" class="more hover link-yellow">Ajukan</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="wrapper bg-light">
        <div class="container py-15 py-md-12">
            <div class="row gx-lg-8 gx-xl-12 gy-10 mb-4 mb-md-4 align-items-center">
                <div class="col-md-8 col-lg-6 position-relative">
                    <div class="shape bg-soft-primary rounded-circle rellax w-20 h-20" data-rellax-speed="1" style="top: -2rem; left: -1.9rem;"></div>
                    <figure class="rounded"><img src="{{ asset('/img/landing/' . $landing->image_join) }}" srcset="{{ asset('/img/landing/' . $landing->image_join) }}" alt=""></figure>
                </div>
                <div class="col-lg-6">
                    <h2 class="display-5 mb-3">{{ $landing->title_join }}</h2>
                    <p class="mb-6">{{ $landing->desc_join }}</p>
                    <div class="row gx-xl-10 gy-6">
                        <div class="col-md-6">
                            <div class="d-flex flex-row">
                                <div>
                                    <img src="{{ asset('img/landing/target.svg') }}" class="svg-inject icon-svg icon-svg-sm me-4" alt="" />
                                </div>
                                <div>
                                    <h4 class="mb-1">{{ $landing->title_join_1 }}</h4>
                                    <p class="mb-0">{{ $landing->join_1 }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex flex-row">
                                <div>
                                    <img src="{{ asset('img/landing/award-2.svg') }}" class="svg-inject icon-svg icon-svg-sm me-4" alt="" />
                                </div>
                                <div>
                                    <h4 class="mb-1">{{ $landing->title_join_2 }}</h4>
                                    <p class="mb-0"> {{ $landing->join_2 }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-md-4 text-center ">
                            <a href="{{ route('kawan-aggi') }}" class="btn btn-outline-gradient gradient-3 px-8">Info lengkap</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="wrapper bg-light">
        <div class="overflow-hidden">
            <div class="container py-10 py-md-10">
                <div class="row">
                    <div class="col-xl-7 col-xxl-6 mx-auto text-center">
                        <i class="icn-flower text-leaf fs-30 opacity-25"></i>
                        <h2 class="display-5 text-center mt-2 mb-10">ARTIKEL - AGGIKU</h2>
                    </div>
                </div>
                <div class="swiper-container nav-bottom nav-color mb-14" data-margin="30" data-dots="false" data-nav="true" data-items-lg="3" data-items-md="2" data-items-xs="1">
                    <div class="swiper overflow-visible pb-2">
                        <div class="swiper-wrapper">
                            @foreach ($artikel as $d)
                                <div class="swiper-slide">
                                    <article>
                                        <div class="card shadow-lg">
                                            <figure class="card-img-top overlay overlay-1"><a href="{{ asset('read/' . $d->slug) }}"> <img style="max-height: 280px;"
                                                        src="{{ asset('/img/artikel/' . $d->artikel_img) }}" alt="" /></a>
                                                <figcaption>
                                                    <h5 class="from-top mb-0">Read More</h5>
                                                </figcaption>
                                            </figure>
                                            <div class="card-body p-6">
                                                <div class="post-header">
                                                    <div class="post-category">
                                                        <a href="{{ asset('read/' . $d->slug) }}" class="hover" rel="category">{{ $d->category->name }}</a>
                                                    </div>
                                                    <!-- /.post-category -->
                                                    <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark" href="{{ asset('read/' . $d->slug) }}">{{ Str::limit($d->title, 50) }}</a></h2>
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
