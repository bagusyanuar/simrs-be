<?php

namespace App\Interfaces\Master;

use App\Commons\Libs\Http\ServiceResponse;
use App\Schemas\Master\HospitalUnit\HospitalUnitQuery;
use App\Schemas\Master\HospitalUnit\HospitalUnitSchema;

interface HospitalUnitInterface
{
    public function findAll(HospitalUnitQuery $queryParams): ServiceResponse;
    public function findByID($id): ServiceResponse;
    public function create(HospitalUnitSchema $schema): ServiceResponse;
    public function update($id, HospitalUnitSchema $schema): ServiceResponse;
    public function delete($id): ServiceResponse;
}
