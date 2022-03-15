<?php

namespace App\Http\Controllers\Auth;

use App\Enums\MessageEnum;
use App\Http\Controllers\Controller;
use App\Http\Response\ApiResponse;
use App\Service\AuthService;
use DarkGhostHunter\Larapass\Http\AuthenticatesWebAuthn;
use Illuminate\Http\Request;

class WebAuthnLoginController extends Controller
{
    use AuthenticatesWebAuthn;

    /*
    |--------------------------------------------------------------------------
    | WebAuthn Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller allows the WebAuthn user device to request a login and
    | return the correctly signed challenge. Most of the hard work is done
    | by your Authentication Guard once the user is attempting to login.
    |
    */

    public function __construct()
    {
        $this->middleware(['guest', 'throttle:10,1']);
    }

    public function login(Request $request)
    {
        $credential = $request->validate($this->assertionRules());

        if ($authenticated = $this->attemptLogin($credential, $this->hasRemember($request))) {
            $authService = new AuthService();
            $accessToken = auth()->user()->createToken('users')->accessToken;
            $user        = $authService->getUserData($authenticated);
            return app(ApiResponse::class)->success(['access_token' => $accessToken, 'user' => $user]);
            //return $this->authenticated($request, $this->guard()->user()) ?? response()->noContent();
        }
        return app(ApiResponse::class)->error(MessageEnum::INVALID_CREDENTIAL);
    }


}
