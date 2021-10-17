@extends('layouts.default')

@section('style')
    <style>

        .tscroll {
            overflow-x: scroll;
            margin-bottom: 10px;
            /*border: solid black 1px;*/
        }

        /*table thead tr{*/
        /*    display:block;*/
        /*}*/

        /*table th,table td{*/
        /*    width:100px;//fixed width*/
        /*}*/


        /*table  tbody{*/
        /*    display:block;*/
        /*    height:600px;*/
        /*    overflow:auto;*/
        /*}*/


        .tscroll table th:first-child {
            position: sticky;
            left: 0;
            background-color: #A46B51;

        }

        .tscroll table th:nth-child(2) {
            position: sticky;
            left: 180px;
            background-color: #A46B51;

        }
        .tscroll table th:nth-child(3) {
            position: sticky;
            left: 280px;
            background-color: #A46B51;

        }
        .tscroll table th:nth-child(4) {
            position: sticky;
            left: 380px;
            background-color: #A46B51;

        }
        .tscroll table th:nth-child(5) {
            position: sticky;
            left: 480px;
            background-color: #A46B51;

        }

        .tscroll table td:first-child {
            position: sticky;
            left: 0;
            background-color: white;

        }

        .tscroll table td:nth-child(2) {
            position: sticky;
            left: 180px;
            background-color: white;

        }
        .tscroll table td:nth-child(3) {
            position: sticky;
            left: 280px;
            background-color: white;

        }
        .tscroll table td:nth-child(4) {
            position: sticky;
            left: 380px;
            background-color: white;

        }
        .tscroll table td:nth-child(5) {
            position: sticky;
            left: 480px;
            background-color: white;

        }

        .tscroll td, .tscroll th {
            /*border-bottom: dashed #888 1px;*/
        }


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

        .min-w-150 {
            width: 150px;
            min-width: 150px !important;
        }

        .min-w-180 {
            width: 180px;
            min-width: 180px !important;
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
                <h1 class="main-title float-left">รายงานข้อมูลอาจารย์ที่ใกล้จะถูกเลิกจ้าง</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">บุคลากรใกล้ถูกเลิกจ้าง</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>


    <div class="row">


        <div class="card" style="width: 100%">
            <div class="card-header">
                <h2 class="text-center">
                    <i class="fa fa-line-chart"></i>
                    รายงานข้อมูลอาจารย์ที่ใกล้จะถูกเลิกจ้าง
                </h2>
            </div>


            <div class="card-body">
                {{--                    <iframe class="chartjs-hidden-iframe" tabindex="-1"--}}
                {{--                            style="display: block; overflow: hidden; border: 0px; margin: 0px; inset: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>--}}

                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-9 col-xs-8">
                                    {{--                        <h1>รายงานข้อมูลอาจารย์ที่ใกล้จะเลิกจ้าง</h1>--}}
                                </div>
                                <div class="col-md-3 col-xs-4">
                                    <div style="float: right">
                                        <a
                                            class="{{request()->get('type') == 'month' ? 'type-active' :'type'}}"
                                            href="{{route('layoff',['type' => 'month'])}}">รูปแบบตาราง</a>
                                        <a
                                            class="{{request()->get('type') != 'month' ? 'type-active' :'type'}}"
                                            href="{{route('layoff',['type' => 'year'])}}">รูปแบบกราฟ</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--                <iframe class="chartjs-hidden-iframe" tabindex="-1"--}}
                        {{--                        style="display: block; overflow: hidden; border: 0px; margin: 0px; inset: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>--}}


                        @if(request()->get('type') && request()->get('type') == 'month')
                            <div class="col-lg-12 col-md-12 col-xl-12" style="overflow: auto">
                                <table class="table table-striped" style="width: 100%;height: 300px;max-height: 300px !important;">
                                    <thead style="background-color: #A46B51;color: white;overflow: auto">
                                    <tr style="overflow: auto">
                                        <th class="text-center" style="max-width: 100px;width: 80px;min-width: 100px!important;">ชื่อ-สกุล</th>
                                        <th class="min-w-100 text-center">ระยะเวลาที่เหลือ(วัน)</th>
                                        <th class="min-w-100 text-center">วันที่เริ่มงาน/วันที่ดำรงตำแหน่ง</th>
                                        <th class="min-w-100 text-center">วันที่บรรจุ</th>
                                        <th class="min-w-100 text-center">วันที่ถูกเลิกจ้าง</th>
                                        <th class="min-w-100 text-center">จำนวนวันก่อนไม่ได้เลื่อนเงินเดือน</th>
                                        {{--                            <th>ตำแหน่ง</th>--}}
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @if($users && count($users) >0)
                                        @foreach($users as $i=> $user)
                                            <tr>
                                                <td class=""  style="max-width: 80px;width: 100px;min-width: 100px!important;">{{$user['name']}}</td>
                                                <td class="min-w-100 text-center">{{$user['amount']}}</td>
                                                <td class="min-w-100 text-center">{{$user['first_dat']}}</td>
                                                <td class="min-w-100 text-center">{{$user['contain']}}</td>
                                                <td class="min-w-100 text-center">{{ $user['position']  == 'อาจารย์' ?  $user['danger_start_at']  : '-'}}</td>
                                                <td class="min-w-100 text-center">{{$user['day_left'] ? $user['day_left'] :'-'}}</td>
                                                {{--                                    <td class="min-w-100 text-center">{{ $user['position'] == 'อาจารย์' ? $user['danger_end_at']  : '-'}}</td>--}}
                                                {{--                                    <td class="min-w-150">{{$user['อาจารย์']}}22</td>--}}
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="col-lg-12 col-md-12 col-xl-12 tscroll" style="overflow: auto;padding: 0">
                                <table class="table" style="overflow: auto;border-spacing: 0;border-collapse: separate;">
                                    <thead style="background-color: #A46B51;color: white;overflow: auto">
                                    <tr style="overflow: auto">
                                        {{--                                <th></th>--}}
                                        <th class="min-w min text-center">ชื่อ-สกุล</th>
                                        <th class="text-center">ระยะเวลาที่เหลือ(วัน)</th>
                                        <th class="text-center">วันที่เริ่มงาน/วันที่ดำรงตำแหน่ง</th>
                                        <th class="text-center">วันที่บรรจุ</th>
                                        <th class="text-center">วันที่ถูกเลิกจ้าง</th>
                                        {{--<th>ตำแหน่ง</th>--}}
                                        @foreach($years as $i => $year)
                                            <th style="width: 200px !important;min-width: 130px !important;">
                                                {{$year}}
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

                                            <tr class="scroll_container">
                                                {{--                                        <td>{{$i+1}}</td>--}}
                                                <td class="min-w-200">{{$user['name']}}</td>
                                                <td class="min-w-100 text-center">{{$user['amount']}}</td>
                                                <td class="min-w-100 text-center">{{$user['first_dat']}}</td>
                                                <td class="min-w-100 text-center">{{$user['contain']}}</td>

                                                <td class="min-w-100 text-center">{{ $user['position']  == 'อาจารย์' ?  $user['exit_at']  : '-'}}</td>
                                                {{--                                        <td class="min-w-100">{{$user['position']}}</td>--}}

                                                @foreach($years as $i => $year)
                                                    @if($year == $user['year_start'])
                                                        @break
                                                    @else
                                                        <td></td>
                                                    @endif
                                                @endforeach

                                                <td style="background-color:#64864A;color: white"
                                                    colspan="{{$user['safe_colspan']}}"
                                                    class="text-center">
                                                    {{$user['safe_start_at']}} - {{$user['safe_end_at']}}
                                                </td>
                                                <td style="background-color:#FFC700;color: black"
                                                    colspan="{{$user['warning_colspan']}}"
                                                    class="text-center">
                                                    {{$user['warning_start_at']}} - {{$user['warning_end_at']}}
                                                </td>

                                                @if($user['position'] == 'อาจารย์')
                                                    <td style="background-color:#FF284B;color: white"
                                                        colspan="{{$user['danger_colspan']}}"
                                                        class="text-center">
                                                        {{$user['danger_start_at']}} - {{$user['danger_end_at']}}
                                                    </td>
                                                @endif

                                                {{--                                        @foreach($years as $i => $year)--}}
                                                {{--                                            @if($year >= $user['start'] && $year <= $user['end']  ? 'green' : '')--}}
                                                {{--                                                @if($year < $user['start']+ $user['plus_green'])--}}
                                                {{--                                                    <td style="background-color:green" class="text-center">--}}

                                                {{--                                                        Test11--}}
                                                {{--                                                    </td>--}}
                                                {{--                                                @elseif($year< $user['start']+ $user['plus_yellow'])--}}
                                                {{--                                                    <td style="background-color:yellow" class="text-center">--}}
                                                {{--                                                        Test2--}}
                                                {{--                                                    </td>--}}
                                                {{--                                                @else--}}
                                                {{--                                                    <td style="background-color:red" class="text-center">--}}
                                                {{--                                                        Test3--}}
                                                {{--                                                    </td>--}}
                                                {{--                                                @endif--}}
                                                {{--                                            @else--}}
                                                {{--                                                <td></td>--}}
                                                {{--                                            @endif--}}
                                                {{--                                        @endforeach--}}
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        <p style="color: black;font-size: 18px;">หมายเหตุ</p>
                        <p style="color: #64864A;font-size: 18px;">วันที่มีคุณสมบัติครบในการขอตำแหน่ง (ดึงข้อมูลวันที่บรรจุเป็นประจำ + 1ปี) เช่น วันที่บรรจุเป็นพนักงานประจำ 14 ก.ค. 2563 วันที่แสดงในช่องสีเขียว 14 ก.ค. 2564 (ต้องผ่านทดลองงานแล้ว จึงจะขอตำแหน่งได้)</p>
                        <p style="color: #FFC700;font-size: 18px;">วันที่ใกล้ถึง การไม่ได้เลื่อนเงินเดือน แจ้งก่อนล่วงหน้า 1 ปี</p>
                        <p style="color: #FF284B;font-size: 18px;">วันที่เริ่มต้น การไม่ได้เลื่อนเงินเดือน จนถึง วันเลิกจ้างเมื่อสิ้นสุดสีแดง (ดึงข้อมูลเริ่มตั้งแต่ วันที่บรรจุพนักงานมหาวิทยาลัยประจำ + 5 ปี ) และสิ้นสุดการจ้าง</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        window.addEventListener("load", function(e) {
            var container = document.querySelector(".scroll_container");
            var middle = container.children[Math.floor((container.children.length - 1) / 2)];
            console.log(middle)
            container.scrollLeft = middle.offsetLeft +
                middle.offsetWidth / 2 - container.offsetWidth / 2;
        });
    </script>
@endsection
