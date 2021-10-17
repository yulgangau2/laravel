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
                <h1 class="main-title float-left">ข้อมูลพนักงาน</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">ข้อมูลพนักงาน</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3><i class="fa fa-line-chart"></i> ข้อมูลพื้นฐาน</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>ชื่อ</h4>
                            <input type="text" class="form-control"
                                   value="{{isset($user->FirstNameTha) ? $user->FirstNameTha : ''}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>นามสกุล</h4>
                            <input type="text" class="form-control"
                                   value="{{isset($user->LastNameTha) ? $user->LastNameTha : ''}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>ชื่อ(ภาษาอังกฤษ)</h4>
                            <input type="text" class="form-control"
                                   value="{{isset($user->FirstNameEng) ? $user->FirstNameEng : ''}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>นามสกุล(ภาษาอังกฤษ)</h4>
                            <input type="text" class="form-control"
                                   value="{{isset($user->LastNameEng) ? $user->LastNameEng : ''}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>คำนำหน้า</h4>
                            <input type="text" class="form-control"
                                   value="{{isset($user->PrenameTha) ? $user->PrenameTha : ''}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>คำนำหน้า(ภาษาอังกฤษ)</h4>
                            <input type="text" class="form-control"
                                   value="{{isset($user->LastNameTha) ? $user->LastNameTha : ''}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>เพศ</h4>
                            <input type="text" class="form-control"
                                   value="{{isset($user->SexNameTha) ? $user->SexNameTha : ''}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>กรุ๊ปเลือด</h4>
                            <input type="text" class="form-control"
                                   value="{{isset($user->BloodTypeNameEng) ? $user->BloodTypeNameEng : ''}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>วันเกิด</h4>
                            <input type="text" class="form-control"
                                   value="{{isset($user->BirthDate) ? $user->BirthDate : ''}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>หมายเลขบัตรประชาชน</h4>
                            <input type="text" class="form-control"
                                   value="{{isset($user->PersonalID) ? $user->PersonalID : ''}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>อีเมลมหาวิทยาลัย</h4>
                            <input type="text" class="form-control"
                                   value="{{isset($user->EmailCMU) ? $user->EmailCMU : ''}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>ที่อยู่ ไม่มี</h4>
                            <input type="text" class="form-control"
                                   value="{{isset($user->LastNameTha) ? $user->LastNameTha : ''}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>อายุตามปีปฏิทิน ไม่มี</h4>
                            <input type="text" class="form-control"
                                   value="{{isset($user->LastNameTha) ? $user->LastNameTha : ''}}">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>อายุจริง ไม่มี</h4>
                            <input type="text" class="form-control"
                                   value="{{isset($user->LastNameTha) ? $user->LastNameTha : ''}}">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3><i class="fa fa-line-chart"></i> ข้อมูลการทำงาน</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ปี</th>
                        <th>ประวัติ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($user->work_histories) > 0)
                    @foreach($user->work_histories as $i=> $history)
                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$history->year}}</td>
                            <td>{{$history->history->name}}</td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="text-center">
                                ไม่พบประวัติการศึกษา
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3><i class="fa fa-line-chart"></i> ข้อมูลการทำงาน</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>ชื่อตำแหน่ง</h4>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>คำนำหน้าตามตำแหน่ง</h4>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>ชื่อตำแหน่งบริหาร</h4>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>วันที่ดำรงตำแหน่งบริหาร</h4>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>ประเภทการทำงาน</h4>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>เบอร์โทรศัพท์ที่ทำงาน</h4>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>ชื่อตำแหน่ง (MIS)</h4>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>ชื่อหน่วยงาน (MIS)</h4>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>เลขอัตรา</h4>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>วันที่บรรจุ</h4>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>ชื่อหน่วยงานบริหาร</h4>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>หน่วยงานติดตัว</h4>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>หน่วยงานระดับ1</h4>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>หน่วยงานระดับ2</h4>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>หน่วยงาน</h4>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>


                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>เงินเดือน</h4>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>สถานะการทำงาน</h4>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>


                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>ลายนิ้วมือ FingerScan</h4>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3><i class="fa fa-line-chart"></i> ข้อมูลการศึกษา</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>สถาบันที่สำเร็จการศึกษา</h4>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>สาขาที่สำเร็จการศึกษา</h4>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>ระดับการศึกษา</h4>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="form-group">
                            <h4>วุฒิการศึกษา</h4>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3><i class="fa fa-line-chart"></i> ข้อมูลวงเงินการยืมเงิน</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="form-group">
                            <h4>วงเงินการยืมเงิน</h4>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3><i class="fa fa-line-chart"></i> ข้อมูลเครื่องราชอิสริยาภรณ์</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="form-group">
                            <h4>เครื่องราชอิสริยาภรณ์</h4>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3><i class="fa fa-line-chart"></i> ข้อมูลการลา</h3>
            </div>

            <div class="card-body">
                <div class="col-lg-12 col-md-12 col-xs-12" style="overflow: auto">

                </div>
            </div>
        </div>
    </div>


@endsection
