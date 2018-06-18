<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
  protected $table = 'meal_categories'; 
  protected $fillable = ['name','image','dashboard_banner','restaurant_id','created_at', 'updated_at', 'active' ];
}
