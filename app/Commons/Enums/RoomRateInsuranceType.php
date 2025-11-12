<?php

namespace App\Commons\Enums;

enum RoomRateInsuranceType: string
{
    case GENERAL = 'general';
    case BPJS = 'bpjs';
    case INSURANCE = 'insurance';
    case CORPORATE = 'corporate';
}
