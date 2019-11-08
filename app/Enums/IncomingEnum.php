<?php

namespace App\Enums;

class IncomingEnum
{
    /**
     * < 0,5млн - 2,5 млн. грн.
     */
    public const INCOMING_FIRST_TYPE = 1;

    /**
     * 2,5-10 млн. грн.
     */
    public const INCOMING_SECOND_TYPE = 2;

    /**
     * 10 млн. грн.
     */
    public const INCOMING_THIRD_TYPE = 3;
}
