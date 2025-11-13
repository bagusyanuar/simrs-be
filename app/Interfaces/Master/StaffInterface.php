<?php

namespace App\Interfaces\Master;

use App\Commons\Libs\Http\ServiceResponse;
use App\Schemas\Master\Staff\StaffQuery;
use App\Schemas\Master\Staff\StaffSchema;

interface StaffInterface
{
    public function findAll(StaffQuery $queryParams): ServiceResponse;
    public function findByID($id): ServiceResponse;
    public function create(StaffSchema $schema): ServiceResponse;
    public function update($id, StaffSchema $schema): ServiceResponse;
    public function delete($id): ServiceResponse;
}
