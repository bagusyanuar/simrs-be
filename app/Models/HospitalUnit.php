<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HospitalUnit extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'hospital_installation_id',
        'code',
        'name',
        'description',
    ];

    public function hospital_installation()
    {
        return $this->belongsTo(HospitalInstallation::class, 'hospital_installation_id');
    }
}
