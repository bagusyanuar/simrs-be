<?php

namespace App\Http\Resources\Master\RoomBed;

use App\Commons\Libs\Resource\BaseResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomBedResource extends BaseResource
{
    protected function transformData(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'status' => $this->status,
            'description' => $this->description,
        ];

        if ($this->relationLoaded('room')) {
            $room = $this->getRelation('room');
            $data['room'] = $room ? [
                'id' => $room->id,
                'code' => $room->code,
                'name' => $room->name,
            ] : null;
        }

        return $data;
    }
}
