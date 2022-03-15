<?php


namespace App\Enums;


interface TransactionTypeEnum
{
    const WITHIN_BANK = 1;
    const OTHER_BANK  = 2;
    const RECHARGE    = 3;
}
