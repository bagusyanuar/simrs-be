<?php

namespace App\Http\Controllers\Web\Master;

use App\Commons\Libs\Http\APIResponse;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomController;
use App\Http\Resources\Master\JobPosition\JobPositionCollection;
use App\Http\Resources\Master\JobPosition\JobPositionResource;
use App\Schemas\Master\JobPosition\JobPositionQuery;
use App\Schemas\Master\JobPosition\JobPositionSchema;
use App\Services\Master\JobPositionService;
use Illuminate\Http\Request;

class JobPositionController extends CustomController
{
    /** @var JobPositionService $service */
    private $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = new JobPositionService();
    }

    public function create()
    {
        $schema = (new JobPositionSchema())->hydrateSchemaBody($this->jsonBody());
        $response = $this->service->create($schema);
        return APIResponse::fromService($response);
    }

    public function findAll()
    {
        $query = (new JobPositionQuery())->hydrateSchemaQuery($this->queryParams());
        $response = $this->service->findAll($query);
        return new JobPositionCollection($response->getData(), $response->getStatus(), $response->getMessage());
    }

    public function findByID($id)
    {
        $response = $this->service->findByID($id);
        return new JobPositionResource($response->getData(), $response->getStatus(), $response->getMessage());
    }

    public function update($id)
    {
        $schema = (new JobPositionSchema())->hydrateSchemaBody($this->jsonBody());
        $response = $this->service->update($id, $schema);
        return APIResponse::fromService($response);
    }

    public function delete($id)
    {
        $response = $this->service->delete($id);
        return APIResponse::fromService($response);
    }
}
