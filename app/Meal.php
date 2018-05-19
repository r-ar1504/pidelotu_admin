<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
   /*Meal Belongs To Category*/
   public function category(){
     return $this->BelongsTo('App\MealCategory');
   }
   /*Has Many Ingredients*/
   public function ingredients(){
     return $this->hasMany('App\Ingredient');
   }
}
