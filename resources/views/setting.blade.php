@extends('layouts.default')

@section('content')

    <style>
        .card {
            width: 100%;
            margin: 20px 0;
        }


        .card-header {
            color: white;
            background-color: #A46B51;
        }

        .btn {
            width: 100%;
        }
    </style>
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">ตั้งค่า</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">ตั้งค่า</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3><i class="fa fa-line-chart"></i>อัพเดทข้อมูล</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @include('components.alert')
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <td colspan="5">
                                    <form  id="form"
{{--                                           action="{{route('upload_layoff')}}"--}}
                                          enctype="multipart/form-data"
                                          method="post">
                                        {{csrf_field()}}
                                        <div class="row">
                                            <div class="col-md-5">
                                                <h5 class="text-center">อัพเดทอาจารย์ใกล้จะถูกเลิกจ้าง</h5>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <input type="file"
                                                           id="layoff"
                                                           required
                                                           class="form-control"
                                                           name="layoff">
                                                    <span style="color: red;">*หมายเหตุไฟล์ต้องเป็น UTF8 .csv</span>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <button class="btn" type="submit">อัพโหลด
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="5">
                                    {{$layoff ? $layoff->updated_at : '-'}}
                                </td>
{{--                                <td>--}}
{{--                                    <h5>{{$layoff ? $layoff->updated_at : '-'}}</h5>--}}
{{--                                </td>--}}
                            </tr>
                            <tr>
                                <td>
                                    <form action="{{route('update_employee')}}" method="get">
                                        {{csrf_field()}}
                                        <button class="btn" type="button"
                                                onclick="update_employees()"
                                        >อัพเดทรายชื่อพนักงาน</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('update_work_current_info')}}" method="get">
                                        {{csrf_field()}}
                                        <button class="btn" type="submit"
{{--                                                onclick="update_work_current_info()"--}}
                                        >
                                            อัพเดทการทำงานปัจจุบัน
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('update_personal_info')}}" method="get">
                                        {{csrf_field()}}
                                        <button class="btn" type="button"
                                                onclick="update_personal_info()"
                                        >อัพเดทข้อมูลส่วนบุคคล</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('update_history_worker')}}" method="get">
                                        {{csrf_field()}}
                                        <button class="btn" type="button"
                                                onclick="update_history_work()"
                                        >อัพเดทประวัติการทำงาน</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('update_employee_education')}}" method="get">
                                        {{csrf_field()}}
                                        <button class="btn" type="button"
                                                onclick="update_history_education()"
                                        >อัพเดทประวัติการศึกษา</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">{{$employee ? $employee->updated_at : '-'}}</td>
                                <td class="text-center">{{$work_current ? $work_current->updated_at : '-'}}</td>
                                <td class="text-center">{{$personal_info ? $personal_info->updated_at : '-'}}</td>
                                <td class="text-center">{{$history_work ? $history_work->updated_at  :'-'}}</td>
                                <td class="text-center">{{$employee_education ? $employee_education->updated_at : '-'}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <form action="{{route('update_employee_executive')}}" method="get">
                                        {{csrf_field()}}
                                        <button

                                            style="background-color: #757575;cursor: not-allowed"
                                            disabled
                                            class="btn" type="button"
                                                onclick="update_executive()">
                                            อัพเดทตำแหน่งบริหาร
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('update_employee_leavehistory')}}" method="get">
                                        {{csrf_field()}}
                                        <button

                                            style="background-color: #757575;cursor: not-allowed"
                                            disabled
                                            class="btn" type="button"
                                                onclick="update_leave_history()"
                                        >อัพเดทข้อมูลการลาราชการ
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('update_employee_leaveeducation')}}" method="get">
                                        {{csrf_field()}}
                                        <button
                                            style="background-color: #757575;cursor: not-allowed"
                                            disabled
                                            class="btn" type="button"
                                                onclick="update_leave_education()"
                                        >อัพเดทข้อมูลการลาศึกษา
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('update_employee_address')}}" method="get">
                                        {{csrf_field()}}
                                        <button
                                            style="background-color: #757575;cursor: not-allowed"
                                            class="btn"  disabled
                                                type="button"
                                                onclick="update_address()"
                                        >อัพเดทที่อยู่</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('update_employee_fame')}}" method="get">
                                        {{csrf_field()}}
                                        <button
                                            style="background-color: #757575;cursor: not-allowed"
                                            disabled
                                            class="btn" type="button"
                                                onclick="update_fame()"
                                        >อัพเดทเครื่องราชอิสริยาภรณ์</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">{{$executive ? $executive->updated_at : '-'}}</td>
                                <td class="text-center">{{$leave_history ? $leave_history->updated_at : '-'}}</td>
                                <td class="text-center">{{$leave_education ? $leave_education->updated_at : '-'}}</td>
                                <td class="text-center">{{$employee_address ? $employee_address->updated_at  :'-'}}</td>
                                <td class="text-center">{{$employee_fame ? $employee_fame->updated_at : '-'}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>
        var perIds = [];
        var data = [];
        @if(count($personal_ids) > 0)
        @foreach($personal_ids as $i=> $perId)
        perIds.push("{{$perId}}")
        @endforeach
        @endif

        $("#form").on("submit", function (event) {
            event.preventDefault(); //prevent default submitting
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "https://smartreport.camt.cmu.ac.th/public/api/upload_layoff",
{{--                url: "{{route('api_upload_layoff')}}",--}}
                type: "post",
                data: formData,
                processData: false, //Not to process data
                contentType: false, //Not to set contentType
                success: function (data) {
                    if (data.success) {
                        alert(data.message);
                    }
                }
            });
        });

        function waitforme(ms)  {
            return new Promise( resolve => { setTimeout(resolve, ms); });
        }

        function task(url,perId) {
            $.ajax({
                data: {
                    'perId': perId
                },
                url: url,
                encoding: '',
                timeout: 0,
                method: "post"
            }).done(function (response) {
                /*if (response.data && response.data.perId == perId) {
                    if (response.data.success) {
                        alert("success");
                    }
                }*/
            })

        }


        async function update_employees() {
            console.log(111)
            $.ajax({
                url: "{{str_replace('http://','https://',route('api_update_employee'))}}",
                {{--url: "{{route('api_update_employee')}}",--}}
                encoding: '',
                timeout: 0,
                method: "post"
            }).done(function (response) {
                console.log(response)
                if (response.success) {
                    alert("อัพเดทข้อมูลสำเร็จ")
                }
            })
        }

        async function update_work_current_info() {
            for (var i = 0; i < perIds.length; i++) {
                console.log(i)
                task("{{str_replace('http://','https://',route('api_update_work_current_info'))}}",perIds[i])
                await waitforme(4000);
            }
            alert("อัพเดทข้อมูลสำเร็จ")
        }

        async function update_personal_info() {
            for (var i = 0; i < perIds.length; i++) {
                console.log(i)
                task("{{str_replace('http://','https://',route('api_update_personal_info'))}}",perIds[i])
                await waitforme(4000);
            }
            alert("อัพเดทข้อมูลสำเร็จ")
        }

        async function update_history_work() {
            console.log(perIds)
            for (var i = 0; i < perIds.length; i++) {
                console.log(i)
                task("{{str_replace('http://','https://',route('api_update_history_worker'))}}",perIds[i])
                await waitforme(4000);
            }
            alert("อัพเดทข้อมูลสำเร็จ")
        }

        async function update_history_education() {
            for (var i = 0; i < perIds.length; i++) {
                console.log(i)
                task("{{str_replace('http://','https://',route('api_update_employee_education'))}}",perIds[i])
                await waitforme(4000);
            }
            alert("อัพเดทข้อมูลสำเร็จ")
        }

        async function update_executive() {
            return false;
            for (var i = 0; i < perIds.length; i++) {
                console.log(i)
                task("{{str_replace('http://','https://',route('api_update_employee_executive'))}}",perIds[i])
                await waitforme(4000);
            }
            alert("อัพเดทข้อมูลสำเร็จ")
        }

        async function update_leave_history() {
            return false;
            for (var i = 0; i < perIds.length; i++) {
                console.log(i)
                task("{{str_replace('http://','https://',route('update_employee_leavehistory'))}}",perIds[i])
                await waitforme(4000);
            }
            alert("อัพเดทข้อมูลสำเร็จ")
        }

        async function update_leave_education() {
            return false;
            for (var i = 0; i < perIds.length; i++) {
                console.log(i)
                task("{{str_replace('http://','https://',route('api_update_employee_leaveeducation'))}}",perIds[i])
                await waitforme(4000);
            }
            alert("อัพเดทข้อมูลสำเร็จ")
        }

        async function update_address() {
            return false;
            for (var i = 0; i < perIds.length; i++) {
                console.log(i)
{{--                task("{{str_replace('http://','https://',route('api_update_employee_address'))}}",perIds[i])--}}
                await waitforme(4000);
            }
            alert("อัพเดทข้อมูลสำเร็จ")
        }

        async function update_fame() {
            return false;
            for (var i = 0; i < perIds.length; i++) {
                console.log(i)
                task("{{str_replace('http://','https://',route('api_update_employee_fame'))}}",perIds[i])
                await waitforme(4000);
            }
            alert("อัพเดทข้อมูลสำเร็จ")
        }



    </script>
@endsection
