<?php

namespace App\Services\Master;

use App\Commons\Libs\Http\ServiceResponse;
use App\Interfaces\Master\ClinicInterface;
use App\Models\Clinic;
use App\Schemas\Master\Clinic\ClinicQuery;
use App\Schemas\Master\Clinic\ClinicSchema;

class ClinicService implements ClinicInterface
{
    public function findAll(ClinicQuery $queryParams): ServiceResponse
    {
        try {
            $queryParams->hydrateQuery();
            $query = Clinic::with(['hospital_unit'])
                ->when($queryParams->getParam(), function ($q) use ($queryParams) {
                    /** @var Builder $q */
                    return $q->where('name', 'LIKE', "%{$queryParams->getParam()}%");
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
            return ServiceResponse::statusOK("successfully get clinics", $data);
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function findByID($id): ServiceResponse
    {
        try {
            $clinic = Clinic::with(['hospital_unit'])
                ->where('id', '=', $id)
                ->first();
            if (!$clinic) {
                return ServiceResponse::notFound("clinic not found");
            }
            return ServiceResponse::statusOK("successfully get clinic", $clinic);
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function create(ClinicSchema $schema): ServiceResponse
    {
        try {
            $validator = $schema->validate();
            if ($validator->fails()) {
                return ServiceResponse::unprocessableEntity($validator->errors()->toArray());
            }
            $schema->hydrateBody();

            $data = [
                'hospital_unit_id' => $schema->getHospitalUnitId(),
                'code' => $schema->getCode(),
                'name' => $schema->getName(),
                'alias' => $schema->getAlias(),
                'type' => $schema->getType(),
                'bpjs_mapping_code' => $schema->getBpjsMappingCode(),
                'is_active' => $schema->isActive(),
            ];

            Clinic::create($data);
            return ServiceResponse::statusCreated("successfully create clinic");
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function update($id, ClinicSchema $schema): ServiceResponse
    {
        try {
            $validator = $schema->validate();
            if ($validator->fails()) {
                return ServiceResponse::unprocessableEntity($validator->errors()->toArray());
            }
            $schema->hydrateBody();

            $clinic = Clinic::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$clinic) {
                return ServiceResponse::notFound("clinic not found");
            }

            $data = [
                'hospital_unit_id' => $schema->getHospitalUnitId(),
                'code' => $schema->getCode(),
                'name' => $schema->getName(),
                'alias' => $schema->getAlias(),
                'type' => $schema->getType(),
                'bpjs_mapping_code' => $schema->getBpjsMappingCode(),
                'is_active' => $schema->isActive(),
            ];

            $clinic->update($data);

            return ServiceResponse::statusOK("successfully update clinic");
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function delete($id): ServiceResponse
    {
        try {
            $clinic = Clinic::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$clinic) {
                return ServiceResponse::notFound("clinic not found");
            }

            $clinic->delete();
            return ServiceResponse::statusOK("successfully delete clinic");
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }
}
