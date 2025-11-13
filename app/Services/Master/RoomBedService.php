<?php

namespace App\Services\Master;

use App\Commons\Libs\Http\ServiceResponse;
use App\Interfaces\Master\RoomBedInterface;
use App\Models\RoomBed;
use App\Schemas\Master\RoomBed\RoomBedQuery;
use App\Schemas\Master\RoomBed\RoomBedSchema;

class RoomBedService implements RoomBedInterface
{
    public function findAll(RoomBedQuery $queryParams): ServiceResponse
    {
        try {
            $queryParams->hydrateQuery();
            $query = RoomBed::with(['room'])
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
            return ServiceResponse::statusOK("successfully get room beds", $data);
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function findByID($id): ServiceResponse
    {
        try {
            $roomBed = RoomBed::with(['room'])
                ->where('id', '=', $id)
                ->first();
            if (!$roomBed) {
                return ServiceResponse::notFound("room bed not found");
            }
            return ServiceResponse::statusOK("successfully get room bed", $roomBed);
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function create(RoomBedSchema $schema): ServiceResponse
    {
        try {
            $validator = $schema->validate();
            if ($validator->fails()) {
                return ServiceResponse::unprocessableEntity($validator->errors()->toArray());
            }
            $schema->hydrateBody();

            $data = [
                'room_id' => $schema->getRoomId(),
                'code' => $schema->getCode(),
                'name' => $schema->getName(),
                'status' => $schema->getStatus(),
                'description' => $schema->getDescription(),
            ];

            RoomBed::create($data);
            return ServiceResponse::statusCreated("successfully create room bed");
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function update($id, RoomBedSchema $schema): ServiceResponse
    {
        try {
            $validator = $schema->validate();
            if ($validator->fails()) {
                return ServiceResponse::unprocessableEntity($validator->errors()->toArray());
            }
            $schema->hydrateBody();

            $roomBed = RoomBed::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$roomBed) {
                return ServiceResponse::notFound("room bed not found");
            }

            $data = [
                'room_id' => $schema->getRoomId(),
                'code' => $schema->getCode(),
                'name' => $schema->getName(),
                'status' => $schema->getStatus(),
                'description' => $schema->getDescription(),
            ];

            $roomBed->update($data);

            return ServiceResponse::statusOK("successfully update room bed");
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function delete($id): ServiceResponse
    {
        try {
            $roomBed = RoomBed::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$roomBed) {
                return ServiceResponse::notFound("room bed not found");
            }

            $roomBed->delete();

            return ServiceResponse::statusOK("successfully delete room bed");
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }
}
