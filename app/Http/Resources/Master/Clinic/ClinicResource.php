<?php

namespace App\Http\Resources\Master\Clinic;

use App\Commons\Libs\Resource\BaseResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClinicResource extends BaseResource
{
   protected function transformData(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'alias' => $this->alias,
            'type' => $this->type,
            'bpjs_mapping_code' => $this->bpjs_mapping_code,
            'is_active' => $this->is_active,
        ];

        if ($this->relationLoaded('hospital_unit')) {
            $unit = $this->getRelation('hospital_unit');
            $data['unit'] = $unit ? [
                'id' => $unit->id,
                'code' => $unit->code,
                'name' => $unit->name,
            ] : null;
        }

        return $data;
    }
}
