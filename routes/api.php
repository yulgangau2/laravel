<?php

use App\ApiController;
use App\Employee;
use App\EmployeeHrPosition;
use App\NowUpdate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('get_token',function (Request $request){

    $authorization = base64_encode("YR1g9sYHb7ZKnfZwPankGdGDcs5xaxqE6znv3rMq:raxf9NGvBy2HgfqVhydTwAGQTuPY4DDyA85FSAEB");


    $json_url = 'https://oauth.cmu.ac.th/v1/GetToken.aspx';

//old
//$json_string = "grant_type=client_credentials&scope=research.public research.0000000021";

//new
//$json_string = "grant_type=client_credentials&scope=cmuitaccount.all.basicinfo&mishr.0000000021.executive&cmuitaccount.all.employee.member&mishr.all.basicinfo&mishr.0000000021.education&mishr.0000000021.fame&mishr.0000000021.leaveeducation&mishr.0000000021.leavehistory&mishr.0000000021.personalinfo&mishr.0000000021.workhistory";

    $scope = $request->get('scope');


    $json_string = "grant_type=client_credentials&scope=".$scope;



    $ch = curl_init( $json_url);

    $options = array(

        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_SSL_VERIFYPEER=>false,

        CURLOPT_HTTPHEADER => array(

            "content-type: application/x-www-form-urlencoded",

            "Authorization: Basic $authorization",

        ),

        CURLOPT_POSTFIELDS => $json_string

    );



    curl_setopt_array( $ch, $options );

    $result = curl_exec($ch); // Getting jSON result string



    $obj=json_decode($result,true);

    $token =  $obj['access_token'];

    dd($token);


    echo $token;
})->name('get_token');


Route::post('upload_layoff', [\App\Http\Controllers\Api\UpdateController::class, 'upload_layoff'])->name('api_upload_layoff');

//update Employee
Route::post('update_employee', [\App\Http\Controllers\Api\UpdateController::class, 'update_employee'])->name('api_update_employee');


//update Personal Info
Route::post('update_personal_info', [\App\Http\Controllers\Api\UpdateController::class, 'update_personal_info'])->name('api_update_personal_info');

//update history worker
Route::post('update_history_worker', [\App\Http\Controllers\Api\UpdateController::class, 'update_history_worker'])->name('api_update_history_worker');

//update workcurrentinfo //check
Route::post('update_work_current_info', [\App\Http\Controllers\Api\UpdateController::class, 'update_work_current_info'])->name('api_update_work_current_info');



//update education
Route::post('update_employee_education', [\App\Http\Controllers\Api\UpdateController::class, 'update_employee_education'])->name('api_update_employee_education');

//update executive
Route::post('update_employee_executive', [\App\Http\Controllers\Api\UpdateController::class, 'update_employee_executive'])->name('api_update_employee_executive');

//update leavehistory
Route::post('update_employee_leavehistory', [\App\Http\Controllers\Api\UpdateController::class, 'update_employee_leavehistory'])->name('api_update_employee_leavehistory');

//update leaveeducation
Route::post('update_employee_leaveeducation', [\App\Http\Controllers\Api\UpdateController::class, 'update_employee_leaveeducation'])->name('api_update_employee_leaveeducation');

//update leaveeducation
Route::post('update_employee_fame', [\App\Http\Controllers\Api\UpdateController::class, 'update_employee_fame'])->name('api_update_employee_fame');

//update leaveeducation
Route::post('update_employee_address', [\App\Http\Controllers\Api\UpdateController::class, 'update_employee_address'])->name('api_update_employee_address');
