<?php

namespace App\Enums;

enum EmailStatus: int
{
    case Sent    = 1;
    case Pending = 2;
}
