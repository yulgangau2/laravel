<?php

namespace App\Http\Controllers;

use App\ApiController;
use App\Education;
use App\Employee;
use App\EmployeeEducation;
use App\EmployeeExecutive;
use App\EmployeeHistoryWork;
use App\EmployeeHrPosition;
use App\EmployeeLeaveEducation;
use App\EmployeePositionHistory;
use App\Executive;
use App\NowUpdate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function getALlEmployee($orgId, $token)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://mis-api.cmu.ac.th/hr/v2/organizations/$orgId/employees/working",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "orgid: $orgId",
                "Authorization: bearer $token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);
    }

    public function getData($url, $orgId, $perId, $token)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "orgid: $orgId",
                "personalid: $perId",
                "Authorization: Bearer $token"
            ],
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $json = isset(json_decode($response, true)['data']) ? json_decode($response, true)['data'] : [];
        return $json;
    }


    public function getEmployeeWorker($perId, $orgId, $token)
    {
        ini_set('max_execution_time', '1200');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://mis-api.cmu.ac.th/hr/v2.2/employees/workhistories",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "orgid: $orgId",
                "personalid: $perId",
                "Authorization: Bearer $token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);
    }




    public function check_priority($position){

        $priority = 99;
        if ($position == 'ศาสตราจารย์'){
            $priority = 1;
        }else if ($position == 'รองศาสตราจารย์'){
            $priority = 2;
        }else if ($position == 'ผู้ช่วยศาสตราจารย์'){
            $priority = 3;
        }else if ($position == 'อาจารย์'){
            $priority = 4;
        }

        return $priority;

    }

    public function upload_layoff(Request $request){
        ini_set('max_execution_time', '1200');

        $file = $request->file('layoff');
        DB::beginTransaction();
        try{
            if ($file){
                \Illuminate\Support\Facades\DB::table('lay_offs')->delete();
                $path = Storage::putFile('public', $file);
                $open = fopen('storage/'.basename($path), "r");
//
                $data =[];
                while (($row = fgetcsv($open, 1000, ",")) !== FALSE)
                {
                    if ($row[0] == "" || $row[1] == ""){
                        continue;
                    }
                    $name = explode("\n",$row[1]);

                    $start_red_at = null;
                    $end_red_at = null;
                    $danger_colspan = null;

                    if ($row[3] == 'อาจารย์'){
///           $start_red_at = \Carbon\Carbon::createFromFormat('d/m/y',$row[12])->addYears(543)->addDay()->format('d/m/Y');
//                        $end_red_at =  \Carbon\Carbon::createFromFormat('d/m/y',$row[12])->addYears(543)->addYears(2)->format('d/m/Y');
                        $danger_colspan = 2;
                        $start_green = $row[6];
                    }else{
                        $start_green = $row[5];
                    }

//        dd( $row,\Carbon\Carbon::createFromFormat('d/m/y',$row[7])->format('d/m/Y'));
                    $tmp = [
                        'firstname' => $name[0],
                        'lastname' => $name[1],
                        'no' => $row[2],
                        'position' => $row[3],
                        'first_day' => \Carbon\Carbon::createFromFormat('d/m/y',$row[6])->addYears(543)->format('d/m/Y'),
                        'start_green_at' => \Carbon\Carbon::createFromFormat('d/m/y',$start_green)->addYears(543)->format('d/m/Y'),
                        //5 or 6
                        'end_green_at' => \Carbon\Carbon::createFromFormat('d/m/y',$row[9])->subYear()->addYears(543)->format('d/m/Y'),
                        'safe_colspan' => $row[8],
                        'start_yellow_at' => \Carbon\Carbon::createFromFormat('d/m/y',$row[9])->subYear()->addDay()->addYears(543)->format('d/m/Y'),
                        'end_yellow_at' => \Carbon\Carbon::createFromFormat('d/m/y',$row[9])->addYears(543)->format('d/m/Y'),
                        'warning_colspan' => $row[10],

                        'start_red_at' => \Carbon\Carbon::createFromFormat('d/m/y',$row[11])->addYears(543)->format('d/m/Y'),
                        'end_red_at' =>  \Carbon\Carbon::createFromFormat('d/m/y',$row[12])->addYears(543)->format('d/m/Y'),
                        'danger_colspan' => $danger_colspan,
                        'exit_at' =>  \Carbon\Carbon::createFromFormat('d/m/y',$row[13])->addYears(543)->format('d/m/Y'),


//            'test8' => $row[15],
//            'leave_education' => $row[16],

                    ];
//                    dd($row,$tmp);
                    $data[] = $tmp;
                    // Read the data
                }

                fclose($open);
                unlink('storage/'.basename($path));
                \Illuminate\Support\Facades\DB::table('lay_offs')->insert($data);
            }
            DB::commit();
            return redirect()->back()->with([
                'success' => true,
                'message' => "อัพโหลดข้อมูลสำเร็จ"
            ]);
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->withErrors([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }


    }
    public function update_employee(Request $request)
    {
        ini_set('max_execution_time', '1200');

        $orgId = '0000000021';
        $api = new ApiController();
        $token = $api->getToken("mishr.$orgId.employee.member");

        if (!$token) {
            return redirect()->back()->withErrors([
                'success' => false,
                'message' => "ไม่ได้รับ Token"
            ]);
        }
        $json = $this->getALlEmployee($orgId, $token);

        DB::beginTransaction();
        try {

            foreach ($json['data'] as $i => $data) {
                $emp = Employee::query()
                    ->where('personalID', $data['personalID'])
                    ->orWhere('emailCMU', $data['email'])
                    ->first();
                if (!$emp) {
                    $emp = new Employee();
//                    $emp->prenameTha = $data['prenameTha'];
                    $emp->emailCMU = $data['email'];
                    $emp->personalID = $data['personalID'];
                    $emp->save();

                }
                $emp->save();
            }




            $update = NowUpdate::query()
                ->where('name','=','employee')
                ->first();
            if (!$update) {
                $update = new NowUpdate();
                $update->name = 'employee';
            }
            $update->updated_at = Carbon::now();
            $update->save();
            DB::commit();
            return redirect()->back()->with([
                'success' => true,
                'message' => 'อัพเดทข้อมูลสำเร็จ'
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }


    }

    public function update_history_worker(Request $request)
    {
        ini_set('max_execution_time', '1200');

        $orgId = '0000000021';

        $api = new ApiController();

        $token = $api->getToken("mishr.$orgId.workhistory");

        if (!$token) {
            return redirect()->back()->withErrors([
                'success' => false,
                'message' => "ไม่ได้รับ Token"
            ]);
        }

        $nowYear = (int)Carbon::now()->format('Y');
        DB::beginTransaction();
        try {
            $emps = Employee::query()
                ->get();


            foreach ($emps as $i => $emp) {
                $perId = $emp->PersonalID;
                $emailCmu = $emp->EmailCMU;
//                $json = $this->getEmployeeWorker($perId, $orgId, $token);
                $json = $this->getEmployeeWorker($perId, $orgId, $token);


                if ($json['message'] == 'success') {
                    $ps = null;
                    $check = null;
                    foreach ($json['data']['positionHistoryList'] as $j => $position) {
                        $year = (int)(Carbon::createFromFormat('d/m/Y', $position['employeeAssignDate'])->format('Y'));
                        $his = EmployeeHistoryWork::query()
                            ->where('employee_id', '=', $emp->id)
                            ->where('year', '=', $year)
                            ->where('PositionName', '=', $position['positionName'])
                            ->where('ReferenceDocumentTypeNameTha', '=', $position['referenceDocumentTypeNameTha'])
                            ->first();


                        if ($year == $nowYear || !$his) {
                            if (!$his) {
                                $his = new EmployeeHistoryWork();
                            }

                            $his->year = $year;
                            $his->employee_id = $emp->id;
                            $his->PositionName = $position['positionName'];
                            $his->ReferenceDocumentTypeNameTha = $position['referenceDocumentTypeNameTha'];
                            $his->EmployeeAssignDate = $position['employeeAssignDate'];

                            if ($position['employeeEndDate'] && $position['employeeEndDate'] != '') {
                                $his->EmployeeEndDate = $position['employeeEndDate'];
                            }

                            $his->CurrentSalaryRate = $position['currentSalaryRate'];
                            $his->EmployeeTypeNameTha = $position['employeeTypeNameTha'];
                            $his->OtherMoney = $position['otherMoney'];
                            $his->Detail = $position['detail'];
                            $his->OrganizationFullNameTha = $position['organizationFullNameTha'];
                            $his->priority = $this->check_priority($position['positionName']);
                            $his->year = (int)Carbon::createFromFormat('d/m/Y',$position['employeeAssignDate'])->format('Y');
                            $his->save();

                            if ($position['positionName'] == 'ศาสตราจารย์') {
                                if ($check && $check == 'ศาสตราจารย์') {
                                    $ps = $position;
                                } else if (!$check) {
                                    $check = 'ศาสตราจารย์';
                                }
                            } else if ($position['positionName'] == 'รองศาสตราจารย์') {
                                if ($check && $check == 'รองศาสตราจารย์') {
                                    $ps = $position;
                                } else if (!$check) {
                                    $check = 'รองศาสตราจารย์';
                                }
                            } else if ($position['positionName'] == 'ผู้ช่วยศาสตราจารย์') {
                                if ($check && $check == 'ผู้ช่วยศาสตราจารย์') {
                                    $ps = $position;
                                } else if (!$check) {
                                    $ps = $position;
                                    $check = 'ผู้ช่วยศาสตราจารย์';
                                }
                            }

                        }

                    }


                    if ($ps) {
//                        $emp->EposDate = $ps['employeeAssignDate'];
                        $emp->positionName = $ps['positionName'];
                        $emp->save();

                    } else {
                        $emp->positionName = $json['data']['positionHistoryList'][0]['positionName'];
                        $emp->save();

                    }

                    $empHistories = EmployeeHistoryWork::query()
                        ->where('employee_id',$emp->id)
                        ->orderBy('year','ASC')
                        ->orderBy('priority','ASC')
                        ->get()
                        ->groupBy('year');

                    $old = null;

//                    dd($empHistories);
                    foreach ($empHistories as $year =>$h){
                        $his = $h[0];

                        foreach ($h  as $c => $p){
                            if ($p->ReferenceDocumentTypeNameTha == 'เปลี่ยนตำแหน่ง'){
                                $his = $p;
                                break;
                            }
                        }


                        $empPosition = EmployeePositionHistory::query()
                            ->where('employee_id', '=', $emp->id)
                            ->where('year', '=', $year)
                            ->first();



                        if (!$empPosition) {
                            if ($old && $his->ReferenceDocumentTypeNameTha != 'เปลี่ยนตำแหน่ง'){
                                $empPosition = new EmployeePositionHistory();
                                $empPosition->year = $year;
                                $empPosition->employee_id = $emp->id;
                                $empPosition->PositionName = $old->PositionName;
                                $empPosition->ReferenceDocumentTypeNameTha = $old->ReferenceDocumentTypeNameTha;
                                $empPosition->EmployeeAssignDate = $old->EmployeeAssignDate;

                                if ($his->EmployeeEndDate && $old->EmployeeEndDate != '') {
                                    $empPosition->EmployeeEndDate = $old->EmployeeEndDate;
                                }

                                $empPosition->CurrentSalaryRate = $old->CurrentSalaryRate;
                                $empPosition->EmployeeTypeNameTha = $old->EmployeeTypeNameTha;
                                $empPosition->OtherMoney = $old->OtherMoney;
                                $empPosition->Detail = $old->Detail;
                                $empPosition->OrganizationFullNameTha = $old->OrganizationFullNameTha;
                                $empPosition->save();
                            }else if (!$old || $his->ReferenceDocumentTypeNameTha == 'เปลี่ยนตำแหน่ง'){
                                $empPosition = new EmployeePositionHistory();
                                $empPosition->year = $year;
                                $empPosition->employee_id = $emp->id;
                                $empPosition->PositionName = $his->PositionName;
                                $empPosition->ReferenceDocumentTypeNameTha = $his->ReferenceDocumentTypeNameTha;
                                $empPosition->EmployeeAssignDate = $his->EmployeeAssignDate;

                                if ($his->EmployeeEndDate && $his->EmployeeEndDate != '') {
                                    $empPosition->EmployeeEndDate = $his->EmployeeEndDate;
                                }

                                $empPosition->CurrentSalaryRate = $his->CurrentSalaryRate;
                                $empPosition->EmployeeTypeNameTha = $his->EmployeeTypeNameTha;
                                $empPosition->OtherMoney = $his->OtherMoney;
                                $empPosition->Detail = $his->Detail;
                                $empPosition->OrganizationFullNameTha = $his->OrganizationFullNameTha;
                                $empPosition->save();
                            }
                        }else{

                            if ($his->ReferenceDocumentTypeNameTha == 'เปลี่ยนตำแหน่ง'){
                                $empPosition->year = $year;
                                $empPosition->employee_id = $emp->id;
                                $empPosition->PositionName = $his->PositionName;
                                $empPosition->ReferenceDocumentTypeNameTha = $his->ReferenceDocumentTypeNameTha;
                                $empPosition->EmployeeAssignDate = $his->EmployeeAssignDate;

                                if ($his->EmployeeEndDate && $his->EmployeeEndDate != '') {
                                    $empPosition->EmployeeEndDate = $his->EmployeeEndDate;
                                }

                                $empPosition->CurrentSalaryRate = $his->CurrentSalaryRate;
                                $empPosition->EmployeeTypeNameTha = $his->EmployeeTypeNameTha;
                                $empPosition->OtherMoney = $his->OtherMoney;
                                $empPosition->Detail = $his->Detail;
                                $empPosition->OrganizationFullNameTha = $his->OrganizationFullNameTha;
                                $empPosition->save();
                            }else if ($his->EmployeeTypeNameTha == 'พนักงานมหาวิทยาลัยประจำ' && $empPosition->EmployeeTypeNameTha != "พนักงานมหาวิทยาลัยประจำ"){
                                $empPosition->year = $year;
                                $empPosition->employee_id = $emp->id;
                                $empPosition->PositionName = $his->PositionName;
                                $empPosition->ReferenceDocumentTypeNameTha = $his->ReferenceDocumentTypeNameTha;
                                $empPosition->EmployeeAssignDate = $his->EmployeeAssignDate;

                                if ($his->EmployeeEndDate && $his->EmployeeEndDate != '') {
                                    $empPosition->EmployeeEndDate = $his->EmployeeEndDate;
                                }

                                $empPosition->CurrentSalaryRate = $his->CurrentSalaryRate;
                                $empPosition->EmployeeTypeNameTha = $his->EmployeeTypeNameTha;
                                $empPosition->OtherMoney = $his->OtherMoney;
                                $empPosition->Detail = $his->Detail;
                                $empPosition->OrganizationFullNameTha = $his->OrganizationFullNameTha;
                                $empPosition->save();
                            }
                        }

                        $old = $his;
                    }
                }
            }

            $update = NowUpdate::query()
                ->where('name','=','history_work')
                ->first();
            if (!$update) {
                $update = new NowUpdate();
                $update->name = 'history_work';
            }
            $update->updated_at = Carbon::now();
            $update->save();
            DB::commit();
            return redirect()->back()->with([
                'success' => true,
                'message' => 'อัพเดทข้อมูลสำเร็จ'
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }

    }

    public function update_work_current_info(Request $request)
    {
        $orgId = '0000000021';
        ini_set('max_execution_time', 1200);
        set_time_limit(1200);

        $api = new ApiController();

        $token = $api->getToken("mishr.$orgId.workcurrentinfo");

        if (!$token) {
            return redirect()->back()->withErrors([
                'success' => false,
                'message' => "ไม่ได้รับ Token"
            ]);
        }


        DB::beginTransaction();
        try {
            $emps = Employee::query()
                ->get();

            foreach ($emps as $i => $emp) {
                $perId = $emp->PersonalID;
                $emailCmu = $emp->EmailCMU;
                $json = $this->getData("https://mis-api.cmu.ac.th/hr/v2.2/employees/workcurrentinfo", $orgId, $perId, $token);

                if (isset($json['workStatusNameTha']) && $json['workStatusNameTha'] == 'ทำงานปกติ') {
                    if (isset($json['hrPositionNumber']) && $json['hrPositionNumber']) {
                        $emp->HrPositionNumber = $json['hrPositionNumber'];
                    }

                    if (isset($json['currentSalaryRate']) && $json['currentSalaryRate']) {
                        $emp->CurrentSalaryRate = $json['currentSalaryRate'];
                    }

                    if (isset($json['hrPositionNumber']) && $json['hrPositionNumber']) {
                        $type = strpos($json['hrPositionNumber'], 'EP') !== false ? 'เชิงรุก' : 'พันธกิิจ';
                        $emp->Type = $type;

                    }
                    if ($json['positionNameTha'] == 'อาจารย์' || $json['positionNameTha'] == 'ผู้ช่วยศาสตราจารย์' || $json['positionNameTha'] == 'รองศาสตราจารย์' || $json['positionNameTha'] == 'ศาสตราจารย์') {
                        $emp->TypeEmployee = 'อาจารย์';
                    } else {
                        $emp->TypeEmployee = "พนักงาน";
                    }
                    $emp->WorkStatusNameTha = 'ทำงานปกติ';
                    $emp->save();

                } else {
                    if (!$emp->WorkStatusNameTha && !$emp->ExitDate) {
                        $emp->WorkStatusNameTha = 'ออกจากการทำงาน';
                        $emp->ExitDate = Carbon::now()->addYears(543)->format('d/m/Y');
                        $emp->save();
                    }

                }

                $nowYear = (int)Carbon::now()->addYears(543)->format('Y');
                $firstYear = (int)Carbon::createFromFormat('d/m/Y',$json['inDate'])->format('Y');

                for ($year = $nowYear;$year>=$firstYear;$year--){
                    $empHrPosition = EmployeeHrPosition::query()
                        ->where('year',$year)
                        ->where('employee_id',$emp->id)
                        ->first();

                    if (!$empHrPosition){
                        $empHrPosition = new EmployeeHrPosition();
                        $empHrPosition->year = $year;
                        $empHrPosition->employee_id = $emp->id;
                        if (isset($json['hrPositionNumber']) && $json['hrPositionNumber']) {
                            $type = strpos($json['hrPositionNumber'], 'EP') !== false ? 'เชิงรุก' : 'พันธกิิจ';
                            $empHrPosition->hrPositionNumber = $json['hrPositionNumber'];
                            $empHrPosition->Type = $type;
                        }
                        $empHrPosition->save();
                    }else{
                        // Update Only Now Mont
                        if ($year == $nowYear){
                            $empHrPosition->year = $year;
                            $empHrPosition->employee_id = $emp->id;
                            if (isset($json['hrPositionNumber']) && $json['hrPositionNumber']) {
                                $type = strpos($json['hrPositionNumber'], 'EP') !== false ? 'เชิงรุก' : 'พันธกิิจ';
                                $empHrPosition->hrPositionNumber = $json['hrPositionNumber'];
                                $empHrPosition->Type = $type;
                            }
                            $empHrPosition->save();
                        }
                    }
                }
            }

            $update = NowUpdate::query()
                ->where('name','=','work_current')
                ->first();
            if (!$update) {
                $update = new NowUpdate();
                $update->name = 'work_current';
            }
            $update->updated_at = Carbon::now();
            $update->save();
            DB::commit();
            return redirect()->back()->with([
                'success' => true,
                'message' => 'อัพเดทข้อมูลสำเร็จ'
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }


    public function update_personal_info(Request $request)
    {
        ini_set('max_execution_time', '1200');

        $empoyees = Employee::query()
            ->get();

        $api = new ApiController();
        $orgId = '0000000021';
        $token1 = $api->getToken("mishr.$orgId.personalinfo");
        if (!$token1) {
            return redirect()->back()->withErrors([
                'success' => false,
                'message' => "ไม่ได้รับ Token"
            ]);
        }
        foreach ($empoyees as $i => $emp) {
            $perId = "$emp->PersonalID";
            $emailCmu = $emp->EmailCMU;


            if ($perId) {

                DB::beginTransaction();
                try {
                    //1

                    $json = $this->getData('https://mis-api.cmu.ac.th/hr/v2.2/employees/personalinfo', $orgId, $perId, $token1);

                    dd($json);
                    $user = Employee::query()
                        ->where('personalID', $json['personalID'])
                        ->orWhere('emailCMU', $json['emailCMU'])
                        ->first();


                    if ($user) {
//                        $user = Employee::query()->where('personalID', $json['personalID'])->first();
                        $user->FullName = $json['prenameTha'] . '' . $json['firstNameTha'] . ' ' . $json['lastNameTha'];
                        $user->PrenameTha = $json['prenameTha'];
                        $user->PrenamePositionTha = $json['prenamePositionTha'];
//                        $user->PersonalID = $json['personalID'];
                        $user->FirstNameTha = $json['firstNameTha'];
                        $user->FirstNameEng = $json['firstNameEng'];
                        $user->LastNameTha = $json['lastNameTha'];
                        $user->LastNameEng = $json['lastNameEng'];
                        $user->Race = $json['race'];
                        $user->NationalityNameTha = $json['nationalityNameTha'];
                        $user->RelegionNameTha = $json['relegionNameTha'];
                        $user->SexNameTha = $json['sexNameTha'];
                        $user->CoupleStatusNameTha = $json['coupleStatusNameTha'];
                        $user->BirthDate = $json['birthDate'];
//                        $user->EmailCMU = $json['emailCMU'];
                        $user->BloodTypeNameEng = $json['bloodTypeNameEng'];
                        $user->PersonalIDTypeID = $json['personalIDTypeID'];
                        $user->MiddleNameEng = $json['middleNameEng'];
                        $user->MiddleNameTha = $json['middleNameTha'];
                        $user->CoupleStatusRef = $json['coupleStatusRef'];
                        $user->SsoNumber = $json['ssoNumber'];
                        $user->RdNumber = $json['rdNumber'];

                        if ($json['firstWorkDate'] && $json['firstWorkDate'] != '') {
                            $user->FirstWorkDate = $json['firstWorkDate'];
                            $date = Carbon::createFromFormat('d/m/Y', $json['firstWorkDate']);
                            $user->DFirstWorkDate = $date;
                        }

                        if ($json['inDate'] && $json['inDate'] != '') {
                            $inDate = explode('T', $json['inDate'])[0];

                            $user->InDate = $inDate;


                            $date = Carbon::createFromFormat('d/m/Y', $inDate);
                            $user->DInDate = $date;


//                            $endDate = ($date->addYears(7))->subDay();
//                            $user->DEndDate = $endDate;
//                            $user->EndDate = $endDate->format('d/m/Y');
                        }


                        if (isset($json['eposDate']) && $json['eposDate'] != '') {
                            $user->EposDate = $json['eposDate'];
                            $date = Carbon::createFromFormat('d/m/Y', $json['eposDate']);
                            $user->DEposDate = $date;


                            //edit
                            $endDate = ($date->addYears(7))->subDays(1);
//                            $date = Carbon::createFromFormat('d/m/Y', $json['eposDate']);
                            $user->DEndDate = $endDate;
                            $user->EndDate = $endDate->format('d/m/Y');


                        }


//                $user->DFirstWorkDate = $json['firstWorkDate'];
//                $user->DInDate = $json['inDate'];
//                $user->DEposDate = $json['eposDate'];

                        $user->EmailOther = $json['emailOther'];
                        $user->MobilePhone = $json['mobilePhone'];
                        $user->HomePhone = $json['homePhone'];
                        $user->OfficePhone = $json['officePhone'];
                        $user->employeeTypeNameTha = $json['employeeTypeNameTha'];

//                $user->education_id = 'education_id';
//                $user->agency_id = 'agency_id';
//                $user->position_id = 'position_id';
                        $user->save();
                    }

                    $update = NowUpdate::query()
                        ->where('name','=','personal_info')
                        ->first();
                    if (!$update) {
                        $update = new NowUpdate();
                        $update->name = 'personal_info';
                    }
                    $update->updated_at = Carbon::now();
                    $update->save();
                    DB::commit();

//                    return redirect()->back()->with([
//                        'success' => true,
//                        'message' => "อัพเดทข้อมูลสำเร็จ"
//                    ]);

                } catch (\Exception $exception) {
                    DB::rollBack();
                    return redirect()->back()->withErrors([
                        'success' => false,
                        'message' => $exception->getMessage()
                    ]);
                }

            }
        }

        return redirect()->back()->with([
            'success' => false,
            'message' => 'อัพเดทข้อมูลสำเร็จ'
        ]);


    }


    public function update_employee_education(Request $request)
    {
        ini_set('max_execution_time', '1200');

        $empoyees = Employee::query()
            ->get();


        $api = new ApiController();

        $orgId = '0000000021';
        $token3 = $api->getToken("mishr.$orgId.education");
        if (!$token3) {
            return redirect()->back()->withErrors([
                'success' => false,
                'message' => "ไม่ได้รับ Token"
            ]);
        }

        foreach ($empoyees as $i => $emp) {
            $perId = $emp->PersonalID;
            $emailCmu = $emp->EmailCMU;

            if ($perId) {

                DB::beginTransaction();
                try {
                    // 3 //
                    $json = $this->getData('https://mis-api.cmu.ac.th/hr/v2.2/employees/educations', $orgId, $perId, $token3);

                    if (isset($json['educationList']) && count($json['educationList']) > 0) {

                        // Update Last Education
                        $full_educations = [];
                        $begin_year = null;
                        $first_year = null;
                        $now_year = (int)Carbon::now()->addYears(543)->format('Y');

                        $first_edu_year = (int)Carbon::createFromFormat('d/m/Y', $emp->FirstWorkDate)->format('Y');


                        $tmps = [];
                        foreach ($json['educationList'] as $j => $edu) {
                            $year = (int)$edu['graduateYear'];
                            if (!$begin_year) {
                                $begin_year = $year;
                                $first_year = $year;
                                $tmps[] = $edu;
                                $last = $edu;
                            } else {
                                for ($k = $begin_year - 1; $k >= $year; $k--) {
                                    $edu['graduateYear'] = $k . '';
                                    $tmps[] = $edu;
                                }

                                $begin_year = $year;
                            }
                        }

                        // Update Now Education
                        for ($k = $first_year + 1; $k <= $now_year; $k++) {
                            $tmp = $last;
                            $tmp['graduateYear'] = $k . '';
                            $tmps[] = $tmp;
                        }
                        $full_educations = [];


                        // set only affter start year

                        if ($emp->WorkStatusNameTha == 'ทำงานปกติ') {
                            for ($index = 0; $index < count($tmps); $index++) {

                                $y = (int)$tmps[$index]['graduateYear'];

                                if ($y >= $first_edu_year) {
                                    $full_educations[] = $tmps[$index];
                                }
                            }
                        } else {

                            $last = (int)Carbon::createFromFormat('d/m/Y', $emp->ExitDate)->format('Y');
                            for ($index = 0; $index < count($tmps); $index++) {

                                $y = (int)$tmps[$index]['graduateYear'];

                                if ($y >= $first_edu_year && $y <= $last) {
                                    $full_educations[] = $tmps[$index];
                                }
                            }
                        }


                        $user = Employee::query()->where('personalID', $perId)->first();

                        foreach ($full_educations as $idx => $education) {
                            $ed = Education::query()
                                ->where('instituteName', $education['instituteName'])
                                ->where('curriculumName', $education['curriculumName'])
                                ->where('certificateName', $education['certificateName'])
                                ->where('major', $education['major'])
                                ->where('countryNameTha', $education['countryNameTha'])
                                ->first();
                            if (!$ed) {
                                $ed = new Education();
                                $ed->instituteName = $education['instituteName'];
                                $ed->curriculumName = $education['curriculumName'];
                                $ed->certificateName = $education['certificateName'];
                                $ed->major = $education['major'];
                                $ed->educationLevelNameTha = $education['educationLevelNameTha'];
                                $ed->countryNameTha = $education['countryNameTha'];
                                $ed->save();
                            }


                            $empEd = EmployeeEducation::query()
                                ->where('graduateYear', $education['graduateYear'])
                                ->where('employee_id', $ed->id)
                                ->where('education_id', $ed->id)
                                ->first();

                            if (!$empEd) {

                                $empEd = new EmployeeEducation();
                                $empEd->employee_id = $user->id;
                                $empEd->education_id = $ed->id;
                            }

                            $empEd->graduateYear = $education['graduateYear'];
                            $empEd->educationStatusName = $education['educationStatusName'];
                            $empEd->educationStatusNowName = $education['educationStatusNowName'];
                            $empEd->save();

                            if ($idx == 0) {
                                $emp->educationLevelNameTha = $education['educationLevelNameTha'];
                                $emp->save();
                            }


                        }
                    }
                    $update = NowUpdate::query()
                        ->where('name','=','employee_education')
                        ->first();
                    if (!$update) {
                        $update = new NowUpdate();
                        $update->name = 'employee_education';
                    }
                    $update->updated_at = Carbon::now();
                    $update->save();
                    DB::commit();
                } catch (\Exception $exception) {
                    DB::rollBack();
                    return redirect()->back()->withErrors([
                        'success' => false,
                        'message' => $exception->getMessage()
                    ]);
                }



            }
        }

        return redirect()->back()->with([
            'success' => false,
            'message' => 'อัพเดทข้อมูลสำเร็จ'
        ]);
    }

    public function update_employee_executive(Request $request)
    {
        ini_set('max_execution_time', '1200');
        $empoyees = Employee::query()
            ->get();


        $api = new ApiController();

        $orgId = '0000000021';
        $token2 = $api->getToken("mishr.$orgId.executive");

        if (!$token2) {
            return redirect()->back()->withErrors([
                'success' => false,
                'message' => "ไม่ได้รับ Token"
            ]);
        }



        DB::beginTransaction();
        try {

            $count = 0;
            foreach ($empoyees as $i => $emp) {
                $perId = $emp->PersonalID;
                $emailCmu = $emp->EmailCMU;

                if ($perId) {

                    // 2 //
                    $json = $this->getData('https://mis-api.cmu.ac.th/hr/v2.2/employees/executives', $orgId, $perId, $token2);


                    if (isset($json['executiveList']) && count($json['executiveList']) > 0) {
                        $count++;
//                        $user = Employee::query()
//                            ->where('personalID', $perId)
//                            ->first();

                        $amount = 0;

                        foreach ($json['executiveList'] as $j => $excutive) {
                            $ex = Executive::query()
                                ->where('positionName', $excutive['organizationBudgetName'])
                                ->where('organizationBudgetName', $excutive['organizationBudgetName'])
                                ->first();

                            if (!$ex) {
                                $ex = new Executive();
                            }
                            $ex->positionName = $excutive['positionName'];
                            $ex->organizationBudgetName = $excutive['organizationBudgetName'];
                            $ex->save();

                            $empEx = EmployeeExecutive::query()
                                ->where('employee_id', $emp->id)
                                ->where('workOnPositionStatusNameTha', $excutive['workOnPositionStatusNameTha'])
                                ->first();

                            if ($excutive['employeeAssignDate'] && $excutive['employeeEndDate']) {
                                $assign = $excutive['employeeAssignDate'];
                                $end = $excutive['employeeEndDate'];
                                $start_date = Carbon::createFromFormat('d/m/Y', $assign);
                                $end_date = Carbon::createFromFormat('d/m/Y', $end);
                                $amount += $start_date->diffInDays($end_date);
                            } else {
                                if ($j != 1) {

                                    dd($j, $excutive, $json, $perId);
                                }

                            }


                            if (!$empEx) {
                                // update Executive
                                $empEx = new EmployeeExecutive();
                                $empEx->employeeAssignDate = $assign;
                                $empEx->employeeEndDate = $end;
                                $empEx->workOnPositionStatusNameTha = $excutive['workOnPositionStatusNameTha'];
                                $empEx->executiveStausName = $excutive['executiveStausName'];
                                $empEx->employee_id = $emp->id;
                                $empEx->executive_id = $ex->id;
                                $empEx->save();
                            }


                            //////////   update current Excutive  //////////////
//                            if ($excutive['executiveStausName']  == 'บริหารปัจจุบัน') {
//
//                            }
                            ////////////////////////////////////////////////////


                            //////////////////


                        }

                        $emp->changeDate = $amount;
                        $emp->save();
                    }


                }
            }
            $update = NowUpdate::query()
                ->where('name','=','employee_executive')
                ->first();
            if (!$update) {
                $update = new NowUpdate();
                $update->name = 'employee_executive';
            }
            $update->updated_at = Carbon::now();
            $update->save();
            DB::commit();
            return redirect()->back()->with([
                'success' => false,
                'message' => 'อัพเดทข้อมูลสำเร็จ'
            ]);


        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }

    }


    public function update_employee_leavehistory(Request $request)
    {
        ini_set('max_execution_time', '1200');

        $empoyees = Employee::query()
            ->get();


        $api = new ApiController();

        $orgId = '0000000021';
        $token2 = $api->getToken("mishr.$orgId.leavehistory");
        if (!$token2) {
            return redirect()->back()->withErrors([
                'success' => false,
                'message' => "ไม่ได้รับ Token"
            ]);
        }


        $start_date = '2019-10-01';
        $end_date = '2020-09-30';

        foreach ($empoyees as $i => $emp) {
            $perId = $emp->PersonalID;
            $emailCmu = $emp->EmailCMU;

            if ($perId) {

                DB::beginTransaction();
                try {

                    // 2 //
                    $json = $this->getData("https://mis-api.cmu.ac.th/hr/v2.2/employees/leavehistories/startdate/$start_date/enddate/{$end_date}", $orgId, $perId, $token2);
//                    $user = Employee::query()->where('personalID', $json['personalID'])->first();

                    $leaveList = $json['leaveList'];

                    foreach ($leaveList as $j => $leave) {
                        //      leavebeginDate" => "31/08/2563"
                        //      "leaveFinishDate" => "31/08/2563"
                        //      "leaveTypeNameTha" => "ลากิจส่วนตัว"
                        //      "leaveAmountDay" => 0.5
                        //      "leaveReason" => "ไปเยี่ยมญาติโรงพยาบาล"
                        //      "leaveDescription" => null
                        //      "employeeLeaveID" => 32
                        //      "leaveTypeID" => 1
                    }
                    $update = NowUpdate::query()
                        ->where('name','=','leave_history')
                        ->first();
                    if (!$update) {
                        $update = new NowUpdate();
                        $update->name = 'leave_history';
                    }
                    $update->updated_at = Carbon::now();
                    $update->save();
                    DB::commit();
                    return redirect()->back()->with([
                        'success' => false,
                        'message' => 'อัพเดทข้อมูลสำเร็จ'
                    ]);
                } catch (\Exception $exception) {
                    DB::rollBack();
                    return redirect()->back()->withErrors([
                        'success' => false,
                        'message' => $exception->getMessage()
                    ]);

                }
            }
        }

    }

    public function update_employee_leaveeducation(Request $request)
    {

        ini_set('max_execution_time', '1200');
        $empoyees = Employee::query()
            ->get();


        $api = new ApiController();

        $orgId = '0000000021';
        $token2 = $api->getToken("mishr.$orgId.leaveeducation");
        if (!$token2) {
            return redirect()->back()->withErrors([
                'success' => false,
                'message' => "ไม่ได้รับ Token"
            ]);
        }


        DB::beginTransaction();
        try {
            foreach ($empoyees as $i => $emp) {
                $perId = $emp->PersonalID;
                $emailCmu = $emp->EmailCMU;

                if ($perId) {


                    // 2 //
                    $json = $this->getData('https://mis-api.cmu.ac.th/hr/v2.2/employees/leaveeducations', $orgId, $perId, $token2);
//                    $user = Employee::query()->where('personalID', $json['personalID'])->first();
                    if (count($json) > 0) {

                        $leaveEducation = $json['leaveEducationList'];;
                        foreach ($leaveEducation as $j => $lE) {

                            $leave = EmployeeLeaveEducation::query()
                                ->where('LeaveBeginDate', $lE['leavebeginDate'])
                                ->where('LeaveFinishDate', $lE['leaveFinishDate'])
                                ->where('LeaveTypeNameTha', $lE['leaveTypeNameTha'])
                                ->where('EducationLevelNameTha', $lE['educationLevelNameTha'])
                                ->where('Major', $lE['major'])
                                ->where('CountryNameTha', $lE['countryNameTha'])
                                ->where('InstituteName', $lE['instituteName'])
                                ->where('Detail', $lE['detail'])
                                ->where('Employee_id', $emp->id)
                                ->first();

                            if (!$leave) {
                                $leave = new EmployeeLeaveEducation();
                            }

                            $leave->LeaveBeginDate = $lE['leavebeginDate'];
                            $leave->LeaveFinishDate = $lE['leaveFinishDate'];
                            $leave->LeaveTypeNameTha = $lE['leaveTypeNameTha'];
                            $leave->EducationLevelNameTha = $lE['educationLevelNameTha'];
                            $leave->Major = $lE['major'];
                            $leave->CountryNameTha = $lE['countryNameTha'];
                            $leave->InstituteName = $lE['instituteName'];
                            $leave->Detail = $lE['detail'];
                            $leave->Employee_id = $emp->id;
                            $leave->save();

                            //      "leavebeginDate" => "16/05/2557"
                            //      "leaveFinishDate" => "31/07/2558"
                            //      "leaveTypeNameTha" => "ลาเพื่อศึกษาต่อต่างประเทศ"
                            //      "educationLevelNameTha" => "ปริญญาเอก"
                            //      "major" => "Computing Science"
                            //      "countryNameTha" => "ฝรั่งเศส"
                            //      "instituteName" => "Lyon 2"
                            //      "detail" => "สำเร็จการศึกษา"
                            //      "employeeLeaveID" => 1
                            //      "leaveTypeID" => 26

                        }
                    }


                }
            }
            $update = NowUpdate::query()
                ->where('name','=','leave_education')
                ->first();
            if (!$update) {
                $update = new NowUpdate();
                $update->name = 'leave_education';
            }
            $update->updated_at = Carbon::now();
            $update->save();

            DB::commit();
            return redirect()->back()->with([
                'success' => false,
                'message' => 'อัพเดทข้อมูลสำเร็จ'
            ]);

        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }


    public function update_employee_fame(Request $request)
    {
        ini_set('max_execution_time', '1200');
        $empoyees = Employee::query()
            ->get();


        $api = new ApiController();

        $orgId = '0000000021';
        $token2 = $api->getToken("mishr.$orgId.fame");
        if (!$token2) {
            return redirect()->back()->withErrors([
                'success' => false,
                'message' => "ไม่ได้รับ Token"
            ]);
        }


        foreach ($empoyees as $i => $emp) {
            $perId = $emp->PersonalID;
            $emailCmu = $emp->EmailCMU;

            if ($perId) {

                DB::beginTransaction();
                try {

                    // 2 //
                    $json = $this->getData('https://mis-api.cmu.ac.th/hr/v2.2/employees/fames', $orgId, $perId, $token2);
//                    $user = Employee::query()->where('personalID', $json['personalID'])->first();

                    $fameList = $json['fameList'];
//      receiveYear" => "2563"
//      "referenceDocument" => ""
//      "positionName" => "พนักงานปฏิบัติงาน"
//      "fameNameTha" => "เบญจมาภรณ์มงกุฎไทย"
//      "classAllType" => "ไม่ระบุ"
//      "receiveReturnStatusName" => "- / -"
//      "fameID" => 1

                    $update = NowUpdate::query()
                        ->where('name','=','employee_fame')
                        ->first();
                    if (!$update) {
                        $update = new NowUpdate();
                        $update->name = 'employee_fame';
                    }
                    $update->updated_at = Carbon::now();
                    $update->save();
                    DB::commit();
                    return redirect()->back()->with([
                        'success' => false,
                        'message' => 'อัพเดทข้อมูลสำเร็จ'
                    ]);
                } catch (\Exception $exception) {
                    DB::rollBack();
                    return redirect()->back()->withErrors([
                        'success' => false,
                        'message' => $exception->getMessage()
                    ]);
                }
            }
        }
    }


    public function update_employee_address(Request $request)
    {

        ini_set('max_execution_time', '1200');

        $empoyees = Employee::query()
            ->get();


        $api = new ApiController();

        $orgId = '0000000021';
        $token2 = $api->getToken("mishr.$orgId.address");
        if (!$token2) {
            return redirect()->back()->withErrors([
                'success' => false,
                'message' => "ไม่ได้รับ Token"
            ]);
        }


        foreach ($empoyees as $i => $emp) {
            $perId = $emp->PersonalID;
            $emailCmu = $emp->EmailCMU;

            if ($perId) {

                DB::beginTransaction();
                try {
                    // 2 //
                    $json = $this->getData('https://mis-api.cmu.ac.th/hr/v2.2/employees/addresss/permanent', $orgId, $perId, $token2);

                    $update = NowUpdate::query()
                        ->where('name','=','employee_address')
                        ->first();
                    if (!$update) {
                        $update = new NowUpdate();
                        $update->name = 'employee_address';
                    }
                    $update->updated_at = Carbon::now();
                    $update->save();
                    DB::commit();
                    return redirect()->back()->with([
                        'success' => false,
                        'message' => 'อัพเดทข้อมูลสำเร็จ'
                    ]);
                    //                    $user = Employee::query()->where('personalID', $json['personalID'])->first();

                } catch (\Exception $exception) {
                    DB::rollBack();
                    return redirect()->back()->withErrors([
                        'success' => false,
                        'message' => $exception->getMessage()
                    ]);

                }
            }
        }
    }
}
