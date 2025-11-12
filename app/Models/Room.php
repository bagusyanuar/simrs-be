<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'hospital_unit_id',
        'room_class_id',
        'code',
        'name',
        'floor',
        'gender',
        'is_isolation',
        'is_active',
        'description',
    ];

    protected $casts = [
        'is_isolation' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function hospital_unit()
    {
        return $this->belongsTo(HospitalUnit::class, 'hospital_unit_id');
    }

    public function room_class()
    {
        return $this->belongsTo(RoomClass::class, 'room_class_id');
    }
}
