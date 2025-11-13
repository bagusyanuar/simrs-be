<?php

namespace App\Interfaces\Master;

use App\Commons\Libs\Http\ServiceResponse;
use App\Schemas\Master\RoomBed\RoomBedQuery;
use App\Schemas\Master\RoomBed\RoomBedSchema;

interface RoomBedInterface
{
    public function findAll(RoomBedQuery $queryParams): ServiceResponse;
    public function findByID($id): ServiceResponse;
    public function create(RoomBedSchema $schema): ServiceResponse;
    public function update($id, RoomBedSchema $schema): ServiceResponse;
    public function delete($id): ServiceResponse;
}
