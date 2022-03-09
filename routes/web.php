<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/callback', function (Request $request) {
//    dd( $request->user()->clients()->find(8));
    $state = $request->session()->pull('state');

//    throw_unless(
//        strlen($state) > 0 && $state === $request->state,
//        InvalidArgumentException::class
//    );


    $client = $request->user()->clients()->find('95c4bf6f-f986-4486-9e04-902e11264b2f');
//    dd($request->all(),$request->session(),$request->session()->get('authRequest'));

    $response = Http::asForm()->post('http://swt-cms-base.test:8080/oauth/token', [
        'grant_type' => 'authorization_code',
        'client_id' => $client->id,
        'client_secret' => $client->secret,
        'redirect_uri' => $client->redirect,
        'code' => $request->code,
    ]);


    return $response->json();
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
