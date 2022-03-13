<?php


namespace App\Enums;


interface MessageEnum
{
    const INVALID_CREDENTIAL = 'Invalid Credentials';
    const SERVER_EXCEPTION = 'Something went wrong, Please try again';
    const NO_ACCOUNT = 'You don\'t have primary account!';
    const NO_BALANCE = 'You have no sufficient balance!';
    const SUCCESS_RECHARGE = 'You have successfully recharged.';
}
