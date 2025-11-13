<?php

namespace App\Services\Master;

use App\Commons\Libs\Http\ServiceResponse;
use App\Interfaces\Master\JobPositionInterface;
use App\Models\JobPosition;
use App\Schemas\Master\JobPosition\JobPositionQuery;
use App\Schemas\Master\JobPosition\JobPositionSchema;

class JobPositionService implements JobPositionInterface
{
    public function findAll(JobPositionQuery $queryParams): ServiceResponse
    {
        try {
            $queryParams->hydrateQuery();
            $query = JobPosition::with([])
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
            return ServiceResponse::statusOK("successfully get job position", $data);
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function findByID($id): ServiceResponse
    {
        try {
            $jobPosition = JobPosition::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$jobPosition) {
                return ServiceResponse::notFound("job position not found");
            }
            return ServiceResponse::statusOK("successfully get job position", $jobPosition);
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function create(JobPositionSchema $schema): ServiceResponse
    {
        try {
            $validator = $schema->validate();
            if ($validator->fails()) {
                return ServiceResponse::unprocessableEntity($validator->errors()->toArray());
            }
            $schema->hydrateBody();

            $data = [
                'code' => $schema->getCode(),
                'name' => $schema->getName(),
                'is_medical' => $schema->isMedical(),
                'description' => $schema->getDescription(),
            ];

            JobPosition::create($data);
            return ServiceResponse::statusCreated("successfully create job position");
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function update($id, JobPositionSchema $schema): ServiceResponse
    {
        try {
            $validator = $schema->validate();
            if ($validator->fails()) {
                return ServiceResponse::unprocessableEntity($validator->errors()->toArray());
            }
            $schema->hydrateBody();

            $jobPosition = JobPosition::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$jobPosition) {
                return ServiceResponse::notFound("job position not found");
            }

            $data = [
                'code' => $schema->getCode(),
                'name' => $schema->getName(),
                'is_medical' => $schema->isMedical(),
                'description' => $schema->getDescription(),
            ];

            $jobPosition->update($data);

            return ServiceResponse::statusOK("successfully update job position");
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function delete($id): ServiceResponse
    {
        try {
            $jobPosition = JobPosition::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$jobPosition) {
                return ServiceResponse::notFound("job position not found");
            }

            $jobPosition->delete();

            return ServiceResponse::statusOK("successfully delete job position");
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }
}
