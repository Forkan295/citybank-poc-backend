<?php

namespace App\Http\Controllers\Auth;

use App\Enums\MessageEnum;
use App\Http\Controllers\Controller;
use App\Http\Response\ApiResponse;
use DarkGhostHunter\Larapass\Contracts\WebAuthnAuthenticatable;
use DarkGhostHunter\Larapass\Events\AttestationSuccessful;
use DarkGhostHunter\Larapass\Facades\WebAuthn;
use DarkGhostHunter\Larapass\Http\RegistersWebAuthn;
use Illuminate\Http\Request;


class WebAuthnRegisterController extends Controller
{
    use RegistersWebAuthn;

    /*
    |--------------------------------------------------------------------------
    | WebAuthn Registration Controller
    |--------------------------------------------------------------------------
    |
    | This controller receives an user request to register a device and also
    | verifies the registration. If everything goes ok, the credential is
    | persisted into the application, otherwise it will signal failure.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function register(Request $request, WebAuthnAuthenticatable $user)
    {
        $input           = $request->validate($this->attestationRules());
        $validCredential = WebAuthn::validateAttestation($input, $user);

        if ($validCredential) {
            $user->addCredential($validCredential);
            event(new AttestationSuccessful($user, $validCredential));
            $this->credentialRegistered($user, $validCredential) ?? response()->noContent();
            return app(ApiResponse::class)->success(MessageEnum::REGISTERED);
        }
        return app(ApiResponse::class)->error(MessageEnum::INVALID_CREDENTIAL);
    }

}
