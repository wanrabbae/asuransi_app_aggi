@extends('landing.layouts.app')

<!-- set title -->
@section('title', 'Artikel')

@section('content')

        <section class="wrapper bg-warning px-0 pb-6 mt-0 min-vh-8">
            <div class="containerv pb-10 pt-md-2 pb-md-10">
            </div>
        </section>

        <section class="wrapper bg-light">
            <div class="container py-14 py-md-16">
                <div class="row">
                    <div class="col-lg-10 mx-auto">
                        <div class="blog grid grid-view">
                            <div class="row isotope gx-md-8 gy-8 mb-8">
                                @foreach ($artikel as $d)
                                <article class="item post col-md-6">
                                    <div class="card">
                                        <figure class="card-img-top overlay overlay-1 hover-scale"><a href="{{ asset('read/'. $d->slug) }}"> <img style="max-height: 320px;" src="{{ asset('/img/artikel/'.$d->artikel_img) }}" alt="" /></a>
                                        <figcaption>
                                            <h5 class="from-top mb-0">Read More</h5>
                                        </figcaption>
                                        </figure>
                                        <div class="card-body">
                                        <div class="post-header">
                                            <div class="post-category text-line">
                                            <a href="{{ asset('read/'. $d->slug) }}" class="hover" rel="category">{{ $d->category->name }}</a>
                                            </div>
                                            <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark" href="{{ asset('read/'. $d->slug) }}">{{ ($d->title) }}</a></h2>
                                        </div>
                                        <div class="post-content">
                                            <p>{!! Str::limit($d->description, 150) !!}</p>
                                        </div>
                                        </div>
                                        <div class="card-footer">
                                        <ul class="post-meta d-flex mb-0">
                                            <li class="post-date"><i class="uil uil-calendar-alt"></i><span>{{ tanggal_local($d->created_at) }}</span></li>
                                        </ul>
                                        </div>
                                    </div>
                                </article>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>




@endsection