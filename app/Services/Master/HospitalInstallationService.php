<?php

namespace App\Services\Master;

use App\Commons\Libs\Http\ServiceResponse;
use App\Interfaces\Master\HospitalInstallationInterface;
use App\Models\HospitalInstallation;
use App\Schemas\Master\HospitalInstallation\HospitalInstallationQuery;
use App\Schemas\Master\HospitalInstallation\HospitalInstallationSchema;

class HospitalInstallationService implements HospitalInstallationInterface
{
    public function findAll(HospitalInstallationQuery $queryParams): ServiceResponse
    {
        try {
            $queryParams->hydrateQuery();
            $query = HospitalInstallation::with([])
                ->when($queryParams->getParam(), function ($q) use ($queryParams) {
                    /** @var Builder $q */
                    return $q->where('name', 'LIKE', "%{$queryParams->getParam()}%")
                        ->orWhere('code', 'LIKE', "%{$queryParams->getParam()}%");
                })
                ->orderBy('name', 'ASC');
            if ($queryParams->getPage() && $queryParams->getPerPage()) {
                $data = $query->paginate(
                    $queryParams->getPerPage(),
                    ['*'],
                    'page',
                    $queryParams->getPage()
                );
            } else {
                $data = $query->get();
            }
            return ServiceResponse::statusOK("successfully get hospital installations", $data);
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function findByID($id): ServiceResponse
    {
        try {
            $hospitalInstallation = HospitalInstallation::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$hospitalInstallation) {
                return ServiceResponse::notFound("hospital installation not found");
            }
            return ServiceResponse::statusOK("successfully get hospital installation", $hospitalInstallation);
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }


    /**
     * Create a new hospital installation.
     *
     * Accepts a HospitalInstallationSchema containing validated input data, applies
     * any business rules, persists a new hospital installation record and performs
     * related side-effects (events, logging, cache invalidation, etc.).
     *
     * @param HospitalInstallationSchema $schema The schema object encapsulating the data required to create the installation.
     * @return ServiceResponse A ServiceResponse describing the outcome, including success/failure status and any created resource identifiers or messages.
     * @throws \InvalidArgumentException If the provided schema is invalid or missing required fields.
     * @throws \RuntimeException If the creation fails due to persistence, integrity, or other runtime errors.
     */
    public function create(HospitalInstallationSchema $schema): ServiceResponse
    {
        try {
            $validator = $schema->validate();
            if ($validator->fails()) {
                return ServiceResponse::unprocessableEntity($validator->errors()->toArray());
            }
            $schema->hydrateBody();

            $data = [
                'name' => $schema->getName(),
                'code' => $schema->getCode(),
                'type' => $schema->getType(),
                'description' => $schema->getDescription()
            ];

            HospitalInstallation::create($data);
            return ServiceResponse::statusCreated("successfully create hospital installation");
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function update($id, HospitalInstallationSchema $schema): ServiceResponse
    {
        try {
            $validator = $schema->validate();
            if ($validator->fails()) {
                return ServiceResponse::unprocessableEntity($validator->errors()->toArray());
            }
            $schema->hydrateBody();

            $hospitalInstallation = HospitalInstallation::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$hospitalInstallation) {
                return ServiceResponse::notFound("hospital installation not found");
            }

            $data = [
                'name' => $schema->getName(),
                'code' => $schema->getCode(),
                'type' => $schema->getType(),
                'description' => $schema->getDescription()
            ];

            $hospitalInstallation->update($data);
            return ServiceResponse::statusOK("successfully update hospital installation");
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function delete($id): ServiceResponse
    {
        try {
            $hospitalInstallation = HospitalInstallation::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$hospitalInstallation) {
                return ServiceResponse::notFound("hospital installation not found");
            }

            $hospitalInstallation->delete();
            return ServiceResponse::statusOK("successfully delete hospital installation");
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }
}
