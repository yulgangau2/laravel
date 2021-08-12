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

Route::get('/', function () {
    return view('temp');
});


Route::group(['prefix' => 'admin'], function () {
    Route::get('', [\App\Http\Controllers\ReportController::class, 'index'])->name('index');
    Route::get('index2', [\App\Http\Controllers\ReportController::class, 'index2'])->name('index2');
    Route::get('index3', [\App\Http\Controllers\ReportController::class, 'index3'])->name('index3');
    Route::get('index4', [\App\Http\Controllers\ReportController::class, 'index4'])->name('index4');

});


Route::get('aaa', function () {
    dd(\Illuminate\Support\Facades\Hash::make(1234));

    $string = date_create("2564-06-15");
//    $string = $this->request->getData('delivery_date');
    $y = (int)date_format($string, "Y");
    $m = (int)date_format($string, "m");
    $d = (int)date_format($string, "d");
    $Y = date('Y');
    if ($Y+543 == $y){
        $y = $Y;
        $string = $y.'-'.$m.'-'.$d;
    }
    $x = date('Y-m-d', strtotime($string));
    dd($x);


    $xx = $date->format('Y');
    $date = DateTime::createFromFormat('Y', '2009-02-15');






    dd($xx);

});
