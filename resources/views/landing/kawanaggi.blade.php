@extends('landing.layouts.app')

<!-- set title -->
@section('title', 'Kawan AGGIKU')

@section('content')

            <section class="wrapper bg-warning px-0 pb-6 mt-0 min-vh-8">
                <div class="containerv pb-10 pt-md-2 pb-md-10">
                </div>
            </section>

            <section class="wrapper bg-light">
                <div class="container pt-15 pt-md-17">
                    <div class="row text-center">
                        <div class="col-lg-10 mx-auto position-relative">
                            <div class="position-relative">
                                <div class="shape pale-pink rellax w-18 h-18" data-rellax-speed="1" style="top: 1rem; left: -4.2rem;">
                                <img src="{{ asset('/img/landing/hex.svg') }}" class="svg-inject icon-svg w-100 h-100" alt="" />
                                </div>
                                <div class="shape pale-primary rellax w-18 h-18" data-rellax-speed="1" style="bottom: 2rem; right: -3.5rem;">
                                <img src="{{ asset ('/img/landing/circle.svg') }}" class="svg-inject icon-svg w-100 h-100" alt="" />
                                </div>
                                <video poster="{{ asset('/img/landing/'.$landing->kawan_content_video_img) }}" class="player" playsinline controls preload="none">
                                <source src="{{ asset('/img/landing/'.$landing->kawan_content_video) }}" type="video/mp4">
                                <source src="{{ asset('/img/landing/'.$landing->kawan_content_video) }}" type="video/webm">
                                </video>
                            </div>
                        </div>
                        <!--/column -->
                    </div>
                    <!--/.row -->
                    <div class="row text-center mt-12">
                        <div class="col-lg-10 mx-auto mb-4">
                        <h2 class="fs-16 text-uppercase text-muted mb-3">{{ $landing->kawan_content_title }}</h2>
                        <h3 class="display-3 text-center px-xl-10 px-xxl-15 mb-10">{{ $landing->kawan_content_title_2 }}</h3>
                            <div class="row gx-lg-8 gx-xl-12 process-wrapper arrow text-center">
                                <div class="col-md-4 mb-2"> <img src="{{ asset('/img/landing/'.$landing->kawan_content_svg_1) }}" class="svg-inject icon-svg icon-svg-sm solid-duo text-purple-pink mb-4" alt="" />
                                <h3 class="fs-22">1. {{ $landing->kawan_content_title_svg_1 }}</h3>
                                <p>{{ $landing->kawan_content_desc_svg_1 }}</p>
                                </div>
                                <!--/column -->
                                <div class="col-md-4 mb-2"> <img src="{{ asset('/img/landing/'.$landing->kawan_content_svg_2) }}" class="svg-inject icon-svg icon-svg-sm solid-duo text-purple-pink mb-4" alt="" />
                                <h3 class="fs-22">2. {{ $landing->kawan_content_title_svg_2 }}</h3>
                                <p>{{ $landing->kawan_content_desc_svg_2 }}</p>
                                </div>
                                <!--/column -->
                                <div class="col-md-4 mb-2"> <img src="{{ asset('/img/landing/'.$landing->kawan_content_svg_3) }}" class="svg-inject icon-svg icon-svg-sm solid-duo text-purple-pink mb-4" alt="" />
                                <h3 class="fs-22">3. {{ $landing->kawan_content_title_svg_3 }}</h3>
                                <p>{{ $landing->kawan_content_desc_svg_3 }}</p>
                                </div>
                                <!--/column -->
                            </div>
                            <!--/.row -->
                            <div class="d-flex justify-content-center my-6">
                                <span><a href="{{ route('register') }}" class="btn btn-sm btn-primary rounded">Bergabung Sekarang</a></span>
                            </div>
                            <!-- /column -->
                        </div>
                        <figure><img src="{{ asset('/img/landing/'.$landing->kawan_content_img) }}" srcset="{{ asset('/img/landing/'.$landing->kawan_content_img) }}" alt="" /></figure>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container -->
            </section>


@endsection