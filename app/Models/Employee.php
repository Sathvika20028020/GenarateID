<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'emp_id',
        'department_id',
        'designation_id',
        'phone',
        'address',
        'blood_group',
        'valid_upto',
        'image',
        'corporation_id',
        'zone_id',
        'ward_id',
        'status',
    ];

    protected $casts = [
        'valid_upto' => 'date',
        'status' => 'boolean',
    ];

    public function department(){
      return $this->belongsTo(Department::class);
    }
    public function designation(){
      return $this->belongsTo(Designation::class);
    }
    public function corporation(){
      return $this->belongsTo(Corporation::class);
    }
    public function zone(){
      return $this->belongsTo(Zone::class);
    }
    public function ward(){
      return $this->belongsTo(Ward::class);
    }
}
