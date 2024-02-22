@extends('auth.layouts.app')
<!-- set title -->
@section('title')

    @push('after-style')
        <link href="{{ asset('/back') }}/src/assets/css/light/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/back') }}/src/assets/css/dark/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
    @endpush

@section('content')
    
    
    @if (auth()->user()->roles == 0)
        @foreach ($popup04 as $item)  
        @if ($item->status == 0)
        <div id="welcomeModal" class="modal animated fadeInUp custo-fadeInUp" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <!-- Modal content-->
                <div class="modal-content text-end">
                    <div class="modal-body">
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{ asset('/img/landing/' . $item->popup) }}" alt="Welcome Image" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
        @endif
        @endforeach 
        <div class="middle-content container-xxl p-0">
            <div class="row layout-top-spacing">
                @if (session()->has('success'))
                    <div class="alert alert-success p-2 my-2" role="alert">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger p-2 my-2" role="alert">
                        {{ session()->get('error') }}
                    </div>
                @endif
                <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-wallet-one">
                        @if (session()->has('success'))
                            <div class="alert alert-success p-2 my-2" role="alert">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger p-2 my-2" role="alert">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        <div class="wallet-info text-center mb-3 mt-3">
                            <p class="wallet-title mb-3">Total Poin Aktif</p>
                            <p class="total-amount mb-3">{{ number_format($poinAktif ?? 0, 0, ',', '.') }}</p>
                        </div>

                        <div class="wallet-action text-center d-flex justify-content-around mb-4">
                            <a class="btn btn-success" href="" role="button" data-bs-toggle="modal" data-bs-target="#agentregisterModal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 16 16 12 12 8"></polyline>
                                    <line x1="8" y1="12" x2="16" y2="12"></line>
                                </svg>
                                <span class="btn-text-inner">Redeem</span>
                            </a>
                        </div>
                        <!-- Modal Create -->
                        <div class="modal fade register-modal" id="agentregisterModal" tabindex="-1" role="dialog" aria-labelledby="agentregisterModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header mt-2" id="agentregisterModalLabel">
                                        <h4 class="modal-title">Redeem Request</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-x">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('dashboard.requestRedeem') }}" class="mt-0">
                                            @csrf
                                            <div class="form-group">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-right">
                                                    <polyline points="13 17 18 12 13 7"></polyline>
                                                    <polyline points="6 17 11 12 6 7"></polyline>
                                                </svg>
                                                <input placeholder="Amount" id="jumlah" type="number" class="form-control mb-2" name="jumlah" value="{{ old('jumlah') }}" required>
                                                <input type="hidden" value="{{ $poinAktif }}">
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-2 mb-2 w-100">Submit Request</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="wallet-action text-center d-flex justify-content-around">
                            <div class="media-body">
                                <h6 class="">Total Poin Didapat</h6>
                                <span>{{ number_format($sumAllCommission ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="media-body">
                                <h6 class="">Total Poin Diterima</h6>
                                <span>{{ number_format($sumAllRedeemPoin ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        @if (Auth::user()->roles == 2 || Auth::user()->roles == 3 || Auth::user()->roles == 0)
                            <div class="card bg-secondary mb-4 mt-4">
                                <div class="card-body">
                                    <p class="mb-0 text-center">Sebarkan link refferal anda dan dapatkan bonus</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12">
                    <div class="widget widget-wallet-one">
                        <h4>Refferal</h4>
                        <div class="table-responsive mb-0 mt-1" >
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Status Polis</th>
                                        <th class="text-center" width="15%">Jumlah</th>
                                    </tr>
                                    <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Total Referal</td>
                                        <td>
                                            <p class="text-danger text-center">{{ $totalReferal }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total Polis</td>
                                        <td>
                                            <p class="text-danger text-center">{{ $totalPolisReferal }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Polis Aktif</td>
                                        <td>
                                            <p class="text-danger text-center">{{ $totalPolisReferalAktif }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Polis tidak Aktif</td>
                                        <td>
                                            <p class="text-danger text-center">{{ $totalPolisReferalTidakAktif }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Polis dalam proses</td>
                                        <td>
                                            <p class="text-danger text-center">{{ $totalPolisDalamProses }}</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>            
        </div>        
    @elseif (auth()->user()->roles == 1)
        <!-- Welcome Popup Modal -->
        @foreach ($popup02 as $item)  
        @if ($item->status == 0)
        <div id="welcomeModal" class="modal animated fadeInUp custo-fadeInUp" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <!-- Modal content-->
                <div class="modal-content text-end">
                    <div class="modal-body">
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{ asset('/img/landing/' . $item->popup) }}" alt="Welcome Image" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
        @endif
        @endforeach
        <div class="middle-content container-xxl p-0">
            <div class="row layout-top-spacing">
                @if (session()->has('success'))
                    <div class="alert alert-success p-2 my-2" role="alert">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger p-2 my-2" role="alert">
                        {{ session()->get('error') }}
                    </div>
                @endif

                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-card-four">
                        <a href="{{ route('dashboard.unpaid') }}">
                        <div class="widget-content">
                            <div class="w-header">
                                <div class="w-info">
                                    <h6 class="value">MENUNGGU PEMBAYARAN</h6>
                                </div>
                            </div>
                            <div class="w-content">
                                <div class="w-info">
                                    <p class="value fs-5">{{ $totalPolisPending }} <span>- online polis</span></p>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-card-four">
                        <a href="{{ route('dashboard.process') }}">
                        <div class="widget-content">
                            <div class="w-header">
                                <div class="w-info">
                                    <h6 class="value">POLIS DALAM PROSES</h6>
                                </div>
                            </div>
                            <div class="w-content">
                                <div class="w-info">
                                    <p class="value fs-5">{{ $totalPolisDalamProsesUser }} <span>- online polis</span></p>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-card-four">
                        <a href="{{ route('dashboard.active') }}">
                        <div class="widget-content">
                            <div class="w-header">
                                <div class="w-info">
                                    <h6 class="value">POLIS AKTIF</h6>
                                </div>
                            </div>
                            <div class="w-content">
                                <div class="w-info">
                                    <p class="value fs-5">{{ $totalPolisAktif }} <span>- online polis</span></p>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-card-four">
                        <a href="{{ route('dashboard.offunpaid') }}">
                        <div class="widget-content">
                            <div class="w-header">
                                <div class="w-info">
                                    <h6 class="value">MENUNGGU PEMBAYARAN</h6>
                                </div>
                            </div>
                            <div class="w-content">
                                <div class="w-info">
                                    <p class="value fs-5">{{ $totalPolisPendingOff }} <span>- offline polis</span></p>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-card-four">
                        <a href="{{ route('dashboard.offpolisprocess') }}">
                        <div class="widget-content">
                            <div class="w-header">
                                <div class="w-info">
                                    <h6 class="value">POLIS DALAM PROSES</h6>
                                </div>
                            </div>
                            <div class="w-content">
                                <div class="w-info">
                                    <p class="value fs-5">{{ $totalPolisDalamProsesUserOff }} <span>- offline polis</span></p>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-card-four">
                        <a href="{{ route('dashboard.offactive') }}">
                        <div class="widget-content">
                            <div class="w-header">
                                <div class="w-info">
                                    <h6 class="value">POLIS AKTIF</h6>
                                </div>
                            </div>
                            <div class="w-content">
                                <div class="w-info">
                                    <p class="value fs-5">{{ $totalPolisAktifOff }} <span>- offline polis</span></p>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-4">
                    <div class="usr-tasks ">
                        <div class="widget-content widget-content-area">
                            <h3 class="wallet-title">Polis Online Anda</h3>
                            <div class="table-responsive" style="margin-bottom: 3px;">
                                <table class="table table-bordered">
                                    <thead>                                        
                                        <tr>
                                            <th>Status Polis</th>
                                            <th class="text-center" width="15%">Jumlah</th>
                                        </tr>
                                        <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="{{ route('dashboard.polis') }}">Total Polis</a></td>
                                            <td class="text-danger text-center"><span>{{ $totalPolis }}</span></td>
                                        </tr>
                                        <tr>
                                            <td><a href="{{ route('dashboard.active') }}">Polis Aktif</a></td>
                                            <td class="text-danger text-center"><span class="text-danger text-center">{{ $totalPolisAktif }}</span></td>
                                        </tr>
                                        <tr>
                                            <td><a href="{{ route('dashboard.expired') }}">Polis tidak Aktif</a></td>
                                            <td class="text-danger text-center"><span class="text-danger text-center">{{ $totalPolisTidakAktif }}</span></td>
                                        </tr>
                                        <tr>
                                            <td><a href="{{ route('dashboard.followup') }}">Polis jatuh tempo</a></td>
                                            <td class="text-danger text-center"><span class="text-danger text-center">{{ $totalPolisJatuhTempo }}</span></td>
                                        </tr>
                                        <tr>
                                            <td><a href="{{ route('dashboard.process') }}">Polis sedang dibuat</a></td>
                                            <td class="text-danger text-center"><span class="text-danger text-center">{{ $totalPolisDalamProsesUser }}</span></td>
                                        </tr>
                                        <tr>
                                            <td><a href="{{ route('dashboard.paid') }}">Polis sudah dibayar</a></td>
                                            <td class="text-danger text-center"><span class="text-danger text-center">{{ $totalPolisPaid }}</span></td>
                                        </tr>
                                        <tr>                                            
                                            <td><a href="{{ route('dashboard.unpaid') }}">Polis menunggu pembayaran</a></td>
                                            <td class="text-danger text-center"><span class="text-danger text-center">{{ $totalPolisPending }}</span></td>                                            
                                        </tr>
                                        <tr>
                                            <td><a href="{{ route('dashboard.request') }}">Polis Pengajuan</a></td>
                                            <td class="text-danger text-center"><span class="text-danger text-center">{{ $totalPolisRequest }}</p</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-4">
                    <div class="usr-tasks ">
                        <div class="widget-content widget-content-area">
                            <h3 class="wallet-title">Polis Offline Anda</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Status Polis</th>
                                            <th class="text-center" width="15%">Jumlah</th>
                                        </tr>
                                        <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Total Polis</td>
                                            <td class="text-danger text-center"><span>{{ $totalPolisOff }}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Polis Aktif</td>
                                            <td class="text-danger text-center"><span>{{ $totalPolisAktifOff }}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Polis tidak Aktif</td>
                                            <td class="text-danger text-center"><span>{{ $totalPolisTidakAktifOff }}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Polis sedang dibuat</td>
                                            <td class="text-danger text-center"><span>{{ $totalPolisDalamProsesUserOff }}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Polis sudah dibayar</td>
                                            <td class="text-danger text-center"><span>{{ $totalPolisPaidOff }}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Polis menunggu pembayaran</td>
                                            <td class="text-danger text-center"><span>{{ $totalPolisPendingOff }}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Polis dalam proses</td>
                                            <td class="text-danger text-center"><span>{{ $totalPolisPendingOff }}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Polis Pengajuan</td>
                                            <td class="text-danger text-center"><span>{{ $totalPolisRequestOff }}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>           
        </div>
    @elseif (auth()->user()->roles == 2 || auth()->user()->roles == 3)
        @foreach ($popup03 as $item)  
        @if ($item->status == 0)
        <div id="welcomeModal" class="modal animated fadeInUp custo-fadeInUp" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <!-- Modal content-->
                <div class="modal-content text-end">
                    <div class="modal-body">
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{ asset('/img/landing/' . $item->popup) }}" alt="Welcome Image" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
        @endif
        @endforeach
        <div class="middle-content container-xxl p-0">
            <div class="row layout-top-spacing">
                
                <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-wallet-one">
                        @if (session()->has('success'))
                            <div class="alert alert-success p-2 my-2" role="alert">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger p-2 my-2" role="alert">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        <div class="wallet-info text-center mb-3 mt-3">
                            <p class="wallet-title mb-3">Total Poin Aktif</p>
                            <p class="total-amount mb-3">{{ number_format($poinAktif ?? 0, 0, ',', '.') }}</p>
                        </div>

                        <div class="wallet-action text-center d-flex justify-content-around mb-4">
                            <a class="btn btn-success" href="" role="button" data-bs-toggle="modal" data-bs-target="#agentregisterModal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 16 16 12 12 8"></polyline>
                                    <line x1="8" y1="12" x2="16" y2="12"></line>
                                </svg>
                                <span class="btn-text-inner">Redeem</span>
                            </a>
                        </div>
                        <!-- Modal Create -->
                        <div class="modal fade register-modal" id="agentregisterModal" tabindex="-1" role="dialog" aria-labelledby="agentregisterModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header mt-2" id="agentregisterModalLabel">
                                        <h4 class="modal-title">Redeem Request</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-x">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('dashboard.requestRedeem') }}" class="mt-0">
                                            @csrf
                                            <div class="form-group">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-right">
                                                    <polyline points="13 17 18 12 13 7"></polyline>
                                                    <polyline points="6 17 11 12 6 7"></polyline>
                                                </svg>
                                                <input placeholder="Amount" id="jumlah" type="number" class="form-control mb-2" name="jumlah" value="{{ old('jumlah') }}" required>
                                                <input type="hidden" value="{{ $poinAktif }}">
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-2 mb-2 w-100">Submit Request</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="wallet-action text-center d-flex justify-content-around">
                            <div class="media-body">
                                <h6 class="">Total Poin Didapat</h6>
                                <span>{{ number_format($sumAllCommission ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="media-body">
                                <h6 class="">Total Poin Diterima</h6>
                                <span>{{ number_format($sumAllRedeemPoin ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        @if (Auth::user()->roles == 2 || Auth::user()->roles == 3 || Auth::user()->roles == 0)
                            <div class="card bg-secondary mb-4 mt-4">
                                <div class="card-body">
                                    <p class="mb-0 text-center">Sebarkan link refferal anda dan dapatkan bonus</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12">
                    <div class="widget widget-wallet-one">
                        <h4>Refferal</h4>
                        <div class="table-responsive mb-0 mt-1" >
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Status Polis</th>
                                        <th class="text-center" width="15%">Jumlah</th>
                                    </tr>
                                    <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Total Referal</td>
                                        <td>
                                            <p class="text-danger text-center">{{ $totalReferal }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total Polis</td>
                                        <td>
                                            <p class="text-danger text-center">{{ $totalPolisReferal }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Polis Aktif</td>
                                        <td>
                                            <p class="text-danger text-center">{{ $totalPolisReferalAktif }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Polis tidak Aktif</td>
                                        <td>
                                            <p class="text-danger text-center">{{ $totalPolisReferalTidakAktif }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Polis dalam proses</td>
                                        <td>
                                            <p class="text-danger text-center">{{ $totalPolisDalamProses }}</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>            
        </div>
    @endif


    @push('after-script')
        <script>
        $(document).ready(function () {
            $('#welcomeModal').modal('show');
        });
        </script>
    @endpush


@endsection
