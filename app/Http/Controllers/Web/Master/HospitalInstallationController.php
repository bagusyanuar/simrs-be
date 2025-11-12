<?php

namespace App\Http\Controllers\Web\Master;

use App\Commons\Libs\Http\APIResponse;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomController;
use App\Http\Resources\Master\HospitalInstallation\HospitalInstallationCollection;
use App\Http\Resources\Master\HospitalInstallation\HospitalInstallationResource;
use App\Schemas\Master\HospitalInstallation\HospitalInstallationQuery;
use App\Schemas\Master\HospitalInstallation\HospitalInstallationSchema;
use App\Services\Master\HospitalInstallationService;
use Illuminate\Http\Request;

class HospitalInstallationController extends CustomController
{
    /** @var HospitalInstallationService $service */
    private $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = new HospitalInstallationService();
    }

    public function create()
    {
        $schema = (new HospitalInstallationSchema())->hydrateSchemaBody($this->jsonBody());
        $response = $this->service->create($schema);
        return APIResponse::fromService($response);
    }

    public function findAll()
    {
        $query = (new HospitalInstallationQuery())->hydrateSchemaQuery($this->queryParams());
        $response = $this->service->findAll($query);
        return new HospitalInstallationCollection($response->getData(), $response->getStatus(), $response->getMessage());
    }

    public function findByID($id)
    {
        $response = $this->service->findByID($id);
        return new HospitalInstallationResource($response->getData(), $response->getStatus(), $response->getMessage());
    }

    public function update($id)
    {
        $schema = (new HospitalInstallationSchema())->hydrateSchemaBody($this->jsonBody());
        $response = $this->service->update($id, $schema);
        return APIResponse::fromService($response);
    }

    public function delete($id)
    {
        $response = $this->service->delete($id);
        return APIResponse::fromService($response);
    }
}
