<?php

use App\Http\Controllers\Auth\WebAuthnLoginController;
use App\Http\Controllers\Backend\ActivityLogController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\BankListController;
use App\Http\Controllers\Backend\MobileOperatorListController;
use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

use App\Http\Controllers\Auth\WebAuthnRegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {
    Route::domain(config('app.sub_domain'))->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('mobile-operator-list', [MobileOperatorListController::class, 'index'])->name('mobile_operator_list.index');
        Route::get('bank-list', [BankListController::class, 'index'])->name('bank_list.index');
        Route::get('client-list', [ClientController::class, 'getClients'])->name('client.get_all');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // only for client SK
    Route::get('clients', [ClientController::class, 'index'])->name('client.index');

    Route::get('client-list', [ClientController::class, 'getClients'])->name('client.get_all');
    Route::get('clients/create', [ClientController::class, 'create'])->name('client.create');
    Route::post('clients', [ClientController::class, 'store'])->name('client.store');
    Route::get('clients/{client}', [ClientController::class, 'destroy'])->name('client.delete');

    Route::get('activity-log', [ActivityLogController::class, 'index'])->name('activity_log.index');
    Route::get('activity-log/{id}/show', [ActivityLogController::class, 'show'])->name('activity_log.show');

    Route::get('my-profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('my-profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('users', [UserController::class, 'index'])->name('user.index');
    Route::get('users/create', [UserController::class, 'create'])->name('user.create');
    Route::get('users/{user}/show', [UserController::class, 'show'])->name('user.show');
    Route::post('users', [UserController::class, 'store'])->name('user.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('user.update');
});

require __DIR__.'/auth.php';
