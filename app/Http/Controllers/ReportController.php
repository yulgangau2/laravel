<?php

namespace App\Http\Controllers;

use App\Agency;
use App\ApiController;
use App\Education;
use App\Employee;
use App\EmployeeEducation;
use App\EmployeeExecutive;
use App\EmployeeHistoryWork;
use App\EmployeeLeaveEducation;
use App\EmployeePositionHistory;
use App\Executive;
use App\HistoryWork;
use App\LayOff;
use App\Position;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{


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

    public function getDataFromEmail($url, $token)
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
                "Authorization: Bearer $token"
            ],
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $json = json_decode($response, true)['data'];
        return $json;
    }

    public function bubbleSort($array, $orderBy = 'ASC')
    {

        if ($orderBy == 'ASC') {
            do {
                $swapped = false;
                for ($i = 0, $c = count($array) - 1; $i < $c; $i++) {
                    if ($array[$i] > $array[$i + 1]) {
                        list($array[$i + 1], $array[$i]) =
                            array($array[$i], $array[$i + 1]);
                        $swapped = true;
                    }
                }
            } while ($swapped);
        } else {

        }


        return $array;

    }

    public function orderAmount($array, $orderBy = 'ASC')
    {

        if ($orderBy == 'ASC') {
            do {
                $swapped = false;
                for ($i = 0, $c = count($array) - 1; $i < $c; $i++) {
                    if ($array[$i]['amount'] > $array[$i + 1]['amount']) {
                        list($array[$i + 1], $array[$i]) =
                            array($array[$i], $array[$i + 1]);
                        $swapped = true;
                    }
                }
            } while ($swapped);
        } else {

        }


        return $array;

    }

    public function index(Request $request)
    {
        $years = [];
        $type = $request->get('type', null);

        $now = Carbon::now()->addYears(543);

        $employees = Employee::query()
            ->where('TypeEmployee', 'อาจารย์')
            ->where('employeeTypeNameTha', 'พนักงานมหาวิทยาลัยประจำ')
//            ->whereNotNull('EposDate')
//            ->where('EposDate','<=',$now)
            ->orderBy('EposDate', 'ASC')
            ->with(['employee_executives', 'employee_executives.executive', 'work_histories', 'employee_leave_educations'])
            ->get();

        $users = [];
        $year_start = ((int)Carbon::now()->format('Y')) + 543;
        $year_end = $year_start + 7;


        if ($type == 'month2') {


        } else {
            foreach ($employees as $i => $employee) {
                try {
                    //////////////////////////// RESET VALUE /////////////////////////////
                    ///
                    $name = $employee->PrenameTha . ' ' . $employee->FirstNameTha . ' ' . $employee->LastNameTha;
                    $start_at = $employee->FirstWorkDate;
                    $contain = '';
                    $among = 0;
                    $diffDays = 0;
                    $diffyears = 0;
                    //////////////////////////////////////////////////////////////////
                    $safe_bar_start = '';
                    $safe_bar_end = '';

                    $warning_bar_start = '';
                    $warning_bar_end = '';

                    $danger_bar_start = '';
                    $danger_bar_end = '';

                    //////////////////////////////////////////////////////////////////
                    if ($employee->PositionName == 'อาจารย์') {
                        $safe_colspan = 3; ///**
                        $danger_colspan = 2;

                    } else {
                        $safe_colspan = 6;
                        $danger_colspan = 0;

                    }
                    $warning_colspan = 1;
                    /////////////////////////////////////////////////////////////////

                    $text_green = '';
                    $text_yellow = '';
                    $text_red = '';

                    $colspan_green = '';
                    $colspan_yellow = '';
                    $colspan_red = '';

                    ///////// START SET วันที่บรรจุฃ ///////
                    $contain_date = '';
                    if (!$employee->EposDate && ($employee->PositionName == 'อาจารย์' || $employee->PositionName == 'รองศาสตราจารย์' || $employee->PositionName == 'ผู้ช่วยศาสตราจารย์' || $employee->PositionName == 'ศาสตราจารย์')) {
                        foreach ($employee->work_histories as $j => $history) {

                            if ($employee->PositionName == $history->PositionName) {

                                $contain_date = $history->EmployeeAssignDate;
                                $contain = $history->EmployeeAssignDate;

                            } else {
                                break;
                            }
                        }
                    } else {
                        $contain_date = $employee->EposDate;
                        $contain = $employee->EposDate;
                    }
                    ///////////////////////////////////////////////////////////

                    $safe_bar_start = Carbon::createFromFormat('d/m/Y', $contain_date)->addYear()->format('d/m/Y');
                    $safe_bar_end = Carbon::createFromFormat('d/m/Y', $contain_date)->addYears($safe_colspan)->subDay()->format('d/m/Y');

                    $warning_bar_start = Carbon::createFromFormat('d/m/Y', $contain_date)->addYears($safe_colspan)->format('d/m/Y');
                    $warning_bar_end = Carbon::createFromFormat('d/m/Y', $contain_date)->addYears($safe_colspan + $warning_colspan)->subDay()->format('d/m/Y');


                    if ($employee->PositionName == 'อาจารย์') {
                        $danger_bar_start = Carbon::createFromFormat('d/m/Y', $contain_date)->addYears($safe_colspan + $warning_colspan)->format('d/m/Y');
                        $danger_bar_end = Carbon::createFromFormat('d/m/Y', $contain_date)->addYears($safe_colspan + $warning_colspan + $danger_colspan)->subDay()->format('d/m/Y');

                    }


                    ///////// START SET วัยสิ้นสุด ///////
                    $end_date = $danger_bar_end;
//                if ($employee->PositionName == 'อาจารย์') {
//                    $end_date = Carbon::createFromFormat('d/m/Y', $contain_date)->addYears(5)->subDay()->format('d/m/Y');
//                } else {
//                    $end_date = Carbon::createFromFormat('d/m/Y', $contain_date)->addYears(7)->subDay()->format('d/m/Y');
//                }
//                ];


                    /////////////////////// FIND LEAVE EDUCATION  //////////////////////
                    if (count($employee->employee_leave_educations) > 0) {

                        foreach ($employee->employee_leave_educations as $leave_education) {
                            // find diff year difference
                            $assign_date = Carbon::createFromFormat('d/m/Y', $leave_education['LeaveBeginDate']);
                            $end_date = Carbon::createFromFormat('d/m/Y', $leave_education['LeaveFinishDate']);
                            $diffday = ($assign_date->diffInDays($end_date));
                            $diffyear = round($assign_date->floatDiffInYears($end_date));

                            $diffDays += $diffday;
                            $diffyears += $diffyear;


                            $inDateGreen = (Carbon::createFromFormat('d/m/Y', $safe_bar_end));
                            $inDateYellow = (Carbon::createFromFormat('d/m/Y', $warning_bar_end));
                            if ($employee->PositionName == 'อาจารย์') {
                                $inDateRed = (Carbon::createFromFormat('d/m/Y', $danger_bar_end));

                                $assign = $assign_date;
                                if ($assign <= $inDateGreen) {

                                    $safe_bar_end = Carbon::createFromFormat('d/m/Y', $safe_bar_end)->addDays($diffday)->format('d/m/Y');
                                    $safe_colspan += round($diffyear);

                                    $warning_bar_start = Carbon::createFromFormat('d/m/Y', $warning_bar_start)->addDays($diffday)->format('d/m/Y');
                                    $warning_bar_end = Carbon::createFromFormat('d/m/Y', $warning_bar_end)->addDays($diffday)->format('d/m/Y');

                                    $danger_bar_start = Carbon::createFromFormat('d/m/Y', $danger_bar_start)->addDays($diffday)->format('d/m/Y');
                                    $danger_bar_end = Carbon::createFromFormat('d/m/Y', $danger_bar_end)->addDays($diffday)->format('d/m/Y');
                                } elseif ($assign < $inDateYellow) {

                                    $warning_bar_end = Carbon::createFromFormat('d/m/Y', $warning_bar_end)->addDays($diffday)->format('d/m/Y');
                                    $warning_colspan += round($diffyear);

                                    $danger_bar_start = Carbon::createFromFormat('d/m/Y', $danger_bar_start)->addDays($diffday)->format('d/m/Y');
                                    $danger_bar_end = Carbon::createFromFormat('d/m/Y', $danger_bar_end)->addDays($diffday)->format('d/m/Y');

                                } elseif ($assign < $inDateRed) {
                                    $danger_bar_end = Carbon::createFromFormat('d/m/Y', $danger_bar_end)->addDays($diffday)->format('d/m/Y');
                                    $danger_colspan += round($diffyear);
                                }
                            } else {
                                if ($assign_date <= $inDateGreen) {

                                    $safe_bar_end = Carbon::createFromFormat('d/m/Y', $safe_bar_end)->addDays($diffday)->format('d/m/Y');
                                    $safe_colspan += round($diffyear);

                                    $warning_bar_start = Carbon::createFromFormat('d/m/Y', $warning_bar_start)->addDays($diffday)->format('d/m/Y');
                                    $warning_bar_end = Carbon::createFromFormat('d/m/Y', $warning_bar_end)->addDays($diffday)->format('d/m/Y');


                                } elseif ($assign_date < $inDateYellow) {

                                    $warning_bar_end = Carbon::createFromFormat('d/m/Y', $warning_bar_end)->addDays($diffday)->format('d/m/Y');
                                    $warning_colspan += round($diffyear);
                                }
                            }

                        }
                    }


                    ////////////////////////////////////////////////////////////////////


                    if (count($employee->employee_executives)) {
                        foreach ($employee->employee_executives as $exec) {

                            $assign_date = Carbon::createFromFormat('d/m/Y', $exec['employeeAssignDate']);
                            $end_date = Carbon::createFromFormat('d/m/Y', $exec['employeeEndDate']);

                            $diffday = ($assign_date->diffInDays($end_date));
                            $diffyear = round($assign_date->floatDiffInYears($end_date));


                            $diffDays += $diffday;
                            $diffyears += $diffyear;

                            $inDateGreen = (Carbon::createFromFormat('d/m/Y', $safe_bar_end));
                            $inDateYellow = (Carbon::createFromFormat('d/m/Y', $warning_bar_end));

                            if ($employee->PositionName == 'อาจารย์') {
                                $inDateRed = (Carbon::createFromFormat('d/m/Y', $danger_bar_end));

                                $assign = $assign_date;
                                if ($assign <= $inDateGreen) {

                                    $safe_bar_end = Carbon::createFromFormat('d/m/Y', $safe_bar_end)->addDays($diffday)->format('d/m/Y');
                                    $safe_colspan += round($diffyear);

                                    $warning_bar_start = Carbon::createFromFormat('d/m/Y', $warning_bar_start)->addDays($diffday)->format('d/m/Y');
                                    $warning_bar_end = Carbon::createFromFormat('d/m/Y', $warning_bar_end)->addDays($diffday)->format('d/m/Y');

                                    $danger_bar_start = Carbon::createFromFormat('d/m/Y', $danger_bar_start)->addDays($diffday)->format('d/m/Y');
                                    $danger_bar_end = Carbon::createFromFormat('d/m/Y', $danger_bar_end)->addDays($diffday)->format('d/m/Y');
                                } elseif ($assign < $inDateYellow) {

                                    $warning_bar_end = Carbon::createFromFormat('d/m/Y', $warning_bar_end)->addDays($diffday)->format('d/m/Y');
                                    $warning_colspan += round($diffyear);

                                    $danger_bar_start = Carbon::createFromFormat('d/m/Y', $danger_bar_start)->addDays($diffday)->format('d/m/Y');
                                    $danger_bar_end = Carbon::createFromFormat('d/m/Y', $danger_bar_end)->addDays($diffday)->format('d/m/Y');

                                } elseif ($assign < $inDateRed) {
                                    $danger_bar_end = Carbon::createFromFormat('d/m/Y', $danger_bar_end)->addDays($diffday)->format('d/m/Y');
                                    $danger_colspan += round($diffyear);
                                }
                            } else {
                                if ($assign_date <= $inDateGreen) {

                                    $safe_bar_end = Carbon::createFromFormat('d/m/Y', $safe_bar_end)->addDays($diffday)->format('d/m/Y');
                                    $safe_colspan += round($diffyear);

                                    $warning_bar_start = Carbon::createFromFormat('d/m/Y', $warning_bar_start)->addDays($diffday)->format('d/m/Y');
                                    $warning_bar_end = Carbon::createFromFormat('d/m/Y', $warning_bar_end)->addDays($diffday)->format('d/m/Y');


                                } elseif ($assign_date < $inDateYellow) {

                                    $warning_bar_end = Carbon::createFromFormat('d/m/Y', $warning_bar_end)->addDays($diffday)->format('d/m/Y');
                                    $warning_colspan += round($diffyear);
                                }
                            }
                        }
                    }

                    ///////////////////////

                    ////////////// FIND AMOUNT ////////////////////////

                    $now = Carbon::now()->addYears(2);
                    if ($employee->PositionName == 'อาจารย์') {
                        $last = Carbon::createFromFormat('d/m/Y', $danger_bar_end);
                    } else {
                        $last = Carbon::createFromFormat('d/m/Y', $warning_bar_end);
                    }

                    $amount = $now->diffInDays($last);

                    /// //////////////////////////////////////////////////


                    ////////////////////////////////// FIND START AND END YEAR ///////////////////////////////
                    $s = (int)Carbon::createFromFormat('d/m/Y', $safe_bar_start)->format('Y');

                    if ($employee->PositionName == 'อาจารย์') {
                        $e = (int)Carbon::createFromFormat('d/m/Y', $danger_bar_end)->format('Y');
                    } else {
                        $e = (int)Carbon::createFromFormat('d/m/Y', $warning_bar_end)->format('Y');
                    }

                    if ($s < $year_start) {
                        $year_start = $s;
                    }

                    if ($e > $year_end) {
                        $year_end = $e;
                    }
                    /////////////////////////////////////////////////////////////////////////////////////////

                    $tmp = [
                        'name' => $name,
                        'among' => $amount,
                        'start_at' => $start_at,
                        'contain' => $contain,
                        'safe_bar_start' => $safe_bar_start,
                        'safe_bar_end' => $safe_bar_end,
                        'safe_colspan' => $safe_colspan,
                        'warning_bar_start' => $warning_bar_start,
                        'warning_bar_end' => $warning_bar_end,
                        'warning_colspan' => $warning_colspan,
                        'danger_bar_start' => $danger_bar_start,
                        'danger_bar_end' => $danger_bar_end,
                        'danger_colspan' => $danger_colspan,
                        'positionName' => $employee->PositionName,
                        'year_start' => Carbon::createFromFormat('d/m/Y', $safe_bar_start)->format('Y')

                    ];

//                    if ($i==1){
//                        dd($i,$tmp,$employee->work_histories,$employee->employee_leave_educations);
//                    }
                    $users[] = $tmp;

                } catch (\Exception $exception) {
                    dd($i, $employee, $exception->getMessage());
                }
            }

            ///////////////// SET YEARS OF HEADER  ////////////////////
            for ($i = $year_start; $i < $year_end + 5; $i++) {
                $years[] = $i;
            }
            ////////////////////////////////

        }


        return view('index', [
            'users' => $users,
            'years' => $years,
        ]);

    }

    public function index2(Request $request)
    {
        $leyoffs = LayOff::query()
            ->get();

        $first_year = Carbon::now()->addYears(543);
        $end_year = Carbon::now()->addYears(543);

        foreach ($leyoffs as $i => $layoff) {
            $now = Carbon::now()->addYears(543);


//            $s_year = Carbon::createFromFormat('d/m/Y', $layoff->start_green_at)->format('Y');
            $s_year = Carbon::createFromFormat('d/m/Y', $layoff->start_green_at)->addYear()->format('Y');

            if ($layoff->end_red_at) {
                $e = Carbon::createFromFormat('d/m/Y', $layoff->end_red_at);
                $amount = $now->diffInDays($e);
                $e_year = Carbon::createFromFormat('d/m/Y', $layoff->end_red_at)->format('Y');
            } else {
                $e = Carbon::createFromFormat('d/m/Y', $layoff->end_yellow_at);
                $amount = $now->diffInDays($e);
                $e_year = Carbon::createFromFormat('d/m/Y', $layoff->end_yellow_at)->format('Y');
            }


            $safe_colspan = ((Carbon::createFromFormat('d/m/Y', $layoff->start_green_at)->addYear()->diffInDays(Carbon::createFromFormat('d/m/Y', $layoff->end_green_at))) / 365);
            $warning_colspan = ((Carbon::createFromFormat('d/m/Y', $layoff->start_yellow_at)->diffInDays(Carbon::createFromFormat('d/m/Y', $layoff->end_yellow_at))) / 365);
            $danger_colspan = ((Carbon::createFromFormat('d/m/Y', $layoff->start_red_at)->diffInDays(Carbon::createFromFormat('d/m/Y', $layoff->end_red_at))) / 365);


            $safe_colspan = (int)Carbon::createFromFormat('d/m/Y', $layoff->end_green_at)->format('Y') - (int)Carbon::createFromFormat('d/m/Y', $layoff->start_green_at)->addYear()->format('Y');
            $warning_colspan = (int)Carbon::createFromFormat('d/m/Y', $layoff->end_yellow_at)->format('Y') - (int)Carbon::createFromFormat('d/m/Y', $layoff->start_yellow_at)->format('Y');
            $danger_colspan = (int)Carbon::createFromFormat('d/m/Y', $layoff->end_red_at)->format('Y') - (int)Carbon::createFromFormat('d/m/Y', $layoff->start_red_at)->format('Y');


            if ($layoff->firstname . ' ' . $layoff->lastname == "นางสาวธีราพร แซ่แห่ว") {
//                dd($safe_colspan,$warning_colspan,$danger_colspan,$layoff);
            }

            $tmp = [
                'name' => $layoff->firstname . ' ' . $layoff->lastname,
                'contain' => $layoff->start_green_at,
                'safe_colspan' => $safe_colspan,
//                'safe_colspan' => $layoff->safe_colspan,
//                'safe_start_at' => $layoff->start_green_at,
                'safe_start_at' => Carbon::createFromFormat('d/m/Y', $layoff->start_green_at)->addYear()->format('d/m/Y'),
                'safe_end_at' => $layoff->end_green_at,
                'warning_start_at' => $layoff->start_yellow_at,
                'warning_end_at' => $layoff->end_yellow_at,
                'warning_colspan' => $warning_colspan,
//                'warning_colspan' => $layoff->warning_colspan,
                'danger_start_at' => $layoff->start_red_at,
                'danger_end_at' => $layoff->end_red_at,
                'danger_colspan' => $danger_colspan,
//                'danger_colspan' => $layoff->danger_colspan,
                'position' => $layoff->position,
                'first_dat' => $layoff->first_day,
                'amount' => $amount,
                'year_start' => (int)$s_year
            ];

            $users[] = $tmp;


            if ($first_year > $s_year) {
                $first_year = $s_year;
            }

            if ($end_year < $e_year) {
                $end_year = $e_year;
            }
        }


        $users = $this->orderAmount($users);
        // col span fail
        $years = [];
        for ($i = $first_year; $i < $end_year; $i++) {
            $years[] = $i;
        }


        return view('new_logic', [
            'users' => $users,
            'years' => $years,
        ]);
    }

    public function index3(Request $request)
    {
        $temp = ["เจ้าหน้าที่โครงการ", 'ผู้ประสานงานโครงการ', 'นักวิจัย', 'เจ้าหน้าที่ประสานงานโครงการ'];
        $employees = Employee::query()
            ->whereNotIn('PositionName', $temp)
            ->get()
            ->groupBy('id');

        $ids = Employee::query()
            ->whereNotIn('PositionName', $temp)
            ->pluck('id');


        $startYear = $request->get('start_year', 2560);
        $endYear = $request->get('end_year', 2564);
        $years = [];

        $history = EmployeePositionHistory::query()
            ->where('year', '>=', $startYear)
            ->where('year', '<=', $endYear)
            ->whereIn('employee_id', $ids)
            ->orderBy('year', 'ASC')
            ->get()
            ->groupBy('year');

//        dd($history);
        $data = [
            'full_look' => 0,
            'full_pun' => 0,
            'part_look' => 0,
            'part_pun' => 0,
        ];

        foreach ($history as $y => $h) {
            $count = 0;

            $years[] = $y;
            $data[$y] = [
                'full_academic' => 0,
                'full_support' => 0,
                'part_academic' => 0,
                'part_support' => 0
            ];

            foreach ($h as $i => $emp) {

//                if($employee->employeeTypeNameTha == 'พนักงานมหาวิทยาลัยประจำ'){
                if ($emp->EmployeeTypeNameTha == 'พนักงานมหาวิทยาลัยประจำ') {

                    if ($emp->PositionName == 'อาจารย์' || $emp->PositionName == 'ผู้ช่วยศาสตราจารย์' || $emp->PositionName == 'รองศาสตราจารย์' || $emp->PositionName == 'ศาสตราจารย์') {
                        $data[$y]['full_academic'] += 1;
                    } else {
                        $data[$y]['full_support'] += 1;
                    }
                } else {
                    if ($emp->PositionName == 'อาจารย์' || $emp->PositionName == 'ผู้ช่วยศาสตราจารย์' || $emp->PositionName == 'รองศาสตราจารย์' || $emp->PositionName == 'ศาสตราจารย์') {
                        $data[$y]['part_academic'] += 1;
                    } else {
                        $data[$y]['part_support'] += 1;
                    }
                }
                $count++;
            }
        }


        ///////////////
        //ไม่ไช่เป็นเชิงรุก
        foreach ($employees as $id => $emp) {
            if ($emp[0]->TypeEmployee == 'อาจารย์') {
                if ($emp[0]->Type == 'เชิงรุก') {
                    $data['full_look'] += 1;
                } else {
                    $data['full_pun'] += 1;
                }
            } else {
                if ($emp[0]->Type == 'เชิงรุก') {
                    $data['part_look'] += 1;
                } else {
                    $data['part_pun'] += 1;
                }
            }
        }

//        dd($data);


        return view('index3', [
            'data' => $data,
            'years' => $years
        ]);
    }

    public function index4(Request $request)
    {

        /// First work detect

        /// ปีที่ตรวจสอบสำเร็จการศุกษาหรือยัง
        $startYear = $request->get('start_year', 2560);
        $endYear = $request->get('end_year', 2563);
        $years = [];
        $data = [];

        #
        $temp = ["เจ้าหน้าที่โครงการ", 'ผู้ประสานงานโครงการ', 'นักวิจัย', 'เจ้าหน้าที่ประสานงานโครงการ'];
        $emp_ids = Employee::query()
            ->whereIn('PositionName', $temp)
            ->pluck('id');

        $emps = Employee::query()
            ->whereIn('PositionName', ['อาจารย์', 'ผู้ช่วยศาสตราจารย์', 'รองศาสตราจารย์'])
            ->get();





//        $history = EmployeeHistoryWork::query()
//            ->where('year', '>=', $startYear)
//            ->where('year', '<=', $endYear)
//            ->orderBy('year')
//            ->get()
//            ->groupBy('year');

        $history = EmployeePositionHistory::query()
//            ->whereIn('employee_id','')
            ->where('year', '>=', $startYear)
            ->where('year', '<=', $endYear)
            ->whereNotIn('employee_id', $emp_ids)
            ->whereIn('PositionName', ['อาจารย์', 'ผู้ช่วยศาสตราจารย์', 'รองศาสตราจารย์'])
            ->with(['employee'])
            ->orderBy('year')
            ->get()
            ->groupBy('year');

        $history = EmployeePositionHistory::query()
//            ->whereIn('employee_id','')
            ->where('year', '>=', $startYear)
            ->where('year', '<=', $endYear)
            ->whereNotIn('employee_id', $emp_ids)
            ->whereIn('PositionName', ['อาจารย์', 'ผู้ช่วยศาสตราจารย์', 'รองศาสตราจารย์'])
            ->with(['employee'])
            ->orderBy('year')
            ->get()
            ->groupBy(['year', 'employee_id']);


        $empEducations = EmployeeEducation::query()
            ->with(['education'])
//            ->whereIn('employee_id','')
            ->where('graduateYear', '>=', $startYear)
            ->where('graduateYear', '<=', $endYear)
            ->whereNotIn('employee_id', $emp_ids)
            ->with(['employee'])
            ->orderBy('graduateYear')
            ->get()
            ->groupBy('graduateYear');

        $grouped = [];

        foreach ($empEducations as $y => $his) {
            $grouped[$y] = [];
            foreach ($his as $j => $h) {
                $grouped[$y][$h->employee_id] = $h->education->educationLevelNameTha;
            }
        }
        $yy = [];
        $t = [];
        $x = [];


        foreach ($history as $y => $h) {
            $years[] = $y;

            $data[$y]['doctor'] = 0;
            $data[$y]['master'] = 0;
            $data[$y]['ps_doctor'] = 0;
            $data[$y]['ps_master'] = 0;
            $data[$y]['s_doctor'] = 0;
            $data[$y]['rs_doctor'] = 0;


            foreach ($emps as $i => $emp) {
                $employee = isset($h[$emp->id]) && count($h[$emp->id]) > 0 ? $h[$emp->id][0] : null;
                $gradueted = isset($grouped[$y][$emp->id]) ? $grouped[$y][$emp->id] : null;


//                if ($y == 2563 && $emp->id == 127);
//                {
//                    dd($employee,$gradueted);
//                }

                // data complete
                if ($employee) {
                    if ($gradueted == null) {

                        $edu = EmployeeEducation::query()
                            ->where('graduateYear', $y)
                            ->where('employee_id', $employee->id)
                            ->first();

                        if ($edu) {
                            $gradueted = $edu->educationLevelNameTha;
                        } else {
                            $gradueted = 'other';
                        }
                    }
//
                    if ($employee->PositionName == 'ศาสตราจารย์') {
                        $data[$y]['s_doctor'] += 1;
//                    if ($y == 2563){
//                        $x[] = $his->employee->FullName;
//                    }
                    } else if ($employee->PositionName == 'รองศาสตราจารย์') {
                        $data[$y]['rs_doctor'] += 1;
//                    if ($y == 2563){
//                        $x[] = $emp->FullName;
//                    }
                    } else if ($employee->PositionName == 'ผู้ช่วยศาสตราจารย์' && $gradueted == "ปริญญาเอก") {
                        $data[$y]['ps_doctor'] += 1;
//                     if ($y == 2563){
//                        $x[] = $emp->FullName;
//                    }
                    } else if ($employee->PositionName == 'ผู้ช่วยศาสตราจารย์' && $gradueted == 'ปริญญาโท') {
                        $data[$y]['ps_master'] += 1;
//                        if ($y == 2563){
//                            $x[] = $emp->FullName;
//                        }
                    } else if ($gradueted == 'ปริญญาเอก') {
                        $data[$y]['doctor'] += 1;
                        if ($y == 2560){
                            $x[] = $emp->FullName;
                        }
//                        if ($employee->employee_id == 25 && $y == 2562) {
//                            dd($gradueted, $grouped);
//                        }
//                    if ($y == 2563){
//                        $x[] = $his->employee->FullName;
//                    }
                    } elseif ($gradueted == 'ปริญญาโท') {
                        $data[$y]['master'] += 1;
//                        if ($y == 2563){
//                            $x[] = $emp->FullName;
//                        }
//                        if ($y == 2563){
//                            $x[] = $emp->FullName;
//                        }
//                    $x[] = $his->employee->PersonalID;
                    } else {
//                    $t[] = [
//                        'id' => $his->employee_id,
//                        'position' => $his->PositionName ,
//                        'graduated' => $gradueted
//                    ];
//                        if ($his->PositionName == 'อาจารย์'){
//                            dd($his,$gradueted,$y,$grouped[$y]);
//                        }
                    }
                }else{
//                    dd($emp,$y);
                    //data not completed
                    if ($gradueted == 'ปริญญาเอก') {
                        $data[$y]['doctor'] += 1;
                        if ($y == 2560){
                            $x[] = $emp->FullName;
                        }
                    } elseif ($gradueted == 'ปริญญาโท') {
                        $data[$y]['master'] += 1;
//                        if ($y == 2563){
//                            $x[] = $emp->FullName;
//                        }
                    }
                }
//                if ($emp){
//
//                    dd(22);
//                }else{
//
//                    dd(111);
//
//                }

            }


//            foreach ($h as $j => $his) {
//
//
//                // Not year
////                $employee = isset($employees[$his->employee_id]) ? $employees[$his->employee_id][0] : null;
//                $gradueted = isset($grouped[$y][$his->employee_id]) ? $grouped[$y][$his->employee_id] : null;
//
////                if ($his->employee_id == 25){
////                    dd($gradueted,$grouped);
////                }
//
//                if ($gradueted == null) {
//                    $edu = EmployeeEducation::query()
//                        ->where('graduateYear', $y)
//                        ->where('employee_id', $his->employee_id)
//                        ->first();
//
//                    if ($edu) {
//                        $gradueted = $edu->educationLevelNameTha;
//                    } else {
//                        $gradueted = 'other';
//                    }
//                }
//
////                dd($his->employee_id);
//
////                dd($gradueted,$his->employee_id,$y);
//
////                if ($his['employee_id'] == 101){
////                    $yy[] = [
////                        'y' =>$y,
////                        'gratuatd' => $gradueted
////                    ];
////                }
//
//                if ($his->PositionName == 'ศาสตราจารย์') {
//                    $data[$y]['s_doctor'] += 1;
////                    if ($y == 2563){
////                        $x[] = $his->employee->FullName;
////                    }
//                } else if ($his->PositionName == 'รองศาสตราจารย์') {
//                    $data[$y]['rs_doctor'] += 1;
////                    if ($y == 2563){
////                        $x[] = $his->employee->FullName;
////                    }
//                } else if ($his->PositionName == 'ผู้ช่วยศาสตราจารย์' && $gradueted == "ปริญญาเอก") {
//                    $data[$y]['ps_doctor'] += 1;
////                    if ($y == 2563){
////                        $x[] = $his->employee->FullName;
////                    }
//                } else if ($his->PositionName == 'ผู้ช่วยศาสตราจารย์' && $gradueted == 'ปริญญาโท') {
//                    $data[$y]['ps_master'] += 1;
//                } else if ($gradueted == 'ปริญญาเอก') {
//                    $data[$y]['doctor'] += 1;
//
//                    if ($his->employee_id == 25 && $y == 2562) {
//                        dd($gradueted, $grouped);
//                    }
////                    if ($y == 2563){
////                        $x[] = $his->employee->FullName;
////                    }
//                } elseif ($gradueted == 'ปริญญาโท') {
//                    $data[$y]['master'] += 1;
////                    $x[] = $his->employee->PersonalID;
//                } else {
////                    $t[] = [
////                        'id' => $his->employee_id,
////                        'position' => $his->PositionName ,
////                        'graduated' => $gradueted
////                    ];
////                        if ($his->PositionName == 'อาจารย์'){
////                            dd($his,$gradueted,$y,$grouped[$y]);
////                        }
//                }
//            }
        }


//        dd($x);

        return view('index4', [
            'users' => [],
            'years' => $years,
            'data' => $data
        ]);
    }

    public function index5(Request $request)
    {
//        $agencies = Agency::query()->get();
//
//        $agency_id = $request->get('agency_id',null);
//        if ($agency_id){
//            $position_groups = Employee::query()
//                ->with(['agency','position'])
//                ->where('agency_id',$agency_id)
//                ->get()
//                ->groupBy('position');
//        }else{
//
//            $position_groups = Employee::query()
//                ->with(['agency','position'])
//                ->get()
//                ->groupBy('position');
//        }
//
//        $users = [];
//        $index = 1;
//
//        foreach ($position_groups as $key => $group) {
//            $tmp = [
//                'position' => $key
//            ];
//            $users[] = $tmp;
//            foreach ($group as $i => $user) {
//
//                $tmp = [
//                    'id' => $user->id,
//                    'no' => $index,
//                    'fullName' => $user->FullName,
//                    'position' => $user->position->name,
//                    'agency' => $user->agency->name,
//                ];
//
//
//                $users[] = $tmp;
//                $index++;
//            }
//        }


        $users = [];
        $agencies = [];
        return view('index5', [
            'users' => $users,
            'agencies' => $agencies
        ]);
    }

    public function view($id, Request $request)
    {
//        $user = Employee::query()
//            ->with(['agency','position','education'])
//            ->where('id',$id)
//            ->first();

        $user = [];

        return view('view', [
            'user' => $user
        ]);
    }


    public function setting()
    {
        return view('setting', [

        ]);
    }
}



//$years = [];
//$type = $request->get('type', null);
//
//$now = Carbon::now()->addYears(543);
//
//$employees = Employee::query()
//    ->where('TypeEmployee', 'อาจารย์')
//    ->where('employeeTypeNameTha', 'พนักงานมหาวิทยาลัยประจำ')
////            ->whereNotNull('EposDate')
////            ->where('EposDate','<=',$now)
//    ->orderBy('EposDate', 'ASC')
//    ->with(['employee_executives', 'employee_executives.executive', 'work_histories', 'employee_leave_educations'])
//    ->get();
//
//$users = [];
//
//$year_start = ((int)Carbon::now()->format('Y')) + 543;
//$year_end = $year_start + 7;
//
//
//
//foreach ($employees as $i => $user) {
//    $diffDays = 0;
//    $diffyears = 0;;
//    $plus_green_days = 0;
//    $plus_yellow_days = 0;
//    $plus_red_days = 0;
//    if ($user->PositionName == 'อาจารย์') {
//        $plus_green = 4;
//        $plus_red = 2;
//    } else {
//        $plus_green = 6;
//        $plus_red = 0;
//    }
//
//    $plus_yellow = 1;
//
//    $name = $user['PrenameTha'] . ' ' . $user['FirstNameTha'] . ' ' . $user['LastNameTha'];
////            $position = $user['PrenamePositionTha'];
//    $start_at = $user['FirstWorkDate'];
//
//
//    /////////////////  Set Epos Date  ////////////////////
//    if (!$user['EposDate'] && $user->PositionName == 'อาจารย์' || $user->PositionName == 'รองศาสตราจารย์' || $user->PositionName == 'ผู้ช่วยศาสตราจารย์' || $user->PositionName == 'ศาสตราจารย์') {
//        $check = null;
//        $pt = null;
//        $ps = null;
//        foreach ($user->work_histories as $index => $history) {
////                    $positionName = $history->PositionName;
//            if ($user->PositionName == 'ศาสตราจารย์') {
//                $pt = 'ศาสตราจารย์';
//            } else if ($user->PositionName == 'รองศาสตราจารย์') {
//                $pt = 'รองศาสตราจารย์';
//            } else if ($user->PositionName == 'ผู้ช่วยศาสตราจารย์') {
//                $pt = 'ผู้ช่วยศาสตราจารย์';
//            } else if ($user->PositionName == 'อาจารย์') {
//                $pt = 'อาจารย์';
//            }
//            if ($check && $check == $pt) {
//                $ps = $history;
//            }
//
//            if (!$check) {
//                $check = $pt;
//                $ps = $history;
//            }
//        }
//
////                dd($user,$ps->EmployeeAssignDate,$pt);
//        try {
//            $contain_at = $ps->EmployeeAssignDate;
//            $contain = $ps->EmployeeAssignDate;
//        }catch (\Exception $exception){
//            dd($i,$user,$user->work_histories);
//        }
//    } else {
//        $contain_at = $user['EposDate'];
//        $contain = $user['EposDate'];
//        //set from work history
//    }
//    /////////////////////////////////////////////////////////////////
//    //plus year = start green
////            $contain_at = Carbon::createFromFormat('d/m/Y', $contain_at)->addYear()->format('d/m/Y');
//    ;
//
//    ///////// end date red  //////////
//    $exit_at = $user['EndDate'];
//    //////////////////////////////////
//    try {
////                if ($user['FirstWorkDate'] && $user['FirstWorkDate'] != '') {
////                    $start_at = (int)Carbon::createFromFormat('d/m/Y', $user['FirstWorkDate'])->format('Y');
////                    $start = (int)Carbon::createFromFormat('d/m/Y', $user['FirstWorkDate'])->format('Y');
////                }
//
//
//        if ($contain_at && $contain_at != '') {
////                    $contain = Carbon::createFromFormat('d/m/Y', $contain_at)->format('Y');
//            //////////////// add leave education //////////
//            if (count($user->employee_leave_educations) > 0) {
////                        dd($exit_at);
////                        $exit = (Carbon::createFromFormat('d/m/Y', $exit_at)->addDays($user->changeDate))->format('Y');
//                foreach ($user->employee_leave_educations as $leave_education) {
//
//                    // find diff year difference
//                    $assign_date = Carbon::createFromFormat('d/m/Y', $leave_education['LeaveBeginDate']);
//                    $end_date = Carbon::createFromFormat('d/m/Y', $leave_education['LeaveFinishDate']);
//                    $diffday = ($assign_date->diffInDays($end_date));
//                    $diffyear = ($assign_date->floatDiffInYears($end_date));
//
//                    $diffDays += $diffday;
//                    $diffyears += $diffyears;
//                    //////////////////////////////
//
//
//
////                            /////////////  Change  /////////
//                    $inDateGreen = (Carbon::createFromFormat('d/m/Y', $contain))->addYears($plus_green);
//                    $inDateYellow = (Carbon::createFromFormat('d/m/Y', $contain))->addYears($plus_yellow);
////                            $inDateRed = (Carbon::createFromFormat('d/m/Y', $contain))->addYears($plus_red);
////                            ///////////////////////
//
//                    if ($user->PositionName == 'อาจารย์'){
//                        $inDateGreen = (Carbon::createFromFormat('d/m/Y', $contain))->addYears($plus_green);
//                        $inDateYellow = (Carbon::createFromFormat('d/m/Y', $contain))->addYears($plus_yellow);
//                        $inDateRed = (Carbon::createFromFormat('d/m/Y', $contain))->addYears($plus_red);
//
//                        if ($assign_date <= $inDateGreen) {
//                            $plus_green += $diffyears;
//                            $plus_green_days += $diffday;
//                            //////////////////////////
//                            $plus_yellow += $diffyears;
//                            $plus_yellow_days += $diffday;
//
//                            $plus_red += $diffyears;
//                            $plus_red_days += $diffday;
//                        } elseif ($assign_date < $inDateYellow) {
//                            $plus_yellow += $diffyears;
//                            $plus_yellow_days += $diffday;
//
//                            $plus_red += $diffyears;
//                            $plus_red_days += $diffday;
//
//                        } else {
//                            $plus_red += $diffyears;
//                            $plus_red_days += $diffday;
//                        }
//                    }else{
//                        $inDateGreen = (Carbon::createFromFormat('d/m/Y', $contain))->addYears($plus_green);
//                        $inDateYellow = (Carbon::createFromFormat('d/m/Y', $contain))->addYears($plus_green+$plus_yellow);
//
//                        if ($assign_date <= $inDateGreen) {
//                            $plus_green += $diffyears;
//                            $plus_green_days += $diffday;
//                            //////////////////////////
//                            $plus_yellow += $diffyears;
//                            $plus_yellow_days += $diffday;
//
//
//                        } elseif ($assign_date < $inDateYellow) {
//                            $plus_yellow += $diffyears;
//                            $plus_yellow_days += $diffday;
//
//                            $plus_red += $diffyears;
//                            $plus_red_days += $diffday;
//                        }
//                    }
//                }
////                        dd($plus_green_days,$plus_yellow_days,$plus_red_days);
//            }
//            /////////////////////////////////////////////////
//
////                    if (count($user->employee_executives)) {
////                        $exit = (Carbon::createFromFormat('d/m/Y', $exit_at)->addDays($user->changeDate))->format('Y');
////                        foreach ($user->employee_executives as $exec) {
////                            $assign_date = Carbon::createFromFormat('d/m/Y', $exec['employeeAssignDate']);
////                            $end_date = Carbon::createFromFormat('d/m/Y', $exec['employeeEndDate']);
////                            $diffyear = ($assign_date->floatDiffInYears($end_date));
////
////                            $inDateGreen = (Carbon::createFromFormat('d/m/Y', $user['EposDate']))->addYears(4);
////                            $inDateYellow = (Carbon::createFromFormat('d/m/Y', $user['EposDate']))->addYears(5);
////                            $inDateRed = (Carbon::createFromFormat('d/m/Y', $user['EposDate']))->addYears(7);
////
////                            if ($assign_date <= $inDateGreen) {
////                                $plus_green += $diffyear;
////                                $plus_yellow += $diffyear;
////                                $plus_red += $diffyear;
////                            } elseif ($assign_date < $inDateYellow) {
////                                $plus_yellow += $diffyear;
////                                $plus_red += $diffyear;
////                            } else {
////                                $plus_red += $diffyear;
////                            }
////                        }
////                    }
//
//            $exit = (Carbon::createFromFormat('d/m/Y', $exit_at))->format('Y');
//
//
//
//            $c = (int)Carbon::createFromFormat('d/m/Y',$contain)->format('Y');
//            if ($year_start > $c) {
//                $year_start = $c;
//            }
//            if ($year_end < (int)$exit) {
//                $year_end = (int)$exit;
//            }
//        }else{
//            dd("Have Epos Null");
//        }
//
////                $exit = Carbon::createFromFormat('d/m/Y', $user['InDate'])->format('Y');
//    } catch (\Exception $exception) {
//        dd($i, $exception->getMessage());
//        continue;
//
//    }
//
//
//    ///////////////// last year ///////////////
//    if ($user->PositionName == 'อาจารย์') {
//        $end_at = (Carbon::createFromFormat('d/m/Y', $contain)->addYears(7))->subDays(1);
//    }else{
//        $end_at = (Carbon::createFromFormat('d/m/Y', $contain)->addYears(7))->subDays(1);
//
//    }
//
//    $among = $now->diffInDays($end_at);
//
//    //////////// find colspan ///////////////////////
//    $colspan_green = ((int)$contain + $plus_green) - (int)$contain;
//    $colspan_yellow = ((int)$contain + $plus_yellow) - (int)$contain;
//    if ($user->PositionName == 'อาจารย์') {
//        $colspan_red = ((int)$contain + $plus_red) - (int)$contain;
//    }else{
//        $colspan_red = 0;
//    }
//    ////////////////////////////////////////////////////
//
//
//
//    /////////////////// Set Text ////////////////////////
//    $text_green = $contain_at . ' - ' . (Carbon::createFromFormat('d/m/Y', $contain_at))->addYears(4)->addDays($plus_green_days)->subDays(1)->format('d/m/Y');
//    $text_yellow = (Carbon::createFromFormat('d/m/Y', $contain_at))->addYears(4)->addDays($plus_green_days)->format('d/m/Y') . ' - ' . (Carbon::createFromFormat('d/m/Y', $contain_at))->addYears(5)->addDays($plus_yellow_days)->subDays(1)->format('d/m/Y');
//
//
//    if ($user->PositionName == 'อาจารย์') {
//        $text_red = (Carbon::createFromFormat('d/m/Y', $contain_at))->addYears(5)->format('d/m/Y') . ' - ' . (Carbon::createFromFormat('d/m/Y', $contain_at))->addYears(7)->subDays(1)->format('d/m/Y');
//    }else{
//        $text_red = '';
//    }
//    ////////////////////////////////////////////////////
//    ///
//    $tmp = [
//        'name' => $name,
//        'among' => $among,
//        'start_at' => $start_at,
//        'end_at' => $end_at->format('d/m/Y'),
//        'contain_at' => $contain_at,
//        'exit_at' => $exit_at,
////                'position' => $position,
//        'range' => 0,
//        'start' => (int)$contain,
//        'end' => (int)$exit,
//        'plus_green' => $plus_green,
//        'plus_yellow' => $plus_yellow,
//        'colspan_green' => $colspan_green,
//        'colspan_yellow' => $colspan_yellow,
//        'colspan_red' => $colspan_red,
//        'text_green' => $text_green,
//        'text_yellow' => $text_yellow,
//        'text_red' => $text_red,
//        'positionName' => $user->PositionName
//    ];
////            dd($user,$tmp,$diffDays,$diffyears);
//    $users[] = $tmp;
//}
//
//for ($i = $year_start; $i < $year_end; $i++) {
//    $years[] = (int)$i;
//}
//
////        if ($type == null || $type == 'year') {
////            if (count($users) > 0) {
////
////                $year_start = Carbon::createFromFormat('d/m/Y', $users[0]['contain_at'])->format('Y');
////                $year_end = $year_start + 7;
////
////        } else {
////
////        }
//
//
//$years = $this->bubbleSort($years, 'ASC');
//
//return view('index', [
//    'users' => $users,
//    'years' => $years
//]);
