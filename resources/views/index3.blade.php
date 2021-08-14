@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">ข้อมูลพนักงานประจำ/ชั่วคราว</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">ข้อมูลพนักงานประจำ/ชั่วคราว</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3><i class="fa fa-line-chart"></i> ข้อมูลพนักงานมหาวิทยาลัยประจำ และชั่วคราว ปี2560</h3>
                            {{--                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus non luctus metus. Vivamus fermentum ultricies orci sit amet sollicitudin.--}}
                        </div>

                        <div class="card-body">
                            <canvas id="ex1"></canvas>

                        </div>
                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div><!-- end card-->
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3><i class="fa fa-bar-chart-o"></i> ข้อมูลพนักงานมหาวิทยาลัยประจำ และชั่วคราว ปี2560</h3>
                            {{--                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus non luctus metus. Vivamus fermentum ultricies orci sit amet sollicitudin.--}}
                        </div>

                        <div class="card-body">
                            <canvas id="pieChart"></canvas>
                        </div>
                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div><!-- end card-->
                </div>

                @endsection

                @section('script')
                    <script>

                        // options: {
                        //     tooltips: {
                        //         mode: 'index',
                        //             intersect: false
                        //     },
                        //     responsive: true,
                        //         scales: {
                        //         xAxes: [{
                        //             stacked: true,
                        //         }],
                        //             yAxes: [{
                        //             stacked: true
                        //         }]
                        //     }
                        // }
                        // barChart
                        var ctx1 = document.getElementById("ex1").getContext('2d');
                        var barChart = new Chart(ctx1, {
                            type: 'bar',
                            data: {
                                labels: [2560, 2561, 2562, 2563, 2564],
                                datasets: [
                                    {
                                        label: 'แผ่นดิน',
                                        data: [23, 42, 52, 35, 1],
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(255, 99, 132, 0.2)'
                                        ],
                                        borderWidth: 1,
                                        stack: 'Stack 0',

                                    },
                                    {
                                        label: 'รายได้',
                                        data: [12, 19, 3, 5, 2],
                                        backgroundColor: [
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(54, 162, 235, 1)',
                                        ],
                                        borderWidth: 1,
                                        stack: 'Stack 0',
                                    },
                                    {
                                        label: 'แผ่นดิน',
                                        data: [12, 19, 3, 5, 1],
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(255, 99, 132, 0.2)',
                                        ],
                                        borderWidth: 1,
                                        stack: 'Stack 1',

                                    },
                                    {
                                        label: 'รายได้',
                                        data: [12, 19, 3, 5, 2],
                                        backgroundColor: [
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(54, 162, 235, 1)',
                                        ],
                                        borderWidth: 1,
                                        stack: 'Stack 1',

                                    }
                                ]
                            },
                            options: {
                                tooltips: {
                                    mode: 'index',
                                    intersect: false
                                },
                                responsive: true,
                                scales: {
                                    xAxes: [
                                        {
                                            stacked: true,
                                            display: true,
                                            title: {
                                                display: true,
                                                text: 'Month'
                                            }
                                        }
                                    ],
                                    yAxes: [
                                        {
                                            stacked: true
                                        }]
                                }
                            }
                            // options: {
                            //     scales: {
                            //         yAxes: [{
                            //             ticks: {
                            //                 beginAtZero: true
                            //             }
                            //         }]
                            //     }
                            // }
                        });


                        var ctx2 = document.getElementById("pieChart").getContext('2d');
                        var pieChart = new Chart(ctx2, {
                            type: 'doughnut',
                            data: {
                                datasets: [{
                                    data: [12, 19, 3, 5],
                                    backgroundColor: [
                                        'rgba(255,99,132,1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    label: 'Dataset 1'
                                }],
                                labels: [
                                    "อาจารย์พันธกิจ",
                                    "จนท.พันธกิจ",
                                    "จนท.เชิงรุก",
                                    "อาจาจารย์เชิงรุก"
                                ]
                            },
                            options: {
                                responsive: true
                            }

                        });


                        // const config = {
                        //     type: 'bar',
                        //     data: data,
                        //     options: {
                        //         plugins: {
                        //             title: {
                        //                 display: true,
                        //                 text: 'Chart.js Bar Chart - Stacked'
                        //             },
                        //         },
                        //         responsive: true,
                        //         interaction: {
                        //             intersect: false,
                        //         },
                        //         scales: {
                        //             x: {
                        //                 stacked: true,
                        //             },
                        //             y: {
                        //                 stacked: true
                        //             }
                        //         }
                        //     }
                        // };
                        //
                        // const data = {
                        //     labels: labels,
                        //     datasets: [
                        //         {
                        //             label: 'Dataset 1',
                        //             data: Utils.numbers(NUMBER_CFG),
                        //             backgroundColor: Utils.CHART_COLORS.red,
                        //             stack: 'Stack 0',
                        //         },
                        //         {
                        //             label: 'Dataset 2',
                        //             data: Utils.numbers(NUMBER_CFG),
                        //             backgroundColor: Utils.CHART_COLORS.blue,
                        //             stack: 'Stack 0',
                        //         },
                        //         {
                        //             label: 'Dataset 3',
                        //             data: Utils.numbers(NUMBER_CFG),
                        //             backgroundColor: Utils.CHART_COLORS.green,
                        //             stack: 'Stack 1',
                        //         },
                        //     ]
                        // };
                        //
                        // const actions = [
                        //     {
                        //         name: 'Randomize',
                        //         handler(chart) {
                        //             chart.data.datasets.forEach(dataset => {
                        //                 dataset.data = Utils.numbers({count: chart.data.labels.length, min: -100, max: 100});
                        //             });
                        //             chart.update();
                        //         }
                        //     },
                        // ];


                    </script>
@endsection
