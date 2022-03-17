<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Response\ApiResponse;
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
                $request->merge($this->formatData($request));
                $data = $this->generatePasswordData($request->all());
                break;
            case 'authorization_code':
                $data = $this->generateAuthorizationCodeData($request->all());
                break;
        }
        $data            = Request::create(route('passport.token'), 'POST', $data);
        $response        = Route::dispatch($data);
        $responseMessage = $response->getContent();
        $tokenInfo       = json_decode($responseMessage);
        if (isset($tokenInfo->error)) {
            return app(ApiResponse::class)->error($tokenInfo->message, $tokenInfo->error);
        }
        return app(ApiResponse::class)->success($tokenInfo, 'Token generated successfully');
    }

    /**
     * @param $request
     */
    private function generatePasswordData($request): array
    {
        $data                  = [];
        $data['grant_type']    = 'password';
        $data['client_id']     = data_get($request, 'client_id');
        $data['client_secret'] = data_get($request, 'client_secret');
        $data['username']      = data_get($request, 'username');
        $data['password']      = data_get($request, 'password');
        $data['scope']         = '';
        return $data;
    }

    /**
     * @param $request
     * @return array
     */
    private function generateAuthorizationCodeData($request): array
    {
        $data                  = [];
        $data['grant_type']    = 'authorization_code';
        $data['client_id']     = $request['client_id'];
        $data['redirect_uri']  = $request['redirect_uri'];
        $data['code_verifier'] = $request['code_verifier'];
        $data['code']          = $request['code'];
        return $data;
    }

    /**
     * @param $request
     * @return array
     */
    private function formatData($request): array
    {
        $client = explode(':', base64_decode($request->getUser()));
        $user   = explode(':', base64_decode($request->getPassword()));

        return [
            'client_id'     => $client[0],
            'client_secret' => $client[1],
            'username'      => $user[0],
            'password'      => $user[1],
        ];
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
