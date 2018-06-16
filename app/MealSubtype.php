<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MealSubtype extends Model
{
    //
    protected $table = 'meal_subtype';
    public $timestamps = false;
    protected $fillable = ['meal_id','name','price'];

    public function meal(){
        return $this->belongsTo('App\Meal');
    }
}
