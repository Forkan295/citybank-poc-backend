<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\WebAuthnLoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::post('webauthn/login', [WebAuthnLoginController::class, 'login'])
    ->name('webauthn.login');

Route::get('/user',function (Request $request){
    if ($request->user()->tokenCan('personal-info')) {
        return response()->json(['user' => Auth::user()]);
    }else{
        return response()->json(['error' => 'Unauthorized'], 401);
    }
})->middleware(['auth:api']);

