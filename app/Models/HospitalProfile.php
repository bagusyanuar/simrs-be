<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalProfile extends Model
{
    use HasFactory, Uuid;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'code',
        'name',
        'short_name',
        'hospital_class',
        'hospital_type',
        'hospital_ownership',
        'director',
        'license_number',
        'license_issued_date',
        'address',
        'province_name',
        'city_name',
        'district_name',
        'village_name',
        'postal_code',
        'email',
        'phone',
        'bpjs_code',
        'kemenkes_code',
    ];
}
