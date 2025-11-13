<?php

namespace App\Http\Resources\Master\RoomClass;

use App\Commons\Libs\Resource\BaseResource;
use Illuminate\Http\Request;

class RoomClassResource extends BaseResource
{
    protected function transformData(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
        ];

        return $data;
    }
}
