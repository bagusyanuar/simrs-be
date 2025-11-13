<?php

namespace App\Http\Controllers\Web\Master;

use App\Commons\Libs\Http\APIResponse;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomController;
use App\Http\Resources\Master\RoomClass\RoomClassCollection;
use App\Http\Resources\Master\RoomClass\RoomClassResource;
use App\Schemas\Master\RoomClass\RoomClassQuery;
use App\Schemas\Master\RoomClass\RoomClassSchema;
use App\Services\Master\RoomClassService;
use Illuminate\Http\Request;

class RoomClassController extends CustomController
{
    /** @var RoomClassService $service */
    private $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = new RoomClassService();
    }

    public function create()
    {
        $schema = (new RoomClassSchema())->hydrateSchemaBody($this->jsonBody());
        $response = $this->service->create($schema);
        return APIResponse::fromService($response);
    }

    public function findAll()
    {
        $query = (new RoomClassQuery())->hydrateSchemaQuery($this->queryParams());
        $response = $this->service->findAll($query);
        return new RoomClassCollection($response->getData(), $response->getStatus(), $response->getMessage());
    }

    public function findByID($id)
    {
        $response = $this->service->findByID($id);
        return new RoomClassResource($response->getData(), $response->getStatus(), $response->getMessage());
    }

    public function update($id)
    {
        $schema = (new RoomClassSchema())->hydrateSchemaBody($this->jsonBody());
        $response = $this->service->update($id, $schema);
        return APIResponse::fromService($response);
    }

    public function delete($id)
    {
        $response = $this->service->delete($id);
        return APIResponse::fromService($response);
    }
}
