<?php

namespace App\Interfaces\Master;

use App\Commons\Libs\Http\ServiceResponse;
use App\Schemas\Master\Room\RoomQuery;
use App\Schemas\Master\Room\RoomSchema;

interface RoomInterface
{
    public function findAll(RoomQuery $queryParams): ServiceResponse;
    public function findByID($id): ServiceResponse;
    public function create(RoomSchema $schema): ServiceResponse;
    public function update($id, RoomSchema $schema): ServiceResponse;
    public function delete($id): ServiceResponse;
}
