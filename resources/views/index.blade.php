@extends('layouts.default')

@section('style')
    <style>

        .min-w-50 {
            width: 50px;
            min-width: 50px !important;
        }

        .min-w-75 {
            width: 75px;
            min-width: 75px !important;
        }

        .min-w-100 {
            width: 100px;
            min-width: 100px !important;
        }

        .min-w-200 {
            width: 200px;
            min-width: 200px !important;
        }
        .min-w-300 {
            width: 300px;
            min-width: 300px !important;
        }

        .min-w-400 {
            width: 400px;
            min-width: 400px !important;
        }

        /*td {*/
        /*    width: auto  !important;;*/
        /*}*/

    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">บุคลากรใกล้ถูกเลิกจ้าง</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">บุคลากรใกล้ถูกเลิกจ้าง</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>


    <div class="row">


        <div class="card">
            <div class="card-header">
                <h3><i class="fa fa-line-chart"></i>บุคลากรใกล้ถูกเลิกจ้าง</h3>
            </div>

            <div class="card-body">

                <div class="card-body">
                    {{--                    <iframe class="chartjs-hidden-iframe" tabindex="-1"--}}
                    {{--                            style="display: block; overflow: hidden; border: 0px; margin: 0px; inset: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>--}}
                    <div class="col-xs-6">
                        {{--                        <h1>รายงานข้อมูลอาจารย์ที่ใกล้จะเลิกจ้าง</h1>--}}
                    </div>
                    <div class="col-xs-6">
                        <a href="{{route('index',['type' => 'month'])}}">รูปแบบเดือน</a>
                        <a href="{{route('index',['type' => 'year'])}}">รูปแบบปี</a>
                    </div>

                </div>

                <iframe class="chartjs-hidden-iframe" tabindex="-1"
                        style="display: block; overflow: hidden; border: 0px; margin: 0px; inset: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>


                @if(request()->get('type') && request()->get('type') == 'month')
                    <table class="table table-striped" style="width: 100%">
                        <thead style="overflow: auto">
                        <tr style="overflow: auto">
                            <th class="min-w min" >ชื่อ-สกุล</th>
                            <th>ระยะเวลาที่เหลือ(วัน)</th>
                            <th>วันที่เริ่มงาน/วันที่ดำรงตำแหน่ง</th>
                            <th>วันที่บรรจุ</th>
                            <th>วันที่ถูกเลิกจ้าง</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if($users && count($users) >0)
                            @foreach($users as $i=> $user)
                                <tr>
                                    <td class="min-w-300">{{$user['name']}}</td>
                                    <td class="min-w-100">{{$user['among']}}</td>
                                    <td class="min-w-100">{{$user['start_at']}}</td>
                                    <td class="min-w-100">{{$user['contain_at']}}</td>
                                    <td class="min-w-100">{{$user['exit_at']}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                @else
                    <div class="col-lg-12 col-md-12 col-xl-12" style="overflow: auto">
                        <table class="table table-striped" style="overflow: auto">
                            <thead style="overflow: auto">
                            <tr style="overflow: auto">
                                <th class="min-w min">ชื่อ-สกุล</th>
                                <th>ระยะเวลาที่เหลือ(วัน)</th>
                                <th>วันที่เริ่มงาน/วันที่ดำรงตำแหน่ง</th>
                                <th>วันที่บรรจุ</th>
                                <th>วันที่ถูกเลิกจ้าง</th>
                                @foreach($years as $i => $year)
                                    <th>
                                        <span>
                                            {{$year}}
                                        </span>

                                        {{--                                    <a href="{{route('index',['type' => 'year'])}}"--}}
                                        {{--                                    {{$year}}--}}
                                        {{--                                    </a>--}}
                                    </th>
                                @endforeach
                            </tr>
                            </thead>

                            <tbody>
                            @if($users && count($users) >0)
                                @foreach($users as $i=> $user)
                                    <tr>
                                        <td class="min-w-300">{{$user['name']}}</td>
                                        <td class="min-w-100">{{$user['among']}}</td>
                                        <td class="min-w-100">{{$user['start_at']}}</td>
                                        <td class="min-w-100">{{$user['contain_at']}}</td>
                                        <td class="min-w-100">{{$user['exit_at']}}</td>


                                        @foreach($years as $i => $year)
                                            @if($year >= $user['start'] && $year <= $user['end']  ? 'green' : '')
                                                @if($year < $user['start']+5)

                                                    <td style="background-color:green"></td>
                                                @elseif($year< $user['start']+7 )

                                                    <td style="background-color:yellow"></td>

                                                @else

                                                    <td style="background-color:red"></td>
                                                @endif
                                            @else

                                                <td></td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
