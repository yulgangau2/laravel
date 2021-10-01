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
            <div class="form-group">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('index3')}}">
                            <input type="hidden" name="search1" value="{1">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="number"
                                               value="{{request()->get('start_year')}}"
                                               placeholder="ปีเริ่มต้น"
                                               min="2560"
                                               max="{{\Carbon\Carbon::now()->addYears(543)->format('Y')}}"
                                               class="form-control"
                                               name="start_year">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="number"
                                               min="2560"
                                               max="{{\Carbon\Carbon::now()->addYears(543)->format('Y')}}"
                                               value="{{request()->get('end_year')}}"
                                               placeholder="ปีสิ้นสุด"
                                               class="form-control"
                                               name="end_year">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <button class="btn btn-primary">ค้นหา</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @if(request()->get('search1'))
                <div class="card mb-12">
                    <div class="card-header">
                        <h3><i class="fa fa-line-chart"></i> ข้อมูลพนักงานมหาวิทยาลัยประจำ และชั่วคราว</h3>
                        {{--                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus non luctus metus. Vivamus fermentum ultricies orci sit amet sollicitudin.--}}
                    </div>

                    <div class="card-body">
                        <canvas id="ex1"></canvas>

                    </div>
                    {{--                <div class="card-footer small text-muted">--}}
                    {{--                    Updated yesterday at 11:59 PM--}}
                    {{--                </div>--}}
                    <div class="card-footer" style="overflow: auto">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ปี</th>
                                @foreach($years as $i=> $year)
                                    <th colspan="2" class="text-center">
                                        {{$year}}
                                    </th>
                                @endforeach
                            </tr>
                            <tr>
                                <th>แผนก</th>
                                @foreach($years as $i=> $year)
                                    <th class="text-center">แผ่นดิน</th>
                                    <th class="text-center">รายได้</th>
                                @endforeach
                            </tr>
                            <tbody>
                            <tr>
                                <td>วิทยาการ</td>
                                @foreach($years as $i=> $year)
                                    <td class="text-center">
                                        {{$data[$year]['full_academic'] }}
                                    </td>
                                    <td class="text-center">
                                        {{$data[$year]['part_academic']}}
                                    </td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>ปฏิบัติการ</td>
                                @foreach($years as $i=> $year)
                                    <td class="text-center">
                                        {{ $data[$year]['full_support'] }}
                                    </td>
                                    <td class="text-center">
                                        {{  $data[$year]['part_support'] }}
                                    </td>
                                @endforeach
                            </tr>
                            </thead>
                            <tr>
                                <td>จำนวน/คน</td>
                                @foreach($years as $i=> $year)
                                    <td class="text-center">
                                        {{$data[$year]['full_academic'] + $data[$year]['full_support'] }}
                                    </td>
                                    <td class="text-center">
                                        {{$data[$year]['part_academic'] + $data[$year]['part_support'] }}
                                    </td>
                                @endforeach
                            </tr>
                            <tr>
                                <th>รวม</th>
                                @foreach($years as $i=> $year)
                                    <th class="text-center" colspan="2">
                                        {{$data[$year]['full_academic'] + $data[$year]['part_academic'] +  $data[$year]['full_support'] +  $data[$year]['part_support']  }}
                                    </th>
                                @endforeach
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- end card-->
            @endif
        </div>

        <div class="col-xl-12" style="margin-top: 20px;">
            <div class="form-group">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('index3')}}">
                            <input type="hidden" name="search2" value="1">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <input type="text"
                                               value="{{request()->get('search_year')}}"
                                               placeholder="ปีที่ต้องการดู"
                                               class="form-control"
                                               name="search_year">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <button class="btn btn-primary">ค้นหา</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @if(request()->get('search2'))
                <div class="card mb-3">
                    <div class="card-header">
                        <h3><i class="fa fa-bar-chart-o"></i>ข้อมูลตำแหน่งพันธกิจและเชิงรุก</h3>
                        {{--                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus non luctus metus. Vivamus fermentum ultricies orci sit amet sollicitudin.--}}
                    </div>

                    <div class="card-body">
                        <canvas id="pieChart"></canvas>
                    </div>
                    {{--                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>--}}
                    <div class="card-footer" style="overflow: auto">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ตำแหน่ง</th>
                                <th class="text-center">อาจารย์เชิงรุก</th>
                                <th class="text-center">อาจารย์พันธกิจ</th>
                                <th class="text-center">จนท.เชิงรุก</th>
                                <th class="text-center">จนท.พันธกิจ</th>
                                <th class="text-center">รวม</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>จำนวน/คน</td>
                                <td class="text-center">{{$data['full_look']}}</td>
                                <td class="text-center">{{$data['full_pun']}}</td>
                                <td class="text-center">{{$data['part_look']}}</td>
                                <td class="text-center">{{$data['part_pun']}}</td>
                                <td class="text-center">
                                    {{ $data['full_look'] + $data['full_pun'] + $data['part_look'] + $data['part_pun'] }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- end card-->
            @endif
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
                var years = [];
                var full_academic = [];
                var full_support = [];
                var part_academic = [];
                var part_support = [];

                var full_look = [];
                var full_pun = [];
                var part_look = [];
                var part_pun = [];

                @foreach($years as $i => $year)
                years.push("{{$year}}")
                @if($data[$year]['full_academic'])
                full_academic.push(parseInt("{{$data[$year]['full_academic']}}"))
                @endif
                @if($data[$year]['full_support'])
                full_support.push(parseInt("{{$data[$year]['full_support']}}"))
                @endif
                @if($data[$year]['part_academic'])
                part_academic.push(parseInt("{{$data[$year]['part_academic']}}"))
                @endif
                @if($data[$year]['part_support'])
                part_support.push(parseInt("{{$data[$year]['part_support']}}"))
                @endif

                @endforeach

                var barChart = new Chart(ctx1, {
                    showTooltips: false,
                    type: 'bar',
                    data: {
                        labels: years,
                        datasets: [
                            {
                                label: ['วิทยาการ', 'แผ่นดิน'],
                                data: full_academic,
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
                                label: ['วิทยาการ', 'รายได้'],
                                data: part_academic,
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
                                label: ['ปฏิบัติการ', 'แผ่นดิน'],
                                data: full_support,
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
                                label: ['ปฏิบัติการ', 'รายได้'],
                                data: part_support,
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
                        },

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
                            data: [parseInt("{{$data['full_look']}}"), parseInt("{{$data['full_pun']}}"), parseInt("{{$data['part_look']}}"), parseInt("{{$data['part_pun']}}")],
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
                            "อาจาจารย์เชิงรุก",
                            "อาจารย์พันธกิจ",
                            "จนท.เชิงรุก",
                            "จนท.พันธกิจ",
                        ]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            datalabels: {
                                display: true,
                                align: 'bottom',
                                backgroundColor: '#ccc',
                                borderRadius: 3,
                                font: {
                                    size: 18,
                                }
                            },
                        }
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
