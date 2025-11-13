<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'job_position_id',
        'job_department_id',
        'employee_number',
        'full_name',
        'birth_date',
        'gender',
        'email',
        'phone',
        'address',
        'join_date',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function job_position()
    {
        return $this->belongsTo(JobPosition::class, 'job_position_id');
    }

    public function job_department()
    {
        return $this->belongsTo(JobDepartment::class, 'job_department_id');
    }
}
