<?php

namespace App\Http\Controllers\Web\Master;

use App\Commons\Libs\Http\APIResponse;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomController;
use App\Http\Resources\Master\Room\RoomCollection;
use App\Http\Resources\Master\Room\RoomResource;
use App\Schemas\Master\Room\RoomQuery;
use App\Schemas\Master\Room\RoomSchema;
use App\Services\Master\RoomService;
use Illuminate\Http\Request;

class RoomController extends CustomController
{
    /** @var RoomService $service */
    private $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = new RoomService();
    }

    public function create()
    {
        $schema = (new RoomSchema())->hydrateSchemaBody($this->jsonBody());
        $response = $this->service->create($schema);
        return APIResponse::fromService($response);
    }

    public function findAll()
    {
        $query = (new RoomQuery())->hydrateSchemaQuery($this->queryParams());
        $response = $this->service->findAll($query);
        return new RoomCollection($response->getData(), $response->getStatus(), $response->getMessage());
    }

    public function findByID($id)
    {
        $response = $this->service->findByID($id);
        return new RoomResource($response->getData(), $response->getStatus(), $response->getMessage());
    }

    public function update($id)
    {
        $schema = (new RoomSchema())->hydrateSchemaBody($this->jsonBody());
        $response = $this->service->update($id, $schema);
        return APIResponse::fromService($response);
    }

    public function delete($id)
    {
        $response = $this->service->delete($id);
        return APIResponse::fromService($response);
    }
}
