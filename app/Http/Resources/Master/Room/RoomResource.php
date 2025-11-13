<?php

namespace App\Http\Resources\Master\Room;

use App\Commons\Libs\Resource\BaseResource;
use Illuminate\Http\Request;

class RoomResource extends BaseResource
{
    protected function transformData(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'floor' => $this->floor,
            'gender' => $this->gender,
            'is_isolation' => $this->is_isolation,
            'is_active' => $this->is_active,
            'description' => $this->description,
        ];

        if ($this->relationLoaded('hospital_unit')) {
            $unit = $this->getRelation('hospital_unit');
            $data['unit'] = $unit ? [
                'id' => $unit->id,
                'code' => $unit->code,
                'name' => $unit->name,
            ] : null;
        }

        if ($this->relationLoaded('room_class')) {
            $roomClass = $this->getRelation('room_class');
            $data['room_class'] = $roomClass ? [
                'id' => $roomClass->id,
                'name' => $roomClass->name,
            ] : null;
        }

        return $data;
    }
}
