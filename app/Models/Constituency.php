<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Constituency extends Model
{
    protected $fillable = ['corporation_id','zone_id','name','name_kn','status'];

  public function corporation(){
    return $this->belongsTo(Corporation::class);
  }

  public function zone(){
    return $this->belongsTo(Zone::class);
  }
}
