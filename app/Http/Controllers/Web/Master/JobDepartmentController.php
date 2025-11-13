<?php

namespace App\Http\Controllers\Web\Master;

use App\Commons\Libs\Http\APIResponse;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomController;
use App\Http\Resources\Master\JobDepartment\JobDepartmentCollection;
use App\Http\Resources\Master\JobDepartment\JobDepartmentResource;
use App\Schemas\Master\JobDepartment\JobDepartmentQuery;
use App\Schemas\Master\JobDepartment\JobDepartmentSchema;
use App\Services\Master\JobDepartmentService;
use Illuminate\Http\Request;

class JobDepartmentController extends CustomController
{
    /** @var JobDepartmentService $service */
    private $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = new JobDepartmentService();
    }

    public function create()
    {
        $schema = (new JobDepartmentSchema())->hydrateSchemaBody($this->jsonBody());
        $response = $this->service->create($schema);
        return APIResponse::fromService($response);
    }

    public function findAll()
    {
        $query = (new JobDepartmentQuery())->hydrateSchemaQuery($this->queryParams());
        $response = $this->service->findAll($query);
        return new JobDepartmentCollection($response->getData(), $response->getStatus(), $response->getMessage());
    }

    public function findByID($id)
    {
        $response = $this->service->findByID($id);
        return new JobDepartmentResource($response->getData(), $response->getStatus(), $response->getMessage());
    }

    public function update($id)
    {
        $schema = (new JobDepartmentSchema())->hydrateSchemaBody($this->jsonBody());
        $response = $this->service->update($id, $schema);
        return APIResponse::fromService($response);
    }

    public function delete($id)
    {
        $response = $this->service->delete($id);
        return APIResponse::fromService($response);
    }
}
