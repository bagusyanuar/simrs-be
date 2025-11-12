<?php

namespace App\Services\Master;

use App\Commons\Libs\Http\ServiceResponse;
use App\Interfaces\Master\HospitalUnitInterface;
use App\Models\HospitalUnit;
use App\Schemas\Master\HospitalUnit\HospitalUnitQuery;
use App\Schemas\Master\HospitalUnit\HospitalUnitSchema;

class HospitalUnitService implements HospitalUnitInterface
{
    public function findAll(HospitalUnitQuery $queryParams): ServiceResponse
    {
        try {
            $queryParams->hydrateQuery();
            $query = HospitalUnit::with(['hospital_installation'])
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
            return ServiceResponse::statusOK("successfully get hospital units", $data);
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function findByID($id): ServiceResponse
    {
        try {
            $hospitalUnit = HospitalUnit::with(['hospital_installation'])
                ->where('id', '=', $id)
                ->first();
            if (!$hospitalUnit) {
                return ServiceResponse::notFound("hospital unit not found");
            }
            return ServiceResponse::statusOK("successfully get hospital unit", $hospitalUnit);
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function create(HospitalUnitSchema $schema): ServiceResponse
    {
        try {
            $validator = $schema->validate();
            if ($validator->fails()) {
                return ServiceResponse::unprocessableEntity($validator->errors()->toArray());
            }
            $schema->hydrateBody();

            $data = [
                'hospital_installation_id' => $schema->getHospitalInstallationId(),
                'code' => $schema->getCode(),
                'name' => $schema->getName(),
                'description' => $schema->getDescription()
            ];

            HospitalUnit::create($data);
            return ServiceResponse::statusCreated("successfully create hospital unit");
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function update($id, HospitalUnitSchema $schema): ServiceResponse
    {
        try {
            $validator = $schema->validate();
            if ($validator->fails()) {
                return ServiceResponse::unprocessableEntity($validator->errors()->toArray());
            }
            $schema->hydrateBody();

            $hospitalUnit = HospitalUnit::with(['hospital_installation'])
                ->where('id', '=', $id)
                ->first();
            if (!$hospitalUnit) {
                return ServiceResponse::notFound("hospital unit not found");
            }

            $data = [
                'hospital_installation_id' => $schema->getHospitalInstallationId(),
                'code' => $schema->getCode(),
                'name' => $schema->getName(),
                'description' => $schema->getDescription()
            ];

            $hospitalUnit->update($data);

            return ServiceResponse::statusOK("successfully update hospital unit");
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function delete($id): ServiceResponse
    {
        try {
            $hospitalUnit = HospitalUnit::with(['hospital_installation'])
                ->where('id', '=', $id)
                ->first();
            if (!$hospitalUnit) {
                return ServiceResponse::notFound("hospital unit not found");
            }
            $hospitalUnit->delete();
            return ServiceResponse::statusOK("successfully delete hospital unit");
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }
}
