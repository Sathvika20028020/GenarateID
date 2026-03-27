<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = ['corporation_id','name','name_kn','status'];

    public function corporation(){
      return $this->belongsTo(Corporation::class);
    }
}
