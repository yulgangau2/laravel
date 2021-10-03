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

        <div class="col-xl-12" style="margin-top: 20px;">
            <div class="form-group">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('graph_hr_position')}}">
                            <input type="hidden" name="search2" value="1">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <input type="text"
                                               required
                                               min="2560"
                                               max="{{\Carbon\Carbon::now()->addYears(543)->format('Y')}}"
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
            </script>
@endsection
