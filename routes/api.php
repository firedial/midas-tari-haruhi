<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/tasks', 'App\Http\Controllers\TaskController@index');
Route::post('/tasks', 'App\Http\Controllers\TaskController@store');
Route::get('/tasks/{task}', 'App\Http\Controllers\TaskController@show');
Route::put('/tasks/{task}', 'App\Http\Controllers\TaskController@update');
Route::delete('/tasks/{task}', 'App\Http\Controllers\TaskController@destroy');

Route::get('/balances', 'App\Http\Controllers\BalanceController@index');
Route::post('/balances', 'App\Http\Controllers\BalanceController@store');
Route::get('/balances/{balance}', 'App\Http\Controllers\BalanceController@show');
Route::put('/balances/{balance}', 'App\Http\Controllers\BalanceController@update');
Route::delete('/balances/{balance}', 'App\Http\Controllers\BalanceController@destroy');

Route::get('/move_purpose', 'App\Http\Controllers\MovePurposeController@index');
Route::post('/move_purpose', 'App\Http\Controllers\MovePurposeController@store');
Route::get('/move_purpose/{move_purpose}', 'App\Http\Controllers\MovePurposeController@show');
Route::put('/move_purpose/{move_purpse}', 'App\Http\Controllers\MovePurposeController@update');
Route::delete('/move_purpose/{move_purpose}', 'App\Http\Controllers\MovePurposeController@destroy');

Route::get('/move_place', 'App\Http\Controllers\MovePlaceController@index');
Route::post('/move_place', 'App\Http\Controllers\MovePlaceController@store');
Route::get('/move_place/{move_place}', 'App\Http\Controllers\MovePlaceController@show');
Route::put('/move_place/{move_place}', 'App\Http\Controllers\MovePlaceController@update');
Route::delete('/move_place/{move_place}', 'App\Http\Controllers\MovePlaceController@destroy');
