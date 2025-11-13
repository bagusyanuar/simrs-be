<?php

namespace App\Services\Master;

use App\Commons\Libs\Http\ServiceResponse;
use App\Interfaces\Master\JobDepartmentInterface;
use App\Models\JobDepartment;
use App\Schemas\Master\JobDepartment\JobDepartmentQuery;
use App\Schemas\Master\JobDepartment\JobDepartmentSchema;

class JobDepartmentService implements JobDepartmentInterface
{
    public function findAll(JobDepartmentQuery $queryParams): ServiceResponse
    {
        try {
            $queryParams->hydrateQuery();
            $query = JobDepartment::with([])
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
            return ServiceResponse::statusOK("successfully get job department", $data);
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function findByID($id): ServiceResponse
    {
         try {
            $jobDepartment = JobDepartment::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$jobDepartment) {
                return ServiceResponse::notFound("job department not found");
            }
            return ServiceResponse::statusOK("successfully get job department", $jobDepartment);
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function create(JobDepartmentSchema $schema): ServiceResponse
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

            JobDepartment::create($data);
            return ServiceResponse::statusCreated("successfully create job department");
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function update($id, JobDepartmentSchema $schema): ServiceResponse
    {
        try {
            $validator = $schema->validate();
            if ($validator->fails()) {
                return ServiceResponse::unprocessableEntity($validator->errors()->toArray());
            }
            $schema->hydrateBody();

            $jobDepartment = JobDepartment::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$jobDepartment) {
                return ServiceResponse::notFound("job department not found");
            }

            $data = [
                'code' => $schema->getCode(),
                'name' => $schema->getName(),
                'is_medical' => $schema->isMedical(),
                'description' => $schema->getDescription(),
            ];

            $jobDepartment->update($data);

            return ServiceResponse::statusOK("successfully update job department");
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function delete($id): ServiceResponse
    {
        try {
            $jobDepartment = JobDepartment::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$jobDepartment) {
                return ServiceResponse::notFound("job department not found");
            }

            $jobDepartment->delete();

            return ServiceResponse::statusOK("successfully delete job department");
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }
}
