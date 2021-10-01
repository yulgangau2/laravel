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
                                        <button class="btn" type="submit">อัพเดทการทำงานปัจจุบัน</button>
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
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>


@endsection
