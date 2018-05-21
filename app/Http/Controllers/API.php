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

  function requestDelivery(){
    $client = new \GuzzleHttp\Client();

    $result = $client->post('https:/onesignal.com/api/v1/notifications', [
      "headers" => [
        "Content-Type" => "application/json; charset=utf-8",
        "Authorization" => "Basic ZjVmODBlZGYtNTdkOC00N2ZmLThkMjEtNzBjM2ZlN2FjNDlh"
      ],
      "json" =>[
        "app_id" => "643b522d-743e-4c85-aa8f-ff6fcc5a08b1",
        "filters" =>  array(array("field" => "tag","key" => "fireID", "relation" => "=", "value" => "FIREid")),
        "data" => array(
          "order" => "order_data"),
        "contents" => array("en" => "Nueva Orden"),
        "headings" => array("en" => "Pedido Entrante")
      ]
    ])->getBody()->getContents();

    return response()->json(['what is ' => $result]);
  }

}
