<?php


namespace App\Enums;


interface MessageEnum
{
    const INVALID_CREDENTIAL = 'Invalid Credentials';
    const REGISTERED         = 'Device successfully registered';
    const SERVER_EXCEPTION   = 'Something went wrong, Please try again';

    const WEBAUTHN_ = 'Invalid Credentials';
}
