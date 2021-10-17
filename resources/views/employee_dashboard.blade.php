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
                        <form action="{{route('employee_dashboard')}}">
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
                <div class="row">
                    <div class="col-md-2" style="background-color: #BCAC9D"></div>
                    <div class="col-md-8">
                        <div class="card mb-12">
                            <div class="card-header">
                                <h2 class="text-center">
                                    <i class="fa fa-line-chart"></i>
                                    ข้อมูลพนักงานมหาวิทยาลัยประจำ และชั่วคราว
                                </h2>
                                {{--                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus non luctus metus. Vivamus fermentum ultricies orci sit amet sollicitudin.--}}
                            </div>

                            <div class="card-body" style="background-color: #E6E6E6">
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
                                        <td>วิชาการ</td>
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
                    </div>
                    <div class="col-md-2" style="background-color: #BCAC9D"></div>
                </div>
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

                Chart.register(ChartDataLabels);

                var barChart = new Chart(ctx1, {
                    showTooltips: false,
                    type: 'bar',
                    data: {
                        labels: years,
                        datasets: [
                            {
                                label: ['วิชาการแผ่นดิน'],
                                data: full_academic,
                                backgroundColor: [
                                    // 'rgba(239, 102, 75, 0.2)',
                                    'rgba(255,201,53,255,1)',
                                ],
                                borderWidth: 1,
                                stack: 'Stack 0',

                            },
                            {
                                label: ['วิชาการรายได้'],
                                data: part_academic,
                                backgroundColor: [
                                    // 'rgba(249, 149, 127, 1)',
                                    'rgba(255,144,88, 1)',
                                ],
                                borderWidth: 1,
                                stack: 'Stack 0',
                            },
                            {
                                label: ['ปฏิบัติการแผ่นดิน'],
                                data: full_support,
                                backgroundColor: [
                                    // 'rgba(223, 160, 6, 0.2)',
                                    'rgba(189,228,113,1)',
                                ],
                                borderWidth: 1,
                                stack: 'Stack 1',

                            },
                            {
                                label: ['ปฏิบัติการรายได้'],
                                data: part_support,
                                backgroundColor: [
                                    // 'rgba(254, 212, 110, 1)',
                                    'rgba(119,204,135, 1)',
                                ],
                                borderWidth: 1,
                                stack: 'Stack 1',

                            }
                        ]
                    },
                    options: {
                        plugins: {
                            datalabels: {
                                // display: true,
                                // align: 'bottom',
                                // // backgroundColor: '#ccc',
                                // borderRadius: 3,
                                // font: {
                                //     size: 18,
                                // },
                                formatter: function(value, context) {
                                    // var text = context.chart.data.datasets[0].data[context.dataIndex] + ',' + (context.chart.data.datasets[0].data[context.dataIndex] / sum *100).toFixed(2) +' %'
                                    // return text;
                                }
                            },
                            legend: {
                                labels: {
                                    // This more specific font property overrides the global property
                                    font: {
                                        size: 15
                                    }
                                }
                            }
                        },
                        tooltips: {
                            mode: 'index',
                            intersect: false
                        },
                        responsive: true,
                        scales: {
                            x: {
                                ticks: {
                                    font: {
                                        size: 14,
                                        family:'vazir',
                                        weight : 'bold',
                                    }
                                }
                            },
                            y: {
                                ticks: {
                                    font: {
                                        size: 14,
                                        weight : 'bold',
                                        family:'vazir'
                                    }
                                }
                            },
                            // xAxes: [
                            //     {
                            //         stacked: true,
                            //         display: true,
                            //         title: {
                            //             display: true,
                            //             text: 'Month'
                            //         }
                            //     }
                            // ],
                            // yAxes: [
                            //     {
                            //         stacked: true
                            //     }]
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


            </script>
@endsection
