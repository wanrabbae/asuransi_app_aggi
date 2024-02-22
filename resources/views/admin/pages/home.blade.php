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
            <div class="widget widget-card-four">
                <div class="widget-content">
                    <div class="w-header">
                        <div class="w-info">
                            <h6 class="value">Total Online Premi</h6>
                        </div>
                    </div>
                    <div class="w-content">
                        <div class="w-info">
                            <p class="value fs-5">Rp {{ format_uang($countData) }}
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
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-card-four">
                <div class="widget-content">
                    <div class="w-header">
                        <div class="w-info">
                            <h6 class="value">Total Offline Premi</h6>
                        </div>
                    </div>
                    <div class="w-content">
                        <div class="w-info">
                            <p class="value fs-5">Rp {{ format_uang($countDataOff) }}
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
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-card-four">
                <div class="widget-content">
                    <div class="w-header">
                        <div class="w-info">
                            <h6 class="value">Total Premi</h6>
                        </div>
                    </div>
                    <div class="w-content">
                        <div class="w-info">
                            <p class="value fs-5">Rp {{ format_uang($totalOmzet) }}
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
        </div>

        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 layout-spacing mt-2">
            <div class="widget widget-chart-three">
                <div class="widget-heading">
                    <div class="">
                        <h5 class="">Incomes Monthly Cart</h5>
                    </div>
                </div>
                <div class="widget-content px-4">
                    <div id="incomesAndRedeem"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 layout-spacing mt-2">
            <div class="usr-tasks">
                <div class="widget-content widget-content-area">
                    <h4 class="wallet-title mb-3">Balance</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 45%;">Data</th>
                                    <th class="text-end">Jumlah</th>
                                </tr>
                                <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Total Premi</td>
                                    <td class="text-end">
                                        <span class="text-success">{{ format_uang($totalOmzet) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Fee Admin</td>
                                    <td class="text-end">
                                        <span class="text-success">{{ format_uang($totalFeeAdmin) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Materai</td>
                                    <td class="text-end">
                                        <span class="text-success">{{ format_uang($totalFeeMaterai) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total Redeem</td>
                                    <td class="text-end">
                                        <span class="text-danger">- {{ format_uang($countRedeemAmount) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Other Expense </td>
                                    <td class="text-end">
                                        <span class="text-danger">- {{ format_uang($counOtherExpense) }}</span>
                                    </td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                <tr>
                                    <th style="width: 26%;">Sisa Balance</th>
                                    <th class="text-end"><span class="text-success">{{ format_uang($sisaBalance) }}</span></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 mb-4">
            <div class="usr-tasks ">
                <div class="widget-content widget-content-area">
                    <h4 class="wallet-title mb-4">Total Redeem</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 26%;">Data</th>
                                    <th class="text-center">Jumlah</th>
                                </tr>
                                <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Balance</td>
                                    <td class="text-end">
                                        <span class="text-danger">{{ format_uang($totalCom) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Request</td>
                                    <td class="text-end">
                                        <span class="text-danger">{{ format_uang($countRedeemAmountR) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Process</td>
                                    <td class="text-end">
                                        <span class="text-danger">{{ format_uang($countRedeemAmountP) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Remaining </td>
                                    <td class="text-end">
                                        <span class="text-danger">{{ format_uang($sisaRedeemAmount) }}</span>
                                    </td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                <tr>
                                    <th style="width: 26%;">Total</th>
                                    <th class="text-end"><span class="text-danger">{{ format_uang($countRedeemAmount) }}</span></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 mb-4">
            <div class="usr-tasks ">
                <div class="widget-content widget-content-area">
                    <h4 class="wallet-title mb-4">Total partner</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 50%;">Data</th>
                                    <th class="text-center">Jumlah</th>
                                </tr>
                                <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Total Nasabah</td>
                                    <td class="text-end">
                                        <span class="text-danger">{{ $countUser }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total Affliator</td>
                                    <td class="text-end">
                                        <span class="text-danger">{{ $countPartner }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total Request Mitra</td>
                                    <td class="text-end">
                                        <span class="text-danger">{{ $countAgenR }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total Mitra</td>
                                    <td class="text-end">
                                        <span class="text-danger">{{ $countAgen }}</span>
                                    </td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                <tr>
                                    <th style="width: 26%;">Total</th>
                                    <th class="text-end"><span class="text-danger">{{ $totalUser }}</span></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 mb-4">
            <div class="usr-tasks ">
                <div class="widget-content widget-content-area">
                    <h4 class="wallet-title mb-4">Total Polis Online</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 50%;">Data</th>
                                    <th class="text-center">Jumlah</th>
                                </tr>
                                <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Polis Paid</td>
                                    <td class="text-end">
                                        <span class="text-danger text-center">{{ $totalPolisPaid }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Polis Process</td>
                                    <td class="text-end">
                                        <span class="text-danger text-center">{{ $totalPolisProcess }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Polis Completed</td>
                                    <td class="text-end">
                                        <span class="text-danger text-center">{{ $totalPolisComplate }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Polis Expired</td>
                                    <td class="text-end">
                                        <span class="text-danger">{{ $totalPolisExpired }}</span>
                                    </td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                <tr>
                                    <th style="width: 26%;">Total</th>
                                    <th class="text-end"><span class="text-danger">{{ $totalPolis }}</span></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 mb-4">
            <div class="usr-tasks ">
                <div class="widget-content widget-content-area">
                    <h4 class="wallet-title mb-4">Total Polis Offline</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 50%;">Data</th>
                                    <th class="text-center">Jumlah</th>
                                </tr>
                                <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Polis Paid</td>
                                    <td class="text-end">
                                        <span class="text-danger">{{ $totalPolisPaidOff }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Polis Process</td>
                                    <td class="text-end">
                                        <span class="text-danger">{{ $totalPolisProcessOff }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Polis Completed</td>
                                    <td class="text-end">
                                        <span class="text-danger">{{ $totalPolisComplateOff }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Polis Expired</td>
                                    <td class="text-end">
                                        <span class="text-danger">{{ $totalPolisExpiredOff }}</span>
                                    </td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                <tr>
                                    <th style="width: 50%;">Total</th>
                                    <th class="text-end"><span class="text-danger">{{ $totalPolisOff }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        
    </div>

    @push('after-script')
        <script src="{{ asset('/back') }}/src/plugins/src/apex/apexcharts.min.js"></script>

        <script>
            $(document).ready(function() {
                // Assuming $data is the array of objects containing total_payment and month
                fetch('/api/chart-graph-income')
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
                                name: 'Online Incomes',
                                data: monthLabels.map(month => {
                                    var dataPoint = data[0].find(item => item.month === month);
                                    return dataPoint ? dataPoint.total_payment_sum : 0;
                                })
                            }, {
                                name: 'Offline Incomes',
                                data: monthLabels.map(month => {
                                    var dataPoint = data[1].find(item => item.month === month);
                                    return dataPoint ? dataPoint.total_payment_sum_off : 0;
                                })
                            }],
                            xaxis: {
                                categories: monthLabels,
                            },
                            yaxis: [{
                                title: {
                                    text: 'Incomes Amount'
                                }
                            }],
                            fill: {
                                opacity: 1
                            },
                            tooltip: {
                                y: {
                                    formatter: function(val, opts) {
                                        return opts.seriesIndex === 0 ? "Rp " + val : "Rp " + val;
                                    }
                                }
                            }
                        };

                        var chart = new ApexCharts(
                            document.querySelector("#incomesAndRedeem"),
                            options
                        );

                        chart.render();
                    });
            });
        </script>
    @endpush

@endsection
