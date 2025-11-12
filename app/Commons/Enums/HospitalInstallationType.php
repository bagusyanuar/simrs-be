<?php

namespace App\Commons\Enums;

enum HospitalInstallationType: string
{
    case SERVICE = 'service';
    case SUPPORT = 'support';
    case ADMINISTRATION = 'administration';
}
