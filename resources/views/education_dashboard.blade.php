@extends('layouts.default')

@section('style')
    <style>
        .type {
            padding: 5px 15px;
            color: #A46B51;
            border: 1px solid #A46B51;
            border-radius: 5px
        }

        .type:hover {
            padding: 5px 15px;
            color: white;
            background-color: #A46B51;
            border: 1px solid #A46B51;
            border-radius: 5px
        }

        .type-active {
            padding: 5px 15px;
            color: white;
            background-color: #A46B51;
            border: 1px solid #A46B51;
            border-radius: 5px
        }

        .type-active:hover {
            background-color: white;
            padding: 5px 15px;
            color: #A46B51;
            border: 1px solid #A46B51;
            border-radius: 5px
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">กราฟแสดงข้อมูลบุคลากรสายวิชาการตามคุณวุฒิ</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">กราฟแสดงข้อมูลบุคลากรสายวิชาการตามคุณวุฒิ</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12" style="margin-top: 20px;">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-9 col-xs-8">
                        {{--                        <h1>รายงานข้อมูลอาจารย์ที่ใกล้จะเลิกจ้าง</h1>--}}
                    </div>
                    <div class="col-md-3 col-xs-4">
                        <div style="float: right">
                            <a
                                class="{{request()->get('type') == 'bar' ? 'type-active' :'type'}}"
                                href="{{route('education_dashboard',['type' => 'bar'])}}">รูปแบบแท่ง</a>
                            <a
                                class="{{request()->get('type') != 'bar' ? 'type-active' :'type'}}"
                                href="{{route('education_dashboard',['type' => 'line'])}}">รูปแบบเส้น</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12">

            <div class="form-group">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('education_dashboard')}}">
                            <input type="hidden" name="type" value="{{request()->get('type')}}">
                            <input type="hidden"
                                   name="search"
                                   value="1">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="number"
                                               min="2560"
                                               max="{{\Carbon\Carbon::now()->addYears(543)->format('Y')}}"
                                               value="{{request()->get('start_year')}}"
                                               placeholder="ปีเริ่มต้น"
                                               class="form-control"
                                               name="start_year">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="number"
                                               value="{{request()->get('end_year')}}"
                                               placeholder="ปีสิ้นสุด"
                                               class="form-control"
                                               min="2560"
                                               max="{{\Carbon\Carbon::now()->addYears(543)->format('Y')}}"
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
        </div>


        @if(request()->get('search'))
            <div class="col-xl-12" style="background-color: #BCAC9D">
                <div class="row">


                    {{--                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">--}}
                    {{--                    <div class="card mb-3">--}}
                    {{--                        <div class="card-header">--}}
                    {{--                            <h3><i class="fa fa-line-chart"></i> กราฟแสดงข้อมูลบุคลากรสายวิชาการตามคุณวุฒิ</h3>--}}
                    {{--                        </div>--}}

                    {{--                        <div class="card-body">--}}
                    {{--                            <canvas id="comboBarLineChart2"></canvas>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>--}}
                    {{--                    </div><!-- end card-->--}}
                    {{--                </div>--}}



                    {{--                    <div class="col-md-2"></div>--}}
                    <div class="col-md-12">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h1 class="text-center">
                                        <i class="fa fa-line-chart"></i>
                                        กราฟแสดงข้อมูลบุคลากรสายวิชาการตามคุณวุฒิ
                                    </h1>
                                </div>


                                @if(request()->get('type')  && request()->get('type') == 'bar')
                                    <div class="card-body" style="background-color: #E6E6E6">
                                        <canvas id="comboLineChart"></canvas>
                                    </div>
                                @endif

                                @if(!request()->get('type')  || request()->get('type') == 'line')
                                    <div class="card-body" style="background-color: #E6E6E6">
                                        <canvas id="comboLineChart2"></canvas>
                                    </div>
                                @endif


                                {{--                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>--}}
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>
                                            ปี/ตำแหน่ง
                                        </th>
                                        @foreach($years as $i=> $year)
                                            <th class="text-center">
                                                {{$year}}
                                            </th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>ศาสตราจารย์</td>
                                        @foreach($years as $i=> $year)
                                            <td class="text-center">
                                                {{$data[$year]['s_doctor'] }}
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>รศ.ดร</td>
                                        @foreach($years as $i=> $year)
                                            <td class="text-center">
                                                {{$data[$year]['rs_doctor'] }}
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>ผศ.ดร</td>
                                        @foreach($years as $i=> $year)
                                            <td class="text-center">
                                                {{$data[$year]['ps_doctor'] }}
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>ผศ</td>
                                        @foreach($years as $i=> $year)
                                            <td class="text-center">
                                                {{$data[$year]['ps_master'] }}
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>ปริญญาเอก</td>
                                        @foreach($years as $i=> $year)
                                            <td class="text-center">
                                                {{$data[$year]['doctor'] }}
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>ปริญญาโท</td>
                                        @foreach($years as $i=> $year)
                                            <td class="text-center">
                                                {{$data[$year]['master'] }}
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>
                                            รวม
                                        </th>
                                        @foreach($years as $i=> $year)
                                            <th class="text-center">
                                                {{ $data[$year]['s_doctor'] + $data[$year]['rs_doctor'] + $data[$year]['ps_doctor'] + $data[$year]['ps_master'] + $data[$year]['doctor'] + $data[$year]['master'] }}
                                            </th>
                                        @endforeach
                                    </tr>
                                    </tbody>
                                </table>
                            </div><!-- end card-->
                        </div>
                    </div>
                    {{--                    <div class="col-md-2"></div>--}}


                </div>
            </div>
        @endif
    </div>
@endsection


@section('script')
    <script>
        // var ctx1 = document.getElementById("comboBarLineChart2").getContext('2d');
        // var comboBarLineChart1 = new Chart(ctx1, {
        //     type: 'bar',
        //     data: {
        //         labels: ["2560", "2561", "2562", "2563", "2564"],
        //         datasets: [
        //             // {
        //             // type: 'line',
        //             // label: 'Dataset 1',
        //             // borderColor: '#484c4f',
        //             // borderWidth: 3,
        //             // fill: false,
        //             // data: [12, 19, 3, 5, 2, 3, 13, 17, 11, 8, 11, 9],
        //             // },
        //             {
        //                 type: 'bar',
        //                 label: 'ป.เอก',
        //                 backgroundColor: '#FF6B8A',
        //                 data: [10, 11, 7, 5, 3],
        //                 borderColor: 'white',
        //                 borderWidth: 0
        //             }, {
        //                 type: 'bar',
        //                 label: 'ป.โท',
        //                 backgroundColor: '#059BFF',
        //                 data: [10, 11, 7, 5, 1],
        //             }, {
        //                 type: 'bar',
        //                 label: 'ผศ.ดร.',
        //                 backgroundColor: '#484c4f',
        //                 data: [10, 11, 7, 5, 4],
        //             }, {
        //                 type: 'bar',
        //                 label: 'รศ.ดร.',
        //                 backgroundColor: '#EBEFF3',
        //                 data: [10, 11, 7, 5, 9],
        //             }
        //         ],
        //         borderWidth: 1
        //     },
        //     options: {
        //         scales: {
        //             yAxes: [{
        //                 ticks: {
        //                     beginAtZero: true
        //                 }
        //             }]
        //         }
        //     }
        // });

        @if(request()->get('search'))
        var years = [parseInt("{{$years[0]-1}}")];
        var doctor = [null];
        var master = [null];
        var ps_doctor = [null];
        var ps_master = [null];
        var rs_doctor = [null];
        var s_doctor = [null];

        @foreach($years as $i => $year)
        years.push("{{$year}}")
        @if($data[$year]['s_doctor'])
        s_doctor.push(parseInt("{{$data[$year]['s_doctor']}}"))
        @else
        s_doctor.push(0)
        @endif

        @if($data[$year]['rs_doctor'])
        rs_doctor.push(parseInt("{{$data[$year]['rs_doctor']}}"))
        @else
        rs_doctor.push(0)
        @endif

        @if($data[$year]['ps_doctor'])
        ps_doctor.push(parseInt("{{$data[$year]['ps_doctor']}}"))
        @else
        ps_doctor.push(0)
        @endif

        @if($data[$year]['ps_master'])
        ps_master.push(parseInt("{{$data[$year]['ps_master']}}"))
        @else
        ps_master.push(0)
        @endif

        @if($data[$year]['doctor'])
        doctor.push(parseInt("{{$data[$year]['doctor']}}"))
        @else
        doctor.push(0)
        @endif

        @if($data[$year]['master'])
        master.push(parseInt("{{$data[$year]['master']}}"))
        @else
        master.push(0)
        @endif
        @endforeach

        var y = parseInt(years[years.length - 1]) + 1;

        years.push(y)
        doctor.push(null);
        master.push(null);
        ps_doctor.push(null);
        ps_master.push(null);
        rs_doctor.push(null);
        s_doctor.push(null);

        Chart.register(ChartDataLabels);

        var ctx = document.getElementById("comboLineChart").getContext('2d');
        var comboBarLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: years,
                datasets: [

                    {
                        type: 'bar',
                        label: 'ศาสตราจารย์',
                        // borderColor: '#79372A',
                        // borderWidth: 3,
                        fill: true,
                        data: [3,5,6,6],
                        backgroundColor : 'rgba(121,55,42,1)'
                    },
                    {
                        type: 'line',
                        label: 'รองศาสตราจารย์ ดร.',
                        // borderColor: '#CA5C4A',
                        // borderWidth: 3,
                        fill: false,
                        data: rs_doctor,
                        backgroundColor : 'rgba(202,92,74,1)'
                    },
                    {
                        type: 'line',
                        label: 'ผู้ช่วยศาสตราจารย์ ดร.',
                        // borderColor: '#A194E4',
                        // borderWidth: 3,
                        fill: false,
                        data: ps_doctor,
                        backgroundColor : 'rgba(161,148,228,1)'
                    },

                    {
                        type: 'line',
                        label: 'ผู้ช่วยศาสตราจารย์',
                        // borderColor: '#FF0000',
                        // borderWidth: 3,
                        fill: false,
                        data: ps_master,
                        backgroundColor : 'rgba(255,144,89,1)'
                    },
                    {
                        type: 'line',
                        label: 'ปริญญาเอก',
                        borderColor: '#FF9059',
                        borderWidth: 3,
                        fill: false,
                        data: doctor,
                        backgroundColor : 'rgba(255,144,89,1)'
                    },
                    {
                        type: 'line',
                        label: 'ปริญญาโท',
                        // borderColor: '#FFC837',
                        // borderWidth: 3,
                        fill: false,
                        data: master,
                        backgroundColor : 'rgba(255,200,55,1)'
                    },
                    // {
                    //     type: 'bar',
                    //     label: '',
                    //     borderColor: '#FFFFFF',
                    //     borderWidth: 1,
                    //     fill: false,
                    //     data: ps_master,
                    // },
                ],
                borderWidth: 1
            },
            options: {
                plugins: {

                    fontColor: 'white',
                    legend: {

                        fontColor: 'white',
                        labels: {
                            // This more specific font property overrides the global property
                            font: {
                                size: 15,
                                fontColor: 'white'


                            }
                        }
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });


        function square_data(chart) {
            var c = document.createElement("canvas");
            var ctx = c.getContext("2d");
            ctx.fillStyle = "#FFA500";
            ctx.rect(135, 60, 80, 30);
            ctx.fill()
            ctx.fillStyle = "#fff";
            // ctx.fillText(chart.dataset.data[chart.dataIndex], 147,82, 10);

            ctx.stroke();
            return c
        }

        // https://stackoverflow.com/questions/67876897/how-show-data-label-in-the-graph-on-chart-js
        var ctx2 = document.getElementById("comboLineChart2").getContext('2d');
        var comboBarLineChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: years,
                datasets: [

                    {
                        type: 'line',
                        label: 'ศาสตราจารย์',
                        borderColor: '#79372A',
                        borderWidth: 3,
                        fill: false,
                        data: [null, 3, 6, 8, 4],
                    },
                    {
                        type: 'line',
                        label: 'รองศาสตราจารย์ ดร.',
                        borderColor: '#CA5C4A',
                        borderWidth: 3,
                        fill: false,
                        data: rs_doctor,
                    },
                    {
                        type: 'line',
                        label: 'ผู้ช่วยศาสตราจารย์ ดร.',
                        borderColor: '#A194E4',
                        borderWidth: 3,
                        fill: false,
                        data: ps_doctor,
                    },

                    {
                        type: 'line',
                        label: 'ผู้ช่วยศาสตราจารย์',
                        borderColor: '#FF0000',
                        borderWidth: 3,
                        fill: false,
                        data: ps_master,
                    },
                    {
                        type: 'line',
                        label: 'ปริญญาเอก',
                        borderColor: '#FF9059',
                        borderWidth: 3,
                        fill: false,
                        data: doctor,
                    },
                    {
                        type: 'line',
                        label: 'ปริญญาโท',
                        borderColor: '#FFC837',
                        borderWidth: 3,
                        fill: false,
                        data: master,
                    },
                    // {
                    //     type: 'bar',
                    //     label: '',
                    //     borderColor: '#FFFFFF',
                    //     borderWidth: 1,
                    //     fill: false,
                    //     data: ps_master,
                    // },
                ],
                borderWidth: 1
            },

            options: {
                plugins: {
                    datalabels: {
                        display: true,
                        align: 'top',
                        backgroundColor: '#ccc',

                        fontColor: 'white',
                        // borderRadius: 3,
                        font: {
                            size: 18,
                            fontColor: 'white'
                        },
                        formatter: function (value, context) {
                            var text = '';
                            var sum = 0;
                            console.log(value, context.chart.data.datasets)
                            // var text = context.chart.data.datasets[0].data[context.dataIndex] + ',' + (context.chart.data.datasets[0].data[context.dataIndex] / sum *100).toFixed(2) +' %'
                            // return text;
                        }
                    },
                },
                // elements:{
                //     "point":{"pointStyle":square_data},
                // },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        @endif

        // // comboBarLineChart
        // var ctx2 = document.getElementById("comboBarLineChart").getContext('2d');
        // var comboBarLineChart = new Chart(ctx2, {
        //     type: 'bar',
        //     data: {
        //         labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        //         datasets: [{
        //             type: 'line',
        //             label: 'Dataset 1',
        //             borderColor: '#484c4f',
        //             borderWidth: 3,
        //             fill: false,
        //             data: [12, 19, 3, 5, 2, 3, 13, 17, 11, 8, 11, 9],
        //         }, {
        //             type: 'bar',
        //             label: 'Dataset 2',
        //             backgroundColor: '#FF6B8A',
        //             data: [10, 11, 7, 5, 9, 13, 10, 16, 7, 8, 12, 5],
        //             borderColor: 'white',
        //             borderWidth: 0
        //         }, {
        //             type: 'bar',
        //             label: 'Dataset 3',
        //             backgroundColor: '#059BFF',
        //             data: [10, 11, 7, 5, 9, 13, 10, 16, 7, 8, 12, 5],
        //         }],
        //         borderWidth: 1
        //     },
        //     options: {
        //         scales: {
        //             yAxes: [{
        //                 ticks: {
        //                     beginAtZero:true
        //                 }
        //             }]
        //         }
        //     }
        // });

    </script>
@endsection
