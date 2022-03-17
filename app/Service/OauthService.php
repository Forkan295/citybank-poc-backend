<?php

namespace App\Service;

use Laravel\Passport\Token;

class OauthService
{
    /**
     * @param $request
     */
    public function generatePasswordData($request): array
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
    public function generateAuthorizationCodeData($request): array
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
    public function formatData($request): array
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

    /**
     * @param $token
     * @return mixed
     */
    public function getUserByAccessToken($token)
    {
        $access_token       = $token;
        $auth_header        = explode(' ', $access_token);
        $token              = $auth_header[0];
        $token_parts        = explode('.', $token);
        $token_header       = $token_parts[1];
        $token_header_json  = base64_decode($token_header);
        $token_header_array = json_decode($token_header_json, true);
        $token_id           = $token_header_array['jti'];;
        return Token::find($token_id)->user;
    }
}
