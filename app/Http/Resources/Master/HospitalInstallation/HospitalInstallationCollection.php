<?php

namespace App\Http\Resources\Master\HospitalInstallation;

use App\Commons\Libs\Resource\BaseCollection;
use Illuminate\Http\Request;

class HospitalInstallationCollection extends BaseCollection
{
    protected $baseResource = HospitalInstallationResource::class;
}
