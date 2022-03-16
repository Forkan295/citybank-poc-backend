<?php


namespace App\Enums;


interface MessageEnum
{
    const INVALID_CREDENTIAL = 'Invalid Credentials';
    const INSUFFICIENT_AMOUNT = 'Insufficient amount';
    const REGISTERED         = 'Device successfully registered';
    const SERVER_EXCEPTION   = 'Something went wrong, Please try again';

    const SUCCESS = 'Data store successfully';
    const UPDATE  = 'Data updated successfully';
}
