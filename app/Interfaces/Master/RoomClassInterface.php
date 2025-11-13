<?php

namespace App\Interfaces\Master;

use App\Commons\Libs\Http\ServiceResponse;
use App\Schemas\Master\RoomClass\RoomClassQuery;
use App\Schemas\Master\RoomClass\RoomClassSchema;

interface RoomClassInterface
{
    public function findAll(RoomClassQuery $queryParams): ServiceResponse;
    public function findByID($id): ServiceResponse;
    public function create(RoomClassSchema $schema): ServiceResponse;
    public function update($id, RoomClassSchema $schema): ServiceResponse;
    public function delete($id): ServiceResponse;
}
