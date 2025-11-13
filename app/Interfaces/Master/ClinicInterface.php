<?php

namespace App\Interfaces\Master;

use App\Commons\Libs\Http\ServiceResponse;
use App\Schemas\Master\Clinic\ClinicQuery;
use App\Schemas\Master\Clinic\ClinicSchema;

interface ClinicInterface
{
    public function findAll(ClinicQuery $queryParams): ServiceResponse;
    public function findByID($id): ServiceResponse;
    public function create(ClinicSchema $schema): ServiceResponse;
    public function update($id, ClinicSchema $schema): ServiceResponse;
    public function delete($id): ServiceResponse;
}
