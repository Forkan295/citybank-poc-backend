<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\OauthController as AthorizeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\RechargeController;
use App\Http\Controllers\Api\BeneficiaryController;
use App\Http\Controllers\Api\MobileOperatorController;
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


Route::group(['name' => 'v1.', 'middleware' => 'apilogger'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/authorize', [AthorizeController::class, 'getAuthorization'])->name('v1.authorize');
    Route::post('/token', [AthorizeController::class, 'token'])->name('v1.token');

    //biometric auth
    Route::group(['prefix' => 'webauthn'], function () {
        Route::post('/login/options', [WebAuthnLoginController::class, 'options'])->name('webauthn.login.options');
        Route::post('/login', [WebAuthnLoginController::class, 'login'])->name('webauthn.login');
    });


    Route::group(['middleware' => 'auth:api'], function () {
        //=========== biometric register ===========================
        Route::group(['prefix' => 'webauthn'], function () {
            Route::post('/register/options',
                [WebAuthnRegisterController::class, 'options'])->name('webauthn.register.options');
            Route::post('/register', [WebAuthnRegisterController::class, 'register'])->name('webauthn.register');
        });

        Route::group(['prefix' => 'beneficiary'], function () {
            Route::get('/', [BeneficiaryController::class, 'index'])->name('beneficiary.index');
            Route::post('/create', [BeneficiaryController::class, 'store'])->name('beneficiary.create');
            Route::put('/{beneficiary}', [BeneficiaryController::class, 'update'])->name('beneficiary.update');
            Route::delete('/{beneficiary}', [BeneficiaryController::class, 'destroy'])->name('beneficiary.destroy');
        });

        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [AuthController::class, 'getProfile'])->name('user.profile');
            Route::get('/accounts', [AccountController::class, 'getAccounts']);
            Route::post('/balance-transfer', [AccountController::class, 'balanceTransfer']);
            Route::post('/transactions', [AccountController::class, 'getTransaction']);
            Route::post('recharge', [RechargeController::class, 'recharge']);
            Route::post('/logout', [UserController::class, 'logout']);
        });

        Route::group(['prefix' => 'common'], function () {
            Route::get('/banks', [ApiController::class, 'getBanks'])->name('common.banks');
            Route::get('/transaction-types', [ApiController::class, 'getTransferType'])->name('common.transaction-types');
            Route::get('/mobile-operators', [MobileOperatorController::class, 'getOperator'])->name('common.mobile-operators');
            Route::post('/send-otp', [ApiController::class, 'generateOtp'])->name('common.send-otp');
//            Route::post('/validate-otp', [ApiController::class, 'validateOtp'])->name('common.validate-otp');
        });
    });
});
