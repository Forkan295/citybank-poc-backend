<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        return redirect('http://oauth2-poc.test:8080/oauth/authorize?'.$query);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function token(Request $request): JsonResponse
    {
        $request         = Request::create(route('passport.token'), 'POST', array(
                'grant_type'    => $request->grant_type,
                'client_id'     => $request->client_id,
                'redirect_uri'  => $request->redirect_uri,
                'code_verifier' => $request->codeVerifier,
                'code'          => $request->code,
            )
        );
        $response        = Route::dispatch($request);
        $responseMessage = $response->getContent();
        $tokenInfo       = json_decode($responseMessage);
        return response()->json($tokenInfo);
    }

//    /**
//     * @param ServerRequestInterface $request
//     * @return mixed
//     */
//    public function token(ServerRequestInterface $request)
//    {
//        $tokenResponse = parent::issueToken($request);
//        $token         = $tokenResponse->getContent();
//        $tokenInfo     = json_decode($token, true);
//        $user          = $this->getUserByAccessToken($tokenInfo['access_token']);
//        $jwtToken      = $this->makeJwtToken($user);
//
//        return $jwtToken;
//    }

//    /**
//     * @param $token
//     * @return mixed
//     */
//    private function getUserByAccessToken($token)
//    {
//        $access_token       = $token;
//        $auth_header        = explode(' ', $access_token);
//        $token              = $auth_header[0];
//        $token_parts        = explode('.', $token);
//        $token_header       = $token_parts[1];
//        $token_header_json  = base64_decode($token_header);
//        $token_header_array = json_decode($token_header_json, true);
//        $token_id           = $token_header_array['jti'];;
//        return Token::find($token_id)->user;
//    }
//
//    /**
//     * @param $user
//     * @return mixed
//     */
//    private function makeJwtToken($user)
//    {
//        $customClaims = ['access_token' => $user->access_token, 'token_type' => $user->token_type, 'expires_in' => $user->expires_in, 'refresh_token' => $user->refresh_token];
//        $payload      = JWTFactory::sub(123)->aud('foo')->foo($customClaims)->make()->toArray();
//        $jwt          = resolve(Lcobucci::class);;
//        return $jwt->encode($payload);
//    }


}
