<?php

use App\Http\Controllers\Api\OauthController as AthorizeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\RechargeController;
use App\Http\Controllers\Api\BeneficiaryController;
use App\Http\Controllers\Auth\WebAuthnLoginController;
use App\Http\Controllers\Auth\WebAuthnRegisterController;

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

//Route::post('/login', [UserController::class, 'login']);
//Route::post('/registration', [UserController::class, 'registration']);
//Route::post('webauthn/login', [WebAuthnLoginController::class, 'login'])->name('webauthn.login');
//Route::post('webauthn/register', [WebAuthnRegisterController::class, 'register'])->name('webauthn.register');

//Route::group(['name' => 'v1.', 'middleware' => 'auth:api'], function () {
//    Route::post('/logout', [UserController::class, 'logout']);
//    Route::group(['prefix' => 'user'], function () {
//        Route::get('/', [UserController::class, 'getUser']);
//        Route::get('/accounts', [UserController::class, 'getAccounts']);
//    });
//});


Route::group(['name' => 'v1.'], function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::group(['prefix' => 'webauthn'], function () {
        Route::post('/login/options', [WebAuthnLoginController::class, 'options'])->name('webauthn.login.options');
        Route::post('/login', [WebAuthnLoginController::class, 'login'])->name('webauthn.login');
    });
    Route::get('/authorize', [AthorizeController::class, 'getAuthorization'])->name('v1.authorize');
    Route::post('/token', [AthorizeController::class, 'token'])->name('v1.token');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [AuthController::class, 'getProfile'])->name('v1.user.profile');
            Route::get('/accounts', [AccountController::class, 'getAccounts']);
        });

        Route::group(['prefix' => 'beneficiary'], function () {
            Route::get('/', [BeneficiaryController::class, 'index'])->name('beneficiary.index');
            Route::post('/create', [BeneficiaryController::class, 'store'])->name('beneficiary.create');
            Route::put('/{beneficiary}', [BeneficiaryController::class, 'update'])->name('beneficiary.update');
            Route::delete('/{beneficiary}', [BeneficiaryController::class, 'destroy'])->name('beneficiary.destroy');
        });

        Route::post('recharge', [RechargeController::class, 'recharge']);

        //=========== biometric login and register ===========================
        Route::group(['prefix' => 'webauthn'], function () {
            Route::post('/register/options', [WebAuthnRegisterController::class, 'options'])->name('webauthn.register.options');
            Route::post('/register', [WebAuthnRegisterController::class, 'register'])->name('webauthn.register');
        });
        //logout user
        Route::post('/logout', [UserController::class, 'logout']);
    });
});
