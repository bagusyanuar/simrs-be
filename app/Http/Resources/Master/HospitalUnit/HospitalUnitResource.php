<?php

namespace App\Http\Resources\Master\HospitalUnit;

use App\Commons\Libs\Resource\BaseResource;
use Illuminate\Http\Request;

class HospitalUnitResource extends BaseResource
{
    protected function transformData(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
        ];

        if ($this->relationLoaded('hospital_installation')) {
            $installation = $this->getRelation('hospital_installation');
            $data['installation'] = $installation ? [
                'id' => $installation->id,
                'code' => $installation->code,
                'name' => $installation->name,
            ] : null;
        }

        return $data;
    }
}
