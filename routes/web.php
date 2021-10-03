<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('', [\App\Http\Controllers\ReportController::class, 'index2'])->name('index5');


Route::group(['prefix' => 'admin'], function () {
//    Route::get('', [\App\Http\Controllers\ReportController::class, 'index5'])->name('index5');

    Route::get('employee', [\App\Http\Controllers\ReportController::class, 'index5'])->name('index5');
    Route::get('view/{id}', [\App\Http\Controllers\ReportController::class, 'view'])->name('view');

    Route::get('', [\App\Http\Controllers\ReportController::class, 'index2'])->name('index');
    Route::get('layoff', [\App\Http\Controllers\ReportController::class, 'index2'])->name('index2');
//    Route::get('index2', [\App\Http\Controllers\ReportController::class, 'index2'])->name('index2');
    Route::get('employee_dashboard', [\App\Http\Controllers\ReportController::class, 'index3'])->name('index3');
    Route::get('graph_hr_position', [\App\Http\Controllers\ReportController::class, 'graph_hr_position'])->name('graph_hr_position');
    Route::get('education_dashboard', [\App\Http\Controllers\ReportController::class, 'index4'])->name('index4');


    Route::get('setting', [\App\Http\Controllers\ReportController::class, 'setting'])->name('setting');
});


Route::group(['prefix'=> 'update'],function(){
    // Get All Employee
    Route::post('upload_layoff', [\App\Http\Controllers\UpdateController::class, 'upload_layoff'])->name('upload_layoff');
    Route::get('update_employee', [\App\Http\Controllers\UpdateController::class, 'update_employee'])->name('update_employee');

    //update Personal Info
    Route::get('update_personal_info', [\App\Http\Controllers\UpdateController::class, 'update_personal_info'])->name('update_personal_info');

    //update history worker
    Route::get('update_history_worker', [\App\Http\Controllers\UpdateController::class, 'update_history_worker'])->name('update_history_worker');

    //update workcurrentinfo //check
    Route::get('update_work_current_info', [\App\Http\Controllers\UpdateController::class, 'update_work_current_info'])->name('update_work_current_info');


    //update education
    Route::get('update_employee_education', [\App\Http\Controllers\UpdateController::class, 'update_employee_education'])->name('update_employee_education');


    //update executive
    Route::get('update_employee_executive', [\App\Http\Controllers\UpdateController::class, 'update_employee_executive'])->name('update_employee_executive');


    //update leavehistory
    Route::get('update_employee_leavehistory', [\App\Http\Controllers\UpdateController::class, 'update_employee_leavehistory'])->name('update_employee_leavehistory');

    //update leaveeducation
    Route::get('update_employee_leaveeducation', [\App\Http\Controllers\UpdateController::class, 'update_employee_leaveeducation'])->name('update_employee_leaveeducation');


    //update fame
    Route::get('update_employee_fame', [\App\Http\Controllers\UpdateController::class, 'update_employee_fame'])->name('update_employee_fame');

    //update address
    Route::get('update_employee_address', [\App\Http\Controllers\UpdateController::class, 'update_employee_address'])->name('update_employee_address');

});


Route::get('seed',function (){
//    $token = 'c6hhTuNzDR4vSCVwqC1Z1mqvKaCrMBUr';

//    $curl = curl_init();
//
//    curl_setopt_array($curl, array(
//        CURLOPT_URL => "https://mis-api.cmu.ac.th/hr/v2.2/employees/personalinfo",
//        CURLOPT_RETURNTRANSFER => true,
//        CURLOPT_ENCODING => "",
//        CURLOPT_MAXREDIRS => 10,
//        CURLOPT_TIMEOUT => 0,
//        CURLOPT_FOLLOWLOCATION => true,
//        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//        CURLOPT_CUSTOMREQUEST => "GET",
//        CURLOPT_HTTPHEADER => array(
//            "orgid: 0000000021",
//            "personalid: "."3509901220807",
//            "Authorization: Bearer $token"
//        ),
//    ));
//
//    $response = curl_exec($curl);
//
//    curl_close($curl);
//
//    $json = json_decode($response,true);
//    dd($json);
//    die();
    $open = fopen("emp.csv", "r");
    $row = fgetcsv($open, 1000, ",");
    $data =[];
    while (($row = fgetcsv($open, 1000, ",")) !== FALSE)
    {

        $tmp = [
            "PersonalID" => $row[0],
            'emailCMU' => $row[1],
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ];
        $data[] = $tmp;
        // Read the data
    }

    fclose($open);


    dd($data);
    \Illuminate\Support\Facades\DB::table('employees')->insert($data);



});

Route::get('seed2',function (){

    $open = fopen("example.csv", "r");
    $row = fgetcsv($open, 1000, ",");
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
//            $start_red_at = \Carbon\Carbon::createFromFormat('d/m/y',$row[12])->addYears(543)->addDay()->format('d/m/Y');
            $end_red_at =  \Carbon\Carbon::createFromFormat('d/m/y',$row[12])->addYears(543)->addYears(2)->format('d/m/Y');
            $danger_colspan = 2;
        }

//        dd( $row,\Carbon\Carbon::createFromFormat('d/m/y',$row[7])->format('d/m/Y'));
        $tmp = [
            'firstname' => $name[0],
            'lastname' => $name[1],
            'no' => $row[2],
            'position' => $row[3],
            'first_day' => \Carbon\Carbon::createFromFormat('d/m/y',$row[5])->addYears(543)->format('d/m/Y'),
            'start_green_at' => \Carbon\Carbon::createFromFormat('d/m/y',$row[6])->addYears(543)->format('d/m/Y'),
            'end_green_at' => \Carbon\Carbon::createFromFormat('d/m/y',$row[9])->addYears(543)->format('d/m/Y'),
            'safe_colspan' => $row[8],
            'start_yellow_at' => \Carbon\Carbon::createFromFormat('d/m/y',$row[11])->addYears(543)->format('d/m/Y'),
            'end_yellow_at' => \Carbon\Carbon::createFromFormat('d/m/y',$row[12])->addYears(543)->format('d/m/Y'),
            'warning_colspan' => $row[10],

            'start_red_at' => \Carbon\Carbon::createFromFormat('d/m/y',$row[13])->addYears(543)->format('d/m/Y'),
            'end_red_at' =>  \Carbon\Carbon::createFromFormat('d/m/y',$row[12])->addYears(543)->addYears(2)->format('d/m/Y'),
            'danger_colspan' => $danger_colspan,


//            'test8' => $row[15],
//            'leave_education' => $row[16],

        ];
//        dd($row)
        $data[] = $tmp;

        // Read the data
    }

    fclose($open);
    \Illuminate\Support\Facades\DB::table('lay_offs')->insert($data);



});
