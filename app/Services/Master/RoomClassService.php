<?php

namespace App\Services\Master;

use App\Commons\Libs\Http\ServiceResponse;
use App\Interfaces\Master\RoomClassInterface;
use App\Models\RoomClass;
use App\Schemas\Master\RoomClass\RoomClassQuery;
use App\Schemas\Master\RoomClass\RoomClassSchema;

class RoomClassService implements RoomClassInterface
{
    public function findAll(RoomClassQuery $queryParams): ServiceResponse
    {
        try {
            $queryParams->hydrateQuery();
            $query = RoomClass::with([])
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
            return ServiceResponse::statusOK("successfully get room classes", $data);
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function findByID($id): ServiceResponse
    {
        try {
            $roomClass = RoomClass::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$roomClass) {
                return ServiceResponse::notFound("room class not found");
            }
            return ServiceResponse::statusOK("successfully get room class", $roomClass);
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function create(RoomClassSchema $schema): ServiceResponse
    {
        try {
            $validator = $schema->validate();
            if ($validator->fails()) {
                return ServiceResponse::unprocessableEntity($validator->errors()->toArray());
            }
            $schema->hydrateBody();

            $data = [
                'name' => $schema->getName(),
            ];

            RoomClass::create($data);
            return ServiceResponse::statusCreated("successfully create room class");
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function update($id, RoomClassSchema $schema): ServiceResponse
    {
        try {
            $validator = $schema->validate();
            if ($validator->fails()) {
                return ServiceResponse::unprocessableEntity($validator->errors()->toArray());
            }
            $schema->hydrateBody();

            $roomClass = RoomClass::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$roomClass) {
                return ServiceResponse::notFound("room class not found");
            }

            $data = [
                'name' => $schema->getName(),
            ];

            $roomClass->update($data);
            return ServiceResponse::statusOK("successfully update room class");
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function delete($id): ServiceResponse
    {
        try {
            $roomClass = RoomClass::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$roomClass) {
                return ServiceResponse::notFound("room class not found");
            }

            $roomClass->delete();
            return ServiceResponse::statusOK("successfully delete room class");
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }
}
