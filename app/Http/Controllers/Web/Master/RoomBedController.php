<?php

namespace App\Http\Controllers\Web\Master;

use App\Commons\Libs\Http\APIResponse;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomController;
use App\Http\Resources\Master\RoomBed\RoomBedCollection;
use App\Http\Resources\Master\RoomBed\RoomBedResource;
use App\Schemas\Master\RoomBed\RoomBedQuery;
use App\Schemas\Master\RoomBed\RoomBedSchema;
use App\Services\Master\RoomBedService;
use Illuminate\Http\Request;

class RoomBedController extends CustomController
{
    /** @var RoomBedService $service */
    private $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = new RoomBedService();
    }

    public function create()
    {
        $schema = (new RoomBedSchema())->hydrateSchemaBody($this->jsonBody());
        $response = $this->service->create($schema);
        return APIResponse::fromService($response);
    }

    public function findAll()
    {
        $query = (new RoomBedQuery())->hydrateSchemaQuery($this->queryParams());
        $response = $this->service->findAll($query);
        return new RoomBedCollection($response->getData(), $response->getStatus(), $response->getMessage());
    }

    public function findByID($id)
    {
        $response = $this->service->findByID($id);
        return new RoomBedResource($response->getData(), $response->getStatus(), $response->getMessage());
    }

    public function update($id)
    {
        $schema = (new RoomBedSchema())->hydrateSchemaBody($this->jsonBody());
        $response = $this->service->update($id, $schema);
        return APIResponse::fromService($response);
    }

    public function delete($id)
    {
        $response = $this->service->delete($id);
        return APIResponse::fromService($response);
    }
}
