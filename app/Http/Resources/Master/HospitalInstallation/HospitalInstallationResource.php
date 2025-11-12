<?php

namespace App\Http\Resources\Master\HospitalInstallation;

use App\Commons\Libs\Resource\BaseResource;
use Illuminate\Http\Request;

class HospitalInstallationResource extends BaseResource
{
    protected function transformData(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'type' => $this->type,
            'description' => $this->description,
        ];

        return $data;
    }
}
