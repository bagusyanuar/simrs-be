<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalUnit extends Model
{
    use HasFactory, Uuid;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'hospital_installation_id',
        'name',
    ];

    public function hospital_installation()
    {
        return $this->hasMany(HospitalInstallation::class, 'hospital_installation_id');
    }
}
