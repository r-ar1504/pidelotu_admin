<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';    
    public $timestamps = false;
    protected $fillable = ['created_at','restaurant_id','meal_category_id','meal_id','delivery_man_id','user_id','total','latitude','longitude' ];

    public function category(){
        return $this->hasOne('App\MealCategory','meal_category_id');
    }

    public function meal(){
        return $this->hasOne('App\Meal','meal_id');
    }
}
