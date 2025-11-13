<?php

namespace App\Interfaces\Master;

use App\Commons\Libs\Http\ServiceResponse;
use App\Schemas\Master\JobDepartment\JobDepartmentQuery;
use App\Schemas\Master\JobDepartment\JobDepartmentSchema;

interface JobDepartmentInterface
{
    public function findAll(JobDepartmentQuery $queryParams): ServiceResponse;
    public function findByID($id): ServiceResponse;
    public function create(JobDepartmentSchema $schema): ServiceResponse;
    public function update($id, JobDepartmentSchema $schema): ServiceResponse;
    public function delete($id): ServiceResponse;
}
