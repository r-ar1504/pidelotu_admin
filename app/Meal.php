<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
  protected $table = 'meals';
  public function restaurant(){
    return $this->belongsTo('App\MealCategory');
  }
}
