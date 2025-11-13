<?php

namespace App\Interfaces\Master;

use App\Commons\Libs\Http\ServiceResponse;
use App\Schemas\Master\JobPosition\JobPositionQuery;
use App\Schemas\Master\JobPosition\JobPositionSchema;

interface JobPositionInterface
{
    public function findAll(JobPositionQuery $queryParams): ServiceResponse;
    public function findByID($id): ServiceResponse;
    public function create(JobPositionSchema $schema): ServiceResponse;
    public function update($id, JobPositionSchema $schema): ServiceResponse;
    public function delete($id): ServiceResponse;
}
