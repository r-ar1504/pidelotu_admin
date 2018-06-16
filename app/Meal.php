<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
   /*Meal Belongs To Category*/
   public function category(){
    return $this->belongsTo('App\MealCategory');
  }
  /*Has Many Ingredients*/
  public function ingredients(){
    return $this->hasMany('App\Ingredient');
  }
  /* Has Many Subtypes */
  public function subtype(){
    return $this->hasMany('App\MealSubtype');
  }
}
