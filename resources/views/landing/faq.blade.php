@extends('landing.layouts.app')

<!-- set title -->
@section('title', 'FAQs')

@section('content')

        <section class="wrapper bg-warning px-0 pb-6 mt-0 min-vh-8">
            <div class="containerv pb-10 pt-md-2 pb-md-10">
            </div>
        </section>
    
        <section id="snippet-3" class="wrapper bg-light wrapper-border">
            <div class="container pt-15 pt-md-17 pb-13 pb-md-15">
                <h2 class="display-4 mb-3 text-center">FAQs</h2>
                <p class="lead text-center mb-10 px-md-16 px-lg-0">Silakan kirim email kepada kami jika tidak menemukan jawaban atas pertanyaan anda</p>
                @foreach ($faqs as $d)
                <div class="row">
                    <div class="col-lg-12 mb-0">
                        <div id="accordion-1" class="accordion-wrapper">
                            <div class="card accordion-item">
                                <div class="card-header" id="accordion-heading-1-1-{{ $d->id }}">
                                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-1-1-{{ $d->id }}" aria-expanded="false" aria-controls="accordion-collapse-1-1-{{ $d->id }}">{{ $d->title }}</button>
                                </div>
                                <!-- /.card-header -->
                                <div id="accordion-collapse-1-1-{{ $d->id }}" class="collapse" aria-labelledby="accordion-heading-1-1-{{ $d->id }}" data-bs-target="#accordion-1">
                                <div class="card-body">
                                    <p>{{ $d->desc }}</p>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>    
        </section>

@endsection