<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomRate extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'room_id',
        'tariff_code',
        'name',
        'price_per_day',
        'insurance_type',
        'description',
        'is_active',
    ];

    protected $casts = [
        'price_per_day' => 'float',
        'is_active' => 'boolean'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
