<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Kozz\Laravel\Facades\Guzzle;

class API extends Controller
{
  //<!-- Get All Restaurants -->//
  function getRestaurants(Request $request){
    $restaurants = DB::table('restaurants')->get();
    return response()->json(['restaurants' => $restaurants ]);
  }

  //<!-- Get Restaurants Meals -->//
  function getRestaurantMeals(Request $request, $restaurant_id){

    $categories = DB::table('meal_categories')->where('restaurant_id', '=', $restaurant_id)->get();

    foreach ($categories as $category) {

       $meals = DB::table('meals')->where('category_id', '=', $category->id)->get();

       $category->meals = $meals;
    }

    return $categories;
  }

}
