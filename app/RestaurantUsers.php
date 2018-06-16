<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantUsers extends Model
{
  protected $fillable = ['id', 'username', 'email', 'password', 'created_at', 'updated_at', 'role', 'remember_token'];
}
