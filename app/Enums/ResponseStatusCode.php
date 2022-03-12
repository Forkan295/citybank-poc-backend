<?php


namespace App\Enums;


interface ResponseStatusCode
{
    const SUCCESS    = 400200;
    const FAILED     = 400300;
    const VALIDATION = 400419;
    const EXCEPTION  = 400500;
}
