<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Corporation extends Model
{
    protected $fillable = ['name','name_kn','status'];

    public function zones()
    {
        return $this->hasMany(Zone::class);
    }

    public function constituencies()
    {
        return $this->hasMany(Constituency::class);
    }

    public function wards()
    {
        return $this->hasMany(Ward::class);
    }
}
