<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
  protected $fillable = array('name', 'address', 'details');

  public function categories(){
    return $this->hasMany('App\MealCategory');
  }
}
