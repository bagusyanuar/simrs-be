<?php

namespace App\Http\Controllers\Web\Master;

use App\Commons\Libs\Http\APIResponse;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomController;
use App\Http\Resources\Master\Clinic\ClinicCollection;
use App\Http\Resources\Master\Clinic\ClinicResource;
use App\Schemas\Master\Clinic\ClinicQuery;
use App\Schemas\Master\Clinic\ClinicSchema;
use App\Services\Master\ClinicService;
use Illuminate\Http\Request;

class ClinicController extends CustomController
{
    /** @var ClinicService $service */
    private $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = new ClinicService();
    }

    public function create()
    {
        $schema = (new ClinicSchema())->hydrateSchemaBody($this->jsonBody());
        $response = $this->service->create($schema);
        return APIResponse::fromService($response);
    }

    public function findAll()
    {
        $query = (new ClinicQuery())->hydrateSchemaQuery($this->queryParams());
        $response = $this->service->findAll($query);
        return new ClinicCollection($response->getData(), $response->getStatus(), $response->getMessage());
    }

    public function findByID($id)
    {
        $response = $this->service->findByID($id);
        return new ClinicResource($response->getData(), $response->getStatus(), $response->getMessage());
    }

    public function update($id)
    {
        $schema = (new ClinicSchema())->hydrateSchemaBody($this->jsonBody());
        $response = $this->service->update($id, $schema);
        return APIResponse::fromService($response);
    }

    public function delete($id)
    {
        $response = $this->service->delete($id);
        return APIResponse::fromService($response);
    }
}
