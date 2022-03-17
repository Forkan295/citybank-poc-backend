<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Response\ApiResponse;
use App\Service\AuthService;
use App\Service\OauthService;
use Firebase\JWT\JWT;
use Illuminate\Auth\Access\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Token;
use Lcobucci\JWT\Configuration;
use Psr\Http\Message\ServerRequestInterface;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Providers\JWT\Lcobucci;

class OauthController extends AccessTokenController
{
    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function getAuthorization(Request $request)
    {

        $query = http_build_query([
            'client_id'             => $request->client_id,
            'redirect_uri'          => $request->redirect_uri,
            'response_type'         => 'code',
            'scope'                 => '',
            'state'                 => $request->state,
            'code_challenge'        => $request->code_challenge,
            'code_challenge_method' => $request->code_challenge_method,
        ]);
        return redirect(url('oauth/authorize?' . $query));
    }

    /**
     * @param Request $request
     * @return JsonResponse|mixed
     */
    public function token(Request $request)
    {
        $data = [];
        switch ($request->grant_type) {
            case 'password':
                $request->merge(app(OauthService::class)->formatData($request));
                $data = app(OauthService::class)->generatePasswordData($request->all());
                break;
            case 'authorization_code':
                $data = app(OauthService::class)->generateAuthorizationCodeData($request->all());
                break;
        }
        $data            = Request::create(route('passport.token'), 'POST', $data);
        $response        = Route::dispatch($data);
        $responseMessage = $response->getContent();
        $tokenInfo       = json_decode($responseMessage);
        if (isset($tokenInfo->error)) {
            return app(ApiResponse::class)->error($tokenInfo->message, $tokenInfo->error);
        }
        return app(ApiResponse::class)->success(['token' => $tokenInfo, 'user' => app(AuthService::class)->getUserData(app(OauthService::class)->getUserByAccessToken($tokenInfo->access_token))], 'Token generated successfully');
    }


}
