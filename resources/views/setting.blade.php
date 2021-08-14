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
                    <div class="form-group">
                        <form action="{{route('update')}}" method="post">
                            {{csrf_field()}}

                            <button class="btn btn-primary" type="submit">อัพเดทข้อมูลบุคลากร</button>
                        </form>
                    </div>
                </div>
{{--                <div class="row">--}}
{{--                    <div class="col-lg-6 col-md-6 col-xl-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <h4>ชื่อ</h4>--}}
{{--                            <input type="text" class="form-control" value="{{isset($user->FirstNameTha) ? $user->FirstNameTha : ''}}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6 col-md-6 col-xl-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <h4>นามสกุล</h4>--}}
{{--                            <input type="text" class="form-control" value="{{isset($user->LastNameTha) ? $user->LastNameTha : ''}}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6 col-md-6 col-xl-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <h4>ชื่อ(ภาษาอังกฤษ)</h4>--}}
{{--                            <input type="text" class="form-control" value="{{isset($user->FirstNameEng) ? $user->FirstNameEng : ''}}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6 col-md-6 col-xl-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <h4>นามสกุล(ภาษาอังกฤษ)</h4>--}}
{{--                            <input type="text" class="form-control" value="{{isset($user->LastNameEng) ? $user->LastNameEng : ''}}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6 col-md-6 col-xl-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <h4>คำนำหน้า</h4>--}}
{{--                            <input type="text" class="form-control" value="{{isset($user->PrenameTha) ? $user->PrenameTha : ''}}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6 col-md-6 col-xl-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <h4>คำนำหน้า(ภาษาอังกฤษ)</h4>--}}
{{--                            <input type="text" class="form-control" value="{{isset($user->LastNameTha) ? $user->LastNameTha : ''}}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6 col-md-6 col-xl-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <h4>เพศ</h4>--}}
{{--                            <input type="text" class="form-control" value="{{isset($user->SexNameTha) ? $user->SexNameTha : ''}}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6 col-md-6 col-xl-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <h4>กรุ๊ปเลือด</h4>--}}
{{--                            <input type="text" class="form-control" value="{{isset($user->BloodTypeNameEng) ? $user->BloodTypeNameEng : ''}}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6 col-md-6 col-xl-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <h4>วันเกิด</h4>--}}
{{--                            <input type="text" class="form-control" value="{{isset($user->BirthDate) ? $user->BirthDate : ''}}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6 col-md-6 col-xl-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <h4>หมายเลขบัตรประชาชน</h4>--}}
{{--                            <input type="text" class="form-control" value="{{isset($user->PersonalID) ? $user->PersonalID : ''}}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6 col-md-6 col-xl-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <h4>อีเมลมหาวิทยาลัย</h4>--}}
{{--                            <input type="text" class="form-control" value="{{isset($user->EmailCMU) ? $user->EmailCMU : ''}}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6 col-md-6 col-xl-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <h4>ที่อยู่ ไม่มี</h4>--}}
{{--                            <input type="text" class="form-control" value="{{isset($user->LastNameTha) ? $user->LastNameTha : ''}}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6 col-md-6 col-xl-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <h4>อายุตามปีปฏิทิน ไม่มี</h4>--}}
{{--                            <input type="text" class="form-control" value="{{isset($user->LastNameTha) ? $user->LastNameTha : ''}}">--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-lg-6 col-md-6 col-xl-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <h4>อายุจริง ไม่มี</h4>--}}
{{--                            <input type="text" class="form-control" value="{{isset($user->LastNameTha) ? $user->LastNameTha : ''}}">--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
            </div>
        </div>
    </div>


@endsection
