<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalInstallation extends Model
{
    use HasFactory, Uuid;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
    ];

    public function hospital_units()
    {
        return $this->hasMany(HospitalUnit::class, 'hospital_installation_id');
    }
}
