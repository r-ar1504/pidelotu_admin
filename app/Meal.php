<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
  public function restaurant(){
    return $this->belongsTo('App\MealCategory');
  }
}
