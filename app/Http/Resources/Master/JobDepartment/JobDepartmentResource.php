<?php

namespace App\Http\Resources\Master\JobDepartment;

use App\Commons\Libs\Resource\BaseResource;
use Illuminate\Http\Request;

class JobDepartmentResource extends BaseResource
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
