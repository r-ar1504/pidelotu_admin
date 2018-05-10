<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MealCategory extends Model
{
  protected $fillable = array('name', 'dashboard_banner', 'image', 'restaurant_id');
  protected $table = 'meal_categories';
  /*Category Belongs To Restaurant*/
  public function restaurant(){
    return $this->belongsTo('App\Restaurant');
  }
  /*Has Many Meals*/
  public function meals(){
    return $this->hasMany('App\Meal');
  }
}
