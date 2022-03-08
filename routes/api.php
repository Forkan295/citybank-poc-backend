<?php

use App\Http\Controllers\Api\UserController;
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

Route::post('/login',[UserController::class,'login']);
Route::post('/registration',[UserController::class,'registration']);

Route::get('/user',function (Request $request){
    return response()->json(['user' => Auth::user()]);
})->middleware('auth:api');
