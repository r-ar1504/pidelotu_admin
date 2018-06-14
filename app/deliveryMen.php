<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class deliveryMen extends Model
{
  protected $table = 'delivery_mens';
  protected $fillable = ['id', 'phone', 'active', 'created_at', 'updated_at', 'age', 'curp', 'address', 'gender', 'logo'];
}
