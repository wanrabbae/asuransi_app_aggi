@extends('admin.layouts.app')
<!-- set title -->
@section('title')

    @push('after-style')
        <link href="{{ asset('/back') }}/src/plugins/src/apex/apexcharts.css" rel="stylesheet" type="text/css">
        <link href="{{ asset('/back') }}/src/assets/css/light/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/back') }}/src/assets/css/dark/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    @endpush

@section('content')

    <div class="row layout-top-spacing">

        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <a href="{{ route('dashboard.onlinetransaction.paid') }}">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-header">
                            <div class="w-info">
                                <h6 class="value">Permintaan Cetak Polis Online</h6>
                            </div>
                        </div>
                        <div class="w-content">
                            <div class="w-info">
                                <p class="value fs-5">{{ $totalPolisPaid }}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-trending-up">
                                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                        <polyline points="17 6 23 6 23 12"></polyline>
                                    </svg>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <a href="{{ route('dashboard.onlinetransaction.process') }}">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-header">
                            <div class="w-info">
                                <h6 class="value">Polis Online Dalam Proses Cetak</h6>
                            </div>
                        </div>
                        <div class="w-content">
                            <div class="w-info">
                                <p class="value fs-5">{{ $totalPolisProcess }}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-trending-up">
                                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                        <polyline points="17 6 23 6 23 12"></polyline>
                                    </svg>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <a href="{{ route('dashboard.onlinetransaction.completed') }}">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-header">
                            <div class="w-info">
                                <h6 class="value">Polis Online Aktif</h6>
                            </div>
                        </div>
                        <div class="w-content">
                            <div class="w-info">
                                <p class="value fs-5">{{ $totalPolisComplate }}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-trending-up">
                                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                        <polyline points="17 6 23 6 23 12"></polyline>
                                    </svg>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <a href="{{ route('dashboard.offlinetransaction.index') }}">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-header">
                            <div class="w-info">
                                <h6 class="value">Permintaan Asuransi offline</h6>
                            </div>
                        </div>
                        <div class="w-content">
                            <div class="w-info">
                                <p class="value fs-5">{{ $totalPolisReqOff }}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-trending-up">
                                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                        <polyline points="17 6 23 6 23 12"></polyline>
                                    </svg>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <a href="{{ route('dashboard.offlinetransaction.process') }}">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-header">
                            <div class="w-info">
                                <h6 class="value">Followup Asuransi offline</h6>
                            </div>
                        </div>
                        <div class="w-content">
                            <div class="w-info">
                                <p class="value fs-5">{{ $totalPolisFollOff }}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up">
                                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                        <polyline points="17 6 23 6 23 12"></polyline>
                                    </svg>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <a href="{{ route('dashboard.offlinetransaction.paid') }}">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-header">
                            <div class="w-info">
                                <h6 class="value">Permintaan Cetak Polis Offline</h6>
                            </div>
                        </div>
                        <div class="w-content">
                            <div class="w-info">
                                <p class="value fs-5">{{ $totalPolisPaidOff }}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up">
                                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                        <polyline points="17 6 23 6 23 12"></polyline>
                                    </svg>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <a href="{{ route('dashboard.offlinetransaction.polisprocess') }}">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-header">
                            <div class="w-info">
                                <h6 class="value">Polis Offline Dalam Proses Cetak </h6>
                            </div>
                        </div>
                        <div class="w-content">
                            <div class="w-info">
                                <p class="value fs-5">{{ $totalPolisProcessOff }}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up">
                                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                        <polyline points="17 6 23 6 23 12"></polyline>
                                    </svg>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <a href="{{ route('dashboard.offlinetransaction.completed') }}">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-header">
                            <div class="w-info">
                                <h6 class="value">Polis Offline Aktif</h6>
                            </div>
                        </div>
                        <div class="w-content">
                            <div class="w-info">
                                <p class="value fs-5">{{ $totalPolisComplateOff }}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up">
                                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                        <polyline points="17 6 23 6 23 12"></polyline>
                                    </svg>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <a href="{{ route('dashboard.userdata.agent.request') }}">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-header">
                            <div class="w-info">
                                <h6 class="value">Permintaan Mitra</h6>
                            </div>
                        </div>
                        <div class="w-content">
                            <div class="w-info">
                                <p class="value fs-5">{{ $countAgenR  }}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up">
                                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                        <polyline points="17 6 23 6 23 12"></polyline>
                                    </svg>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-12 col-lg-8 col-md-8 col-sm-12 col-12 layout-spacing mt-4">
            <div class="widget widget-chart-three">
                <div class="widget-heading">
                    <div class="">
                        <h5 class="">DATA PEMBELIAN POLIS</h5>
                    </div>
                </div>
                <div class="widget-content px-4">
                    <div id="PolisOnlineAndPolisOffline"></div>
                </div>
            </div>
        </div>

    </div>

    @push('after-script')
        <script src="{{ asset('/back') }}/src/plugins/src/apex/apexcharts.min.js"></script>

        <script>
            $(document).ready(function() {
                // Assuming $data is the array of objects containing total_payment and month
                fetch('/api/chart-graph-polis')
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);

                        // Create an array of month labels from January to December
                        var monthLabels = Array.from({
                            length: 12
                        }, (_, i) => i + 1);

                        var options = {
                            chart: {
                                type: 'bar',
                                height: 350,
                                toolbar: {
                                    show: false
                                }
                            },
                            plotOptions: {
                                bar: {
                                    horizontal: false,
                                    columnWidth: '55%',
                                    endingShape: 'rounded'
                                },
                            },
                            dataLabels: {
                                enabled: false
                            },
                            stroke: {
                                show: true,
                                width: 2,
                                colors: ['transparent']
                            },
                            series: [{
                                name: 'Polis Online',
                                data: monthLabels.map(month => {
                                    var dataPoint = data[0].find(item => item.month === month);
                                    return dataPoint ? dataPoint.polis_sum : 0;
                                })
                            }, {
                                name: 'Polis Offline',
                                data: monthLabels.map(month => {
                                    var dataPoint = data[1].find(item => item.month === month);
                                    return dataPoint ? dataPoint.polis_sum_off : 0;
                                })
                            }],
                            xaxis: {
                                categories: monthLabels,
                            },
                            yaxis: [{
                                title: {
                                    text: 'Polis'
                                }
                            }],
                            fill: {
                                opacity: 1
                            },
                            tooltip: {
                                y: {
                                    formatter: function(val, opts) {
                                        return opts.seriesIndex === 0 ? " " + val : " " + val;
                                    }
                                }
                            }
                        };

                        var chart = new ApexCharts(
                            document.querySelector("#PolisOnlineAndPolisOffline"),
                            options
                        );

                        chart.render();
                    });
            });
        </script>
    @endpush

@endsection
