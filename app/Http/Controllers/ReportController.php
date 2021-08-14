<?php

namespace App\Http\Controllers;

use App\Agency;
use App\ApiController;
use App\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
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

    public function index(Request $request)
    {


//        $employees = Employee::query()
//            ->where('DEposDate','>=',Carbon::now())
//            ->orderBy('DEposDate','ASC')
//            ->get();
//
//        $users = [];
//        foreach ($employees as $user) {
//
//                $year_start = (int)Carbon::now()->format('Y');
//                $year_end = $year_start + 7;
//            $date = Carbon::parse($user['Indate']);
//            $date2 = Carbon::parse($user['EposDate']);
//
//
//            $name = $user['PrenameTha'] . ' ' . $user['FirstNameTha'] . ' ' . $user['LastNameTha'];
//            $position = $user['PrenamePositionTha'];
//            $start_at = $user['FirstWorkDate'];
//            $contain_at = $user['Indate'];
//            $exit_at = $user['EposDate'];
//
////            $start = Carbon::make($user['start_at'])->format('Y');
//            $contain = Carbon::make($user['Indate'])->format('Y');
//            $exit = Carbon::make($user['EposDate'])->format('Y');
//
//            if ($year_end < (int)$exit) {
//                $year_end = (int)$exit;
//            }
//            $among = $date->diffInDays($date2);
//            $tmp = [
//                'name' => $name,
//                'among' => $among,
//                'start_at' => $start_at,
//                'contain_at' => $contain_at,
//                'exit_at' => $exit_at,
//                'position' => $position,
//                'range' => 0,
//                'start' => (int)$contain,
//                'end' => (int)$exit
//            ];
//            $users[] = $tmp;
//        }

//        for ($i = $year_start; $i < $year_end; $i++) {
//            $years[] = $i;
//        }


        $years = [];
        $type = $request->get('type', null);

        $users = [
            [
                'name' => 'นาย ธนรัตน์ ประภัสส',
                'among' => '133',
                'start_at' => '10/5/2018',
                'contain_at' => '10/1/2015',
                'exit_at' => '10/1/2022',
                'range' => 0
            ],
            [
                'name' => 'นาย ธนรัตน์ ประภัสส',
                'among' => '133',
                'start_at' => '10/5/2016',
                'contain_at' => '10/1/2018',
                'exit_at' => '10/1/2025',
                'range' => 0
            ],
            [
                'name' => 'นาย ธนรัตน์ ประภัสส',
                'among' => '133',
                'start_at' => '10/5/2018',
                'contain_at' => '10/1/2020',
                'exit_at' => '10/1/2027',
                'range' => 0
            ],
            [
                'name' => 'นาย ธนรัตน์ ประภัสส',
                'among' => '133',
                'start_at' => '10/5/2015',
                'contain_at' => '10/1/2014',
                'exit_at' => '10/1/2021',
                'range' => 0
            ],
            [
                'name' => 'นาย ธนรัตน์ ประภัสส',
                'among' => '133',
                'start_at' => '10/5/2000',
                'contain_at' => '10/1/2008',
                'exit_at' => '10/1/2041',
                'range' => 0
            ],
            [
                'name' => 'นาย ธนรัตน์ ประภัสส',
                'among' => '133',
                'start_at' => '10/5/1995',
                'contain_at' => '10/1/2008',
                'exit_at' => '10/1/2025',
                'range' => 0
            ],
        ];


        if ($type == null || $type == 'year') {
            if (count($users) > 0) {

                $year_start = Carbon::make($users[0]['contain_at'])->format('Y');
                $year_end = $year_start + 7;

                foreach ($users as $i => $user) {
                    $start = Carbon::make($user['start_at'])->format('Y');
                    $contain = Carbon::make($user['contain_at'])->format('Y');
                    $exit = Carbon::make($user['exit_at'])->format('Y');

                    if ($year_end < (int)$exit) {
                        $year_end = (int)$exit;
                    }

                    if ($year_start > (int)$contain) {
                        $year_start = (int)$contain;
                    }
                    $users[$i]['start'] = (int)$contain;
                    $users[$i]['end'] = (int)$exit;
//            $users[$i]['range'] = ((int)$exit - (int)($contain));

                }


                for ($i = $year_start; $i < $year_end + 5; $i++) {
                    $years[] = $i;
                }
            }
        } else {

        }


        $years = $this->bubbleSort($years, 'ASC');

        return view('index', [
            'users' => $users,
            'years' => $years
        ]);
    }

    public function index2(Request $request)
    {

        $users = [
            [
                'name' => 'นาย ธนรัตน์ ประภัสส',
                'among' => '133',
                'start_at' => '31 มีนาคม 2564',
                'contain_at' => '31 มีนาคม 2564',
                'exit_at' => '31 มีนาคม 2564',
                'degree' => 'doctor',
                'status' => 'employee',
                'position' => 'ชำนาญการ',
                'type' => 'สายสนับสนุน'


            ],
            [
                'name' => 'นาย ธนรัตน์ ประภัสส',
                'among' => '133',
                'start_at' => '31 มีนาคม 2564',
                'contain_at' => '31 มีนาคม 2564',
                'exit_at' => '31 มีนาคม 2564',
                'degree' => 'master',
                'status' => 'employee',
                'position' => 'เชี่ยวชาญ',
                'type' => 'สายสนับสนุน'

            ],
            [
                'name' => 'นาย ธนรัตน์ ประภัสส',
                'among' => '133',
                'start_at' => '31 มีนาคม 2564',
                'contain_at' => '31 มีนาคม 2564',
                'exit_at' => '31 มีนาคม 2564',
                'degree' => 'bachelor',
                'status' => 'employee',
                'position' => 'ชำนาญพิเศษ',
                'type' => 'สายวิชาการ'

            ],
            [
                'name' => 'นาย ธนรัตน์ ประภัสส',
                'among' => '133',
                'start_at' => '31 มีนาคม 2564',
                'contain_at' => '31 มีนาคม 2564',
                'exit_at' => '31 มีนาคม 2564',
                'degree' => 'doctor',
                'status' => 'พนักงานส่วนงาน',
                'position' => 'ชำนาญการ',
                'type' => 'สายสนับสนุน'


            ],
            [
                'name' => 'นาย ธนรัตน์ ประภัสส',
                'among' => '133',
                'start_at' => '31 มีนาคม 2564',
                'contain_at' => '31 มีนาคม 2564',
                'exit_at' => '31 มีนาคม 2564',
                'degree' => 'master',
                'status' => 'พนักงานส่วนงาน',
                'position' => 'เชี่ยวชาญ',
                'type' => 'สายวิชาการ'

            ],
            [
                'name' => 'นาย ธนรัตน์ ประภัสส',
                'among' => '133',
                'start_at' => '31 มีนาคม 2564',
                'contain_at' => '31 มีนาคม 2564',
                'exit_at' => '31 มีนาคม 2564',
                'degree' => 'bachelor',
                'status' => 'พนักงานส่วนงาน',
                'position' => 'ชำนาญพิเศษ',
                'type' => 'สายวิชาการ'

            ],
        ];

        $sum = [
            'count' => 0,
            'doctor' => 0,
            'master' => 0,
            'bachelor' => 0,
            'other' => 0,
            'exp' => 0,
            'expert' => 0,
            'special_expert' => 0
        ];
        $data = [];
        $data['full_academic'] = [
            'count' => 0,
            'doctor' => 0,
            'master' => 0,
            'bachelor' => 0,
            'other' => 0,
            'exp' => 0,
            'expert' => 0,
            'special_expert' => 0,
        ];

        $data['part_academic'] = [
            'count' => 0,
            'doctor' => 0,
            'master' => 0,
            'bachelor' => 0,
            'other' => 0,
            'exp' => 0,
            'expert' => 0,
            'special_expert' => 0,
        ];
        $data['full_support'] = [
            'count' => 0,
            'doctor' => 0,
            'master' => 0,
            'bachelor' => 0,
            'other' => 0,
            'exp' => 0,
            'expert' => 0,
            'special_expert' => 0,
        ];
        $data['part_support'] = [
            'count' => 0,
            'doctor' => 0,
            'master' => 0,
            'bachelor' => 0,
            'other' => 0,
            'exp' => 0,
            'expert' => 0,
            'special_expert' => 0,
        ];


        foreach ($users as $i => $user) {
            if ($user['type'] == 'สายวิชาการ' && $user['status'] == 'employee') {
                $col = 'full_academic';
            } else if ($user['type'] == 'สายวิชาการ' && $user['status'] == 'พนักงานส่วนงาน') {
                $col = 'part_academic';
            } else if ($user['type'] == 'สายสนับสนุน' && $user['status'] == 'employee') {
                $col = 'full_support';
            } else {
                $col = 'part_support';
            }

            $sub = '';
            if ($user['degree'] == 'doctor') {
//                $data[$col]['doctor'] += 1;
                $sub = 'doctor';
            } else if ($user['degree'] == 'master') {
//                $data[$col]['master'] += 1;
                $sub = 'master';
            } else if ($user['degree'] == 'bachelor') {
//                $data[$col]['bachelor'] += 1;
                $sub = 'bachelor';
            } else {
//                $data[$col]['other'] += 1;
                $sub = 'other';
            }


            $sub2 = '';
            if ($user['position'] == 'ชำนาญการ') {
                $sub2 = 'exp';
                $data[$col]['exp'] += 1;
            } else if ($user['position'] == 'เชี่ยวชาญ') {
                $sub2 = 'expert';
//                $data[$col]['expert'] += 1;
            } else {
                $sub2 = 'special_expert';
//                $data[$col]['special_expert'] += 1;
            }

            $data[$col]['count'] += 1;
            $data[$col][$sub] += 1;
            $data[$col][$sub2] += 1;

            $sum['count'] += 1;
            $sum[$sub] += 1;
            $sum[$sub2] += 1;


        }


        $data['sum'] = $sum;


        return view('index2', [
            'users' => $users,
            'data' => $data
        ]);
    }

    public function index3(Request $request)
    {

        $year = $request->get('year');
        $startDate = Carbon::createFromDate(2015, 1, 1);
        $endDate = Carbon::createFromDate(2015, 1, 1);

        $startOfYear = $startDate->copy()->startOfYear();
        $endOfYear = $endDate->copy()->endOfYear();

//        dd($startOfYear->format('Y-m-d'),$endOfYear->format('Y-m-d'));

//        $employees = Employee::query()
//            ->where('DEposDate','>=',$startOfYear)
//            ->where('DEposDate','<=',$endOfYear)
//            ->get();

        $data = [];
//        foreach ($employees as $i=> $user)
//        {
//            if ($user->a ==''){
//
//            }
//        }

        $users = [
            [
                'name' => 'นาย ธนรัตน์ ประภัสส',
                'among' => '133',
                'start_at' => '31 มีนาคม 2564',
                'contain_at' => '31 มีนาคม 2564',
                'exit_at' => '31 มีนาคม 2564',

            ]
        ];

        $type = $request->get('type', null);


        return view('index3', [
            'users' => $users
        ]);
    }

    public function index4(Request $request)
    {
        $users = [
            [
                'name' => 'นาย ธนรัตน์ ประภัสส',
                'among' => '133',
                'start_at' => '31 มีนาคม 2564',
                'contain_at' => '31 มีนาคม 2564',
                'exit_at' => '31 มีนาคม 2564',

            ]
        ];

        $type = $request->get('type', null);


        return view('index4', [
            'users' => $users
        ]);
    }


    public function setting()
    {
        return view('setting',[

        ]);
    }
    public function update(Request $request)
    {
        DB::beginTransaction();
        try{
            $api = new ApiController();
            $token = $api->getAccessToken();

            $users = $api->getPersonalInfo($token);

            DB::commit();
            return redirect()->back()->with([
                'success' => false,
                'message' => 'อัพเดทข้อมูลสำเร็จ'
            ]);
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->withErrors([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }


//        $data = [];
//        foreach ($users as $user) {
//
//            $date = Carbon::parse($user['Indate']);
//            $date2 = Carbon::parse($user['EposDate']);
//
//
//            $name = $user['PrenameTha'] . ' ' . $users['FirstNameTha'] . ' ' . $users['LastNameTha'];
//            $position = $user['PrenamePositionTha'];
//            $start_at = $user['FirstWorkDate'];
//            $contain_at = $user['Indate'];
//            $exit_at = $user['EposDate'];
//
////            $start = Carbon::make($user['start_at'])->format('Y');
//            $contain = Carbon::make($user['Indate'])->format('Y');
//            $exit = Carbon::make($user['EposDate'])->format('Y');
//
//            if ($year_end < (int)$exit) {
//                $year_end = (int)$exit;
//            }
//            $among = $date->diffInDays($date2);
//            $tmp = [
//                'name' => $name,
//                'among' => $among,
//                'start_at' => $start_at,
//                'contain_at' => $contain_at,
//                'exit_at' => $exit_at,
//                'position' => $position,
//                'range' => 0,
//                'start' => (int)$contain,
//                'end' => (int)$exit
//            ];
//            $data[] = $tmp;
//        }

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
}
