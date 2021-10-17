@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">ข้อมูลตำแหน่งพันธกิจและเชิงรุก</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">ข้อมูลพนักงานประจำ/ชั่วคราว</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">

{{--        <div class="col-xl-12" style="margin-top: 20px;">--}}
{{--            <div class="form-group">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <form action="{{route('graph_hr_position')}}">--}}
{{--                            <input type="hidden" name="search2" value="1">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-10">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <input type="text"--}}
{{--                                               required--}}
{{--                                               min="2560"--}}
{{--                                               max="{{\Carbon\Carbon::now()->addYears(543)->format('Y')}}"--}}
{{--                                               value="{{request()->get('search_year')}}"--}}
{{--                                               placeholder="ปีที่ต้องการดู"--}}
{{--                                               class="form-control"--}}
{{--                                               name="search_year">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col-md-2">--}}
{{--                                    <button class="btn btn-primary">ค้นหา</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="col-md-2"></div>
        <div class="col-md-8">
{{--            @if(request()->get('search2'))--}}
                <div class="card mb-3">
                    <div class="card-header">
                        <h2 class="text-center">
                            <i class="fa fa-bar-chart-o"></i>
                            ข้อมูลตำแหน่งพันธกิจและเชิงรุก
                        </h2>
                        {{--                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus non luctus metus. Vivamus fermentum ultricies orci sit amet sollicitudin.--}}
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3" style="background-color:#BCAC9D"></div>
                            <div class="col-md-6" style="background-color: #E6E6E6">
                                <canvas id="pieChart"></canvas>
                            </div>
                            <div class="col-md-3" style="background-color:#BCAC9D"></div>
                        </div>
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
        </div>
        <div class="col-md-2"></div>
    </div>
{{--    @endif--}}
@endsection

@section('script')
    <script>
        Chart.register(ChartDataLabels);

        var sum = parseInt("{{$data['full_look']}}") + parseInt("{{$data['full_pun']}}") + parseInt("{{$data['part_look']}}") + parseInt("{{$data['part_pun']}}");
        // var sum = 21;
        var ctx2 = document.getElementById("pieChart").getContext('2d');
        var pieChart = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                datasets: [{
                    // data: [3,6,8,4],
                    data: [parseInt("{{$data['full_look']}}"), parseInt("{{$data['full_pun']}}"), parseInt("{{$data['part_look']}}"), parseInt("{{$data['part_pun']}}")],

                    backgroundColor: [
                        'rgba(161,147,231,255)',
                        'rgba(179,207,255,255)',
                        'rgba(119,206,135,255)',
                        'rgba(189,228,113,255)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    label: 'Dataset 1'
                }],
                labels: [
                    "อาจารย์เชิงรุก",
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
                        // backgroundColor: '#ccc',
                        borderRadius: 3,
                        font: {
                            size: 18,
                        },
                        formatter: function(value, context) {
                            var text = context.chart.data.datasets[0].data[context.dataIndex] + ',' + (context.chart.data.datasets[0].data[context.dataIndex] / sum *100).toFixed(2) +' %'
                            return text;
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
                }
            }

        });
    </script>
@endsection
