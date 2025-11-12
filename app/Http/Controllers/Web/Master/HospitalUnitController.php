<?php

namespace App\Http\Controllers\Web\Master;

use App\Commons\Libs\Http\APIResponse;
use App\Http\Controllers\CustomController;
use App\Http\Resources\Master\HospitalUnit\HospitalUnitCollection;
use App\Http\Resources\Master\HospitalUnit\HospitalUnitResource;
use App\Schemas\Master\HospitalUnit\HospitalUnitQuery;
use App\Schemas\Master\HospitalUnit\HospitalUnitSchema;
use App\Services\Master\HospitalUnitService;

class HospitalUnitController extends CustomController
{
    /** @var HospitalUnitService $service */
    private $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = new HospitalUnitService();
    }

    public function create()
    {
        $schema = (new HospitalUnitSchema())->hydrateSchemaBody($this->jsonBody());
        $response = $this->service->create($schema);
        return APIResponse::fromService($response);
    }

    public function findAll()
    {
        $query = (new HospitalUnitQuery())->hydrateSchemaQuery($this->queryParams());
        $response = $this->service->findAll($query);
        return new HospitalUnitCollection($response->getData(), $response->getStatus(), $response->getMessage());
    }

    public function findByID($id)
    {
        $response = $this->service->findByID($id);
        return new HospitalUnitResource($response->getData(), $response->getStatus(), $response->getMessage());
    }

    public function update($id)
    {
        $schema = (new HospitalUnitSchema())->hydrateSchemaBody($this->jsonBody());
        $response = $this->service->update($id, $schema);
        return APIResponse::fromService($response);
    }

    public function delete($id)
    {
        $response = $this->service->delete($id);
        return APIResponse::fromService($response);
    }
}
