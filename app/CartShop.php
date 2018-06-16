<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartShop extends Model
{
    //
    public $timestamps = false;
    protected $table = 'cart';
    protected $fillable = ['user_id','meal_id','sub_type_id','quantity','total','ingredients'];
}
