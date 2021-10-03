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
                                <td colspan="4">
                                    <form action="{{route('upload_layoff')}}"
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
                                                           required
                                                           class="form-control"
                                                           name="layoff">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <button class="btn btn-primary" type="submit">อัพโหลด
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <h5>{{$layoff ? $layoff->updated_at : '-'}}</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <form action="{{route('update_employee')}}" method="get">
                                        {{csrf_field()}}
                                        <button class="btn" type="submit">อัพเดทรายชื่อพนักงาน</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('update_work_current_info')}}" method="get">
                                        {{csrf_field()}}
                                        <button class="btn" type="button" onclick="update_work_current_info()">
                                            อัพเดทการทำงานปัจจุบัน
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('update_personal_info')}}" method="get">
                                        {{csrf_field()}}
                                        <button class="btn" type="submit">อัพเดทข้อมูลส่วนบุคคล</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('update_history_worker')}}" method="get">
                                        {{csrf_field()}}
                                        <button class="btn" type="submit">อัพเดทประวัติการทำงาน</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('update_employee_education')}}" method="get">
                                        {{csrf_field()}}
                                        <button class="btn" type="submit">อัพเดทประวัติการศึกษา</button>
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
                                        <button class="btn" type="submit">อัพเดทตำแหน่งบริหาร</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('update_employee_leavehistory')}}" method="get">
                                        {{csrf_field()}}
                                        <button class="btn" type="submit">อัพเดทข้อมูลการลาราชการ</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('update_employee_leaveeducation')}}" method="get">
                                        {{csrf_field()}}
                                        <button class="btn" type="submit">อัพเดทข้อมูลการลาศึกษา</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('update_employee_address')}}" method="get">
                                        {{csrf_field()}}
                                        <button class="btn btn-primary" type="submit">อัพเดทที่อยู่</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('update_employee_fame')}}" method="get">
                                        {{csrf_field()}}
                                        <button class="btn" type="submit">อัพเดทเครื่องราชอิสริยาภรณ์</button>
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

        const sleep = (milliseconds) => {
            return new Promise(resolve => setTimeout(resolve, milliseconds))
        }


        function task(perId) {
            $.ajax({
                data: {
                    'perId': perId
                },
                url: "{{route('api_update_work_current_info')}}",
                encoding: '',
                timeout: 0,
                method: "post"
            }).done(function (response) {
                if (response.data && response.data.perId == perId) {
                    if (response.data.success) {
                        alert("success");
                    }
                }
            })

        }


        function waitforme(ms)  {
            return new Promise( resolve => { setTimeout(resolve, ms); });
        }


        async function update_work_current_info() {
            for (var i = 0; i < perIds.length; i++) {
                task(perIds[i])
                await waitforme(4000);
            }
            alert("อัพเดทข้อมูลสำเร็จ")
        }

    </script>
@endsection
