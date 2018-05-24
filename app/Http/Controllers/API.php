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

  //<!-- Send Notification To Delivery Man -->//
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
        "data" => array(['id' => $id, 'user_lat' => $order->latitude, 'user_lng' => $order->longitude,'res_lat' => 25.524224, 'res_lng' => -103.415248, ]),
        "contents" => array("en" => "Nueva Orden"),
        "headings" => array("en" => "Pedido Entrante")
      ]
    ])->getBody()->getContents();

    return response()->json(['what is ' => $result]);
  }

  //<!-- Update Delivery Position -->//
  function updateLocation(Request $request, $order_id){ 
    $data = $request->all();
    try{
      $order = DB::table('orders')->where('id', '=', $order_id)->update(['delivery_longitude' => $data['latitude'], 'delivery_latitude' => $data['longitude']]);
    }catch(Exception $e){
      return response()->json([ 'code' => '500', 'error' => $e ]);
    }
    return response()->json(['code' => '200', 'message' => 'sucess', 'request_data' => $data]);
  }

  //<!-- Fetch Delivery Position -->//
  function getDeliveryLocation(Request $request, $order_id){
    $data = $request->all();
    try{
      $order = DB::table('orders')->where('id', '=', $order_id)->get();
      $coords = [ ];
      array_push($coords, $order->delivery_location, $order->delivery_longitude);
    }catch(Exception $e){
      return response()->json([ 'code' => '500', 'error' => $e ]);
    }
    return response()->json(['code' => '200', 'message' => 'sucess', 'request_data' => $data, 'response_data' => $coords]);
  }

}
