<?php

namespace App\Services\Master;

use App\Commons\Libs\Http\ServiceResponse;
use App\Interfaces\Master\RoomInterface;
use App\Models\Room;
use App\Schemas\Master\Room\RoomQuery;
use App\Schemas\Master\Room\RoomSchema;

class RoomService implements RoomInterface
{
    public function findAll(RoomQuery $queryParams): ServiceResponse
    {
        try {
            $queryParams->hydrateQuery();
            $query = Room::with(['hospital_unit', 'room_class', 'beds'])
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
            return ServiceResponse::statusOK("successfully get rooms", $data);
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function findByID($id): ServiceResponse
    {
        try {
            $room = Room::with(['hospital_unit', 'room_class', 'beds'])
                ->where('id', '=', $id)
                ->first();
            if (!$room) {
                return ServiceResponse::notFound("room not found");
            }
            return ServiceResponse::statusOK("successfully get room", $room);
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function create(RoomSchema $schema): ServiceResponse
    {
        try {
            $validator = $schema->validate();
            if ($validator->fails()) {
                return ServiceResponse::unprocessableEntity($validator->errors()->toArray());
            }
            $schema->hydrateBody();

            $data = [
                'hospital_unit_id' => $schema->getHospitalUnitId(),
                'room_class_id' => $schema->getRoomClassId(),
                'code' => $schema->getCode(),
                'name' => $schema->getName(),
                'floor' => $schema->getFloor(),
                'gender' => $schema->getGender(),
                'is_isolation' => $schema->isIsolation(),
                'is_active' => $schema->isActive(),
                'description' => $schema->getDescription(),
            ];

            Room::create($data);
            return ServiceResponse::statusCreated("successfully create room");
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function update($id, RoomSchema $schema): ServiceResponse
    {
        try {
            $validator = $schema->validate();
            if ($validator->fails()) {
                return ServiceResponse::unprocessableEntity($validator->errors()->toArray());
            }
            $schema->hydrateBody();

            $room = Room::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$room) {
                return ServiceResponse::notFound("room not found");
            }

            $data = [
                'hospital_unit_id' => $schema->getHospitalUnitId(),
                'room_class_id' => $schema->getRoomClassId(),
                'code' => $schema->getCode(),
                'name' => $schema->getName(),
                'floor' => $schema->getFloor(),
                'gender' => $schema->getGender(),
                'is_isolation' => $schema->isIsolation(),
                'is_active' => $schema->isActive(),
                'description' => $schema->getDescription(),
            ];

            $room->update($data);

            return ServiceResponse::statusOK("successfully update room");
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }

    public function delete($id): ServiceResponse
    {
        try {
            $room = Room::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$room) {
                return ServiceResponse::notFound("room not found");
            }

            $room->delete();

            return ServiceResponse::statusOK("successfully delete room");
        } catch (\Throwable $th) {
            return ServiceResponse::internalServerError($th->getMessage());
        }
    }
}
