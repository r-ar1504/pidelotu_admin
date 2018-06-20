<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

use Kozz\Laravel\Facades\Guzzle;

/** Models **/
use App\MealSubtype as Subtype;
use \App\Payment as Payment;
use \App\Order as Order;
use \App\MealCategory as MealCategory;
use \App\Meal as Meal;
use \App\CartShop as Cart;
use \App\User as User;
use \App\Restaurant as Restaurant;
/** **/


class API extends Controller
{
  /** Restaurant **/  
  function getRestaurants(Request $request){
    $restaurants = DB::table('restaurants')->get();

    foreach( $restaurants as $restaurant){
      $main_foods = [ ];
      /* return response()->json(['restaurant' => $restaurant->id ]); */
      $category = DB::table('meal_categories')->where('restaurant_id','=',$restaurant->id)->first();
      /* return response()->json(['restaurants' => $category->id]); */
      /* return response()->json(['dump'=> var_dump($category->id)]); */
      $meals = DB::table('meals')->where('category_id', "=", $category->id)->get();
      foreach( $meals as $meal){
        array_push($main_foods, $meal->image);
      }
      $restaurant->meals = $main_foods;
    }

    return response()->json(['restaurants' => $restaurants ]);
  }   
  

  function indexRestaurantMeals(Request $request, $restaurant_id){
    $categories = DB::table('meal_categories')->where('restaurant_id', '=', $restaurant_id)->get();
    foreach ($categories as $category) {      
      $meals = DB::table('meals')->where('category_id', '=', $category->id)->get();      
      foreach ($meals as $meal) {      
        if ($meal->has_subtype != 0) {          
          $sub_types = DB::table('meal_subtype')->where('meal_id', '=', $meal->id)->get();
          $meal->sub_type = $sub_types;   
        }
        if ($meal->has_ingredients) {
          $ingredients = DB::table('ingredients')->where('meal_id','=',$meal->id)->get();
          $meal->ingredients = $ingredients;
        }
      }
      $category->meals = $meals;   
    }
    return $categories;
  }
  
  /** **/
  /** Meals **/
  public function indexMeals($filter,$meal)
   {
     switch ($filter) {
       case 'restaurants':
          return Restaurant::where('name','like','%'.$meal.'%')->get();
        break;
       case 'food':          
          return Meal::select('meals.id as id','category_id','description','preparation_time','meals.name as name','meals.image as image','price','restaurant_id','logo','restaurants.name as restaurant')->join('meal_categories','meal_categories.id','=','meals.category_id')->join('restaurants','restaurants.id','=','meal_categories.restaurant_id')->where('meals.name','like','%'.$meal.'%')->get();         
        break;
      case 'world':
          return MealCategory::join('restaurants','restaurants.id','=','meal_categories.restaurant_id')->where('meal_categories.name','like','%'.$meal.'%')->get();
          break;
       default:
         # code...
         break;
     }
   }
   /** **/

  /** Delivery **/
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
  /** **/
  /** Payment **/
  function storePaymentMethod(Request $request){
    try {
      Payment::create($request->all());
      return response()->json(['message' => 'success'],201);    }
    catch (Exception $ex) {
      return response()->json(['error' => $ex->message],404);
    }
  }
  /** **/
  /** Cart **/
  function indexCart($userId) {
    $cartshop = Cart::where('user_id','=',$userId)->get();    
    $data = ['carshop' => [],'payments' => Payment::where('user_id','=',$userId)->get(), 'subtotal' => 0];      
    foreach ($cartshop as $item) {
      $item->meal = Meal::find($item['meal_id']);
      array_push($data['carshop'],['id' => $item['id'],'meal_id' => $item['meal_id'],'sub_type' => $item['sub_type_id'] , 'quantity' => $item['quantity'], 'description' => $item['meal']->description, 'ingredients' => $item['ingredients'], 'total' => $item['total']]);               
      $data['subtotal'] = $data['subtotal'] + ($item['total'] * $item['quantity']);
    }               
    return $data;
  }

  function storeCart(Request $request) {
    try {
      Cart::create($request->all());
      return response()->json(['message' => 'success', 201]);
    }
    catch(Exception $ex) {
      return response()->json(['error' => $ex->message, 404]);
    }
  }

  function destroyCart($id,$userId) {
    try {
      if (User::where('firebase_id','=',$userId)->count() > 0) {
        $item = Cart::find($id);
        if($item->delete()){
          return Response::json(array("status" => "201", "messages" => "Success"));
        }
        return Response::json(array("status" => "401", "messages" => "Not Authorized"));
      }            
    }
    catch (Exception $ex) {
      return Response::json(array("status" => "500", "messages" => $ex));
    }
  }
  /** **/
  /** Order **/
 function indexOrder($user_id){
    try {
      $orders = DB::table('orders')->select('meal_id as id','meal_category_id as category_id','preparation_time','restaurant_id','restaurants.name as restaurant','meals.name as name','orders.created_at as date','orders.id as order_id','meals.image as image','description','price','total','status')->join('restaurants','restaurant_id','=','restaurants.id')->join('meals','meal_id','=','meals.id')->where('user_id','=',$user_id)->get();
 
      return $orders;
    }
    catch(Exception $ex) {
      return response()->json($ex->message);
    }
   }
  
  function storeOrder(Request $request) {
    /** Get the token with $request['token'] **/
    try {            
      $restaurants_orders = array();
      foreach ($request['cartShop'] as $key => $item) {
          $restaurant = Meal::select('restaurant_id as id')->join('meal_categories','category_id','=','meal_categories.id')->where('meals.id','=',$item['meal_id'])->first();

          if(!array_key_exists($restaurant->id,$restaurants_orders)) {
            $restaurants_orders[$restaurant->id] = [];
          }                    
          array_push($restaurants_orders[$restaurant->id],$item);                    
      }           

      foreach ($restaurants_orders as $llave => $value) {       
        $id = Order::create([
          'user_id' => $request['user_id'],
          'latitude' => $request['latitude'],
          'longitude' => $request['longitude'],
          'restaurant_id' => $llave
        ])->id;

        foreach ($value as $index => $item) {
          \DB::table('orders_items')->insert([
            'meal_id' => $item['meal_id'],
            'meal_subtype_id' => $item['sub_type'],
            'ingredients' => $item['ingredients'],
            'quantity' => $item['quantity'],
            'total' => $item['total'],
            'order_id' => $id
          ]);
        }        
      }
      
      \DB::table('cart')->where('user_id','=',$request['user_id'])->delete();

/*       $client = new \GuzzleHttp\Client();

      $result = $client->post('https:/onesignal.com/api/v1/notifications', [
        "headers" => [
          "Content-Type" => "application/json; charset=utf-8",
          "Authorization" => "Basic NThlYzVhZTAtNTI5OC00ODJmLTk3NDItMzI0NWNiN2ZkYzM0"
        ],
        "json" =>[
          "app_id" => "baedd007-9325-4e3e-83fc-d8be136450bd",
          "contents" => array("en" => "Nueva Orden"),
          "headings" => array("en" => "Pedido Entrante")
        ]
      ])->getBody()->getContents(); */

      return response()->json(['message' => 'Tu pedido se ha procesado con éxito.'],201);
    }
    catch (Exception $e) {
      return response()->json(['message' => $e->message],404);     
    }
  }
  /** **/
  /** User **/
  function storeUser(Request $request) {
    try {
        return \App\User::create([
            'firebase_id' => $request['firebaseId'],
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Crypt::encryptString($request['password']),
            'phone' => $request['phone']
        ]);         
    }
    catch(Exception $ex){
        return $ex->messages;
    }
  }

  function checkNumber($number) {     
    $user = DB::table('users')->where('phone','=',$number)->get();

    if($user->count() == 0){
      return $user;
    }
    $json = json_encode(array('firebase_id'=>$user[0]->firebase_id,'name'=>$user[0]->name, 'phone'=>$user[0]->phone, 'email'=>$user[0]->email, 'password'=>Crypt::decryptString($user[0]->password)));
    $data = json_decode($json,JSON_UNESCAPED_UNICODE);
    return [$data];
  }

  function showUser($id) {
    $user = DB::table('users')->where('firebase_id','=',$id)->get();

    $json = json_encode(array('firebase_id'=>$user[0]->firebase_id,'name'=>$user[0]->name, 'phone'=>$user[0]->phone, 'email'=>$user[0]->email, 'password'=>Crypt::decryptString($user[0]->password)));
    $data = json_decode($json,JSON_UNESCAPED_UNICODE);
    return [$data];
  }

  function updateUser(Request $request) {
    return User::where('firebase_id','=',$request['firebaseId'])->update(['email' => $request['email'],'password' => Crypt::encryptString($request['password'])]);
  }
}