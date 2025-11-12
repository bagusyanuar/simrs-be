<?php

namespace App\Interfaces\Master;

use App\Commons\Libs\Http\ServiceResponse;
use App\Schemas\Master\HospitalInstallation\HospitalInstallationQuery;

interface HospitalUnitInterface
{
    public function findAll(HospitalInstallationQuery $queryParams): ServiceResponse;
}
