<?php

namespace App\Http\Resources\Master\JobPosition;

use App\Commons\Libs\Resource\BaseResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobPositionResource extends BaseResource
{
    protected function transformData(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'is_medical' => $this->is_medical,
            'description' => $this->description,
        ];

        return $data;
    }
}
