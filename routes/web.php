<?php

use App\Http\Controllers\Auth\WebAuthnLoginController;
use App\Http\Controllers\ActivityLogController;
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

Route::get('/auth/callback', function (Request $request) {
   dd( $request->all());
    $state = $request->session()->pull('state');

//    throw_unless(
//        strlen($state) > 0 && $state === $request->state,
//        InvalidArgumentException::class
//    );


    $client = $request->user()->clients()->find('95c4bf6f-f986-4486-9e04-902e11264b2f');
//    dd($request->all(),$request->session(),$request->session()->get('authRequest'));

    $response = Http::asForm()->post('http://oauth2-poc.test:8080/oauth/token', [
        'grant_type' => 'authorization_code',
        'client_id' => $client->id,
        'client_secret' => $client->secret,
        'redirect_uri' => $client->redirect,
        'code' => $request->code,
    ]);


    return $response->json();
});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/oauth/clients',function(Request $request){
            return view('oauth.clients',[
                'clients'=> $request->user()->clients
            ]);
    })->name('oauth.authorized');

});


Route::post('webauthn/register/options', [WebAuthnRegisterController::class, 'options'])
    ->name('webauthn.register.options');

Route::post('webauthn/register', [WebAuthnRegisterController::class, 'register'])
    ->name('webauthn.register');

Route::post('webauthn/login/options', [WebAuthnLoginController::class, 'options'])
    ->name('webauthn.login.options');
Route::post('webauthn/login', [WebAuthnLoginController::class, 'login'])
    ->name('webauthn.login');



Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', function (Request $request) {
        return view('dashboard',[
            'clients'=> $request->user()->clients
        ]);
    })->name('dashboard');

    Route::get('activity-log', [ActivityLogController::class, 'index'])->name('activity_log.index');
    Route::get('activity-log/{id}/show', [ActivityLogController::class, 'show'])->name('activity_log.show');
});

require __DIR__.'/auth.php';
