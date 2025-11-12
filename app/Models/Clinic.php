<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clinic extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'hospital_unit_id',
        'code',
        'name',
        'alias',
        # enum of clinic type
        'type',
        'bpjs_mapping_code',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function hospital_unit()
    {
        return $this->belongsTo(HospitalUnit::class, 'hospital_unit_id');
    }
}
