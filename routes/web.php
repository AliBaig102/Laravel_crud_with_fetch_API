<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\studentController;
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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::controller(studentController::class)->group(function (){
    Route::get('/','show_all')->name('home');
    Route::post('/singleUser','show_single');
    Route::post('/insert','insert');
    Route::post('/delete','delete');
    Route::post('/update/{id}','update');
});
//Route::get('/',)
