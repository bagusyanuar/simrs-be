<?php

namespace App\Services\Master;

use App\Commons\Libs\Http\ServiceResponse;
use App\Interfaces\Master\StaffInterface;
use App\Schemas\Master\Staff\StaffQuery;
use App\Schemas\Master\Staff\StaffSchema;

class StaffService implements StaffInterface
{
    public function findAll(StaffQuery $queryParams): ServiceResponse
    {
        throw new \Exception('Not implemented');
    }

    public function findByID($id): ServiceResponse
    {
        throw new \Exception('Not implemented');
    }

    public function create(StaffSchema $schema): ServiceResponse
    {
        throw new \Exception('Not implemented');
    }

    public function update($id, StaffSchema $schema): ServiceResponse
    {
        throw new \Exception('Not implemented');
    }

    public function delete($id): ServiceResponse
    {
        throw new \Exception('Not implemented');
    }
}
