@extends('layouts.default')

@section('content')

    <style>
        .card {
            width: 100%;
            margin: 20px 0;
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
                <h3><i class="fa fa-line-chart"></i> อัพเดทข้อมูล</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <form action="{{route('update_employee')}}" method="post">
                                {{csrf_field()}}
                                <div class="card">
                                    <div class="card-header">อัพเดทรายชื่อพนักงาน</div>
                                    <div class="card-body">
                                        <button class="btn btn-primary" type="submit">อัพเดท</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <form action="{{route('update_work_current_info')}}" method="post">
                                {{csrf_field()}}
                                <div class="card">
                                    <div class="card-header">อัพเดทการทำงานปัจจุบัน</div>
                                    <div class="card-body">
                                        <button class="btn btn-primary" type="submit">อัพเดท</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <form action="{{route('update_personal_info')}}" method="post">
                                {{csrf_field()}}
                                <div class="card">
                                    <div class="card-header">อัพเดทข้อมูลส่วนบุคคล</div>
                                    <div class="card-body">
                                        <button class="btn btn-primary" type="submit">อัพเดท</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <form action="{{route('update_history_worker')}}" method="post">
                                {{csrf_field()}}
                                <div class="card">
                                    <div class="card-header">อัพเดทประวัติการทำงาน</div>
                                    <div class="card-body">
                                        <button class="btn btn-primary" type="submit">อัพเดท</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <form action="{{route('update_employee_education')}}" method="post">
                                {{csrf_field()}}
                                <div class="card">
                                    <div class="card-header">อัพเดทประวัติการศึกษา</div>
                                    <div class="card-body">
                                        <button class="btn btn-primary" type="submit">อัพเดท</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <form action="{{route('update_employee_executive')}}" method="post">
                                {{csrf_field()}}
                                <div class="card">
                                    <div class="card-header">อัพเดทตำแหน่งบริหาร</div>
                                    <div class="card-body">
                                        <button class="btn btn-primary" type="submit">อัพเดท</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <form action="{{route('update_employee_leavehistory')}}" method="post">
                                {{csrf_field()}}
                                <div class="card">
                                    <div class="card-header">อัพเดทข้อมูลการลาราชการ</div>
                                    <div class="card-body">
                                        <button class="btn btn-primary" type="submit">อัพเดท</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <form action="{{route('update_employee_leaveeducation')}}" method="post">
                                {{csrf_field()}}
                                <div class="card">
                                    <div class="card-header">อัพเดทข้อมูลการลาศึกษา</div>
                                    <div class="card-body">
                                        <button class="btn btn-primary" type="submit">อัพเดท</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <form action="{{route('update_employee_address')}}" method="post">
                                {{csrf_field()}}
                                <div class="card">
                                    <div class="card-header">อัพเดทที่อยู่</div>
                                    <div class="card-body">
                                        <button class="btn btn-primary" type="submit">อัพเดท</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <form action="{{route('update_employee_fame')}}" method="post">
                                {{csrf_field()}}
                                <div class="card">
                                    <div class="card-header">อัพเดท</div>
                                    <div class="card-body">
                                        <button class="btn btn-primary" type="submit">อัพเดท</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


@endsection
