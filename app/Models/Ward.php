<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
  protected $fillable = ['corporation_id','zone_id','constituency_id','name','name_kn','status','number'];

  public function corporation(){
    return $this->belongsTo(Corporation::class);
  }

  public function zone(){
    return $this->belongsTo(Zone::class);
  }

  public function constituency(){
    return $this->belongsTo(Constituency::class);
  }
}
