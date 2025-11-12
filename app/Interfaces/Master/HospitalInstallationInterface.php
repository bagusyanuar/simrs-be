<?php

namespace App\Interfaces\Master;

use App\Commons\Libs\Http\ServiceResponse;
use App\Schemas\Master\HospitalInstallation\HospitalInstallationQuery;
use App\Schemas\Master\HospitalInstallation\HospitalInstallationSchema;

interface HospitalInstallationInterface
{
    public function findAll(HospitalInstallationQuery $queryParams): ServiceResponse;
    public function findByID($id): ServiceResponse;
    public function create(HospitalInstallationSchema $schema): ServiceResponse;
    public function update($id, HospitalInstallationSchema $schema): ServiceResponse;
    public function delete($id): ServiceResponse;
}
