<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MealCategory extends Model
{
   /*Category Belongs To Restaurant*/
   public function restaurant(){
     return $this->belongsTo('App\Restaurant');
   }
   /*Has Many Meals*/
   public function meals(){
     return $this->hasMany('App\Meal','category_id');
   }
}
