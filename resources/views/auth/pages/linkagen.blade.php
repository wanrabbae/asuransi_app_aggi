@extends('auth.layouts.app')
<!-- set title -->
@section('title')

@section('content')

    <div class="middle-content container-xxl p-0">
        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 ">
                <div class="usr-tasks ">
                    <div class="widget-content widget-content-area">
                        <h3 class="wallet-title">Polis Refferal</h3>
                        <div class="table-responsive" style="margin-bottom: 45px;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Page</th>
                                        <th class="text-center" width="65%">Link</th>
                                    </tr>
                                    <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                </thead>
                                <tbody>
                                    @foreach ($link as $d)
                                    <tr>
                                        <td>{{ $d->name }}</td>
                                        <td>
                                            <p class="text-danger text-center">
                                                <div class="clipboard-input">
                                                    <input readonly type="text" class="form-control text-black" id="copy-basic-input{{$d->id}}"
                                                    value="{{ env('APP_URL') }}{{ $d->type_product == '1' ? 'offlinedetails' : 'onlinedetails' }}/{{ $d->slug }}?referalCode={{ Auth::user()->referal_code }}">
                                                    <div class="copy-icon jsclipboard cbBasic" data-bs-trigger="click" title="Copied" data-clipboard-target="#copy-basic-input{{$d->id}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-copy">
                                                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </p>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('after-script')
        <script src="{{ asset('/back') }}/src/plugins/src/clipboard/clipboard.min.js"></script>
        <script src="{{ asset('/back') }}/src/plugins/src/clipboard/custom-clipboard.min.js"></script>
    @endpush
@endsection
