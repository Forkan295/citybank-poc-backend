<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Psr\Http\Message\ServerRequestInterface;

class OauthController extends AccessTokenController
{
    public function getAuthorization(Request $request)
    {
        session()->put('state', $state = Str::random(40));
        $query = http_build_query([
            'client_id'     => $request->client_id,
            'redirect_uri'  => $request->redirect_uri,
            'response_type' => 'code',
            'scope'         => '',
            'state'         => $state,
        ]);
        return redirect('http://oauth2-poc.test:8080/oauth/authorize?' . $query);
    }

//    public function token(Request $request)
//    {
//        $request         = Request::create(route('passport.token'), 'POST', array(
//                'grant_type'    => $request->grant_type,
//                'client_id'     => $request->client_id,
//                'client_secret' => $request->client_secret,
//                'redirect_uri'  => $request->redirect_uri,
//                'code'          => $request->code,
//            )
//        );
//        $response        = Route::dispatch($request);
//        $responseMessage = $response->getContent();
//        return $response;
//    }

    public function token(ServerRequestInterface $request)
    {
        dd($request);
        $tokenResponse = parent::issueToken($request);
        $token = $tokenResponse->getContent();

        // $tokenInfo will contain the usual Laravel Passort token response.
        $tokenInfo = json_decode($token, true);


        // Then we just add the user to the response before returning it.
        $username = $request->getParsedBody();
        $tokenInfo['access_token'] = 'sdsdsadsadsadsadsad';
        $this->getUserByAccessToken($tokenInfo['access_token']);
//        exit();
        dd($tokenInfo['access_token'], $username,auth('api')->user());
        $user = User::whereEmail($username)->first();
        $tokenInfo = collect($tokenInfo);
        $tokenInfo->put('user', $user);

        return $tokenInfo;
    }

    public function getUserByAccessToken($token)
    {
        $response = Http::withOptions([
            'debug' => true,
            'verify' => false,
        ])->withHeaders([
            'authorization' => 'Bearer ' . $token,
            'content-type' => 'Application/json',
        ])->get('http://oauth2-poc.test:8080/v1/user');
        dd($response);
    }


}
