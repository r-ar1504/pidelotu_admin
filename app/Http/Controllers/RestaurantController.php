<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Berkayk\OneSignal\OneSignalFacade;

use Kozz\Laravel\Facades\Guzzle;
/* MODELS---------------------------------------------------------*/
use App\Restaurant as Restaurant;
use App\Categories as Categories;
use App\RestaurantUsers as RU;
use App\deliveryMen;
use App\Meal;
use App\MealCategory;
use App\Ingredient;
/*------------------------------------------------------------------
| Controller for Restaurant Model                                  |                                   |                                                               |
--------------------------------------------------------------------
*  id - Int,
*  name - String,
*  phone - String,
*  address - String,
*  created_at - Date,
*  updated_at - Date
------------------------------------------------------------------*/
/*------------------------------------------------------------------
| Uses Categories Model                                            |                                                               |
--------------------------------------------------------------------
*  id - Int,
*  name - String,
*  phone - String,
*  address - String,
*  created_at - Date,
*  updated_at - Date
------------------------------------------------------------------*/
class RestaurantController extends Controller
{
  /* Traer las categorias del restaurante iniciado */
  function home(Request $request, $id){
    $category = DB::table('meal_categories')
                    ->select('*')
                    ->where('id', '=', $id)
                    ->get();

    $restaurant = DB::table('restaurants')
                      ->select('*')
                      ->where('id', '=', $category[0]->restaurant_id)
                      ->get();

    $user = DB::table('restaurant_users')
                ->select('*')
                ->where('restaurant', '=', $restaurant[0]->id)
                ->get();

    return view('restaurant.home', ['restaurant' => $user, 'categories' => $restaurant, 'CategoriesR' => $category, 'id' => $category[0]->id]);
  }

  function getCategories(Request $request, $id){
    /*Usuario de restaurante*/
    $restaurant = RU::find($id);

    if($restaurant === null){
      return view('restaurants.admin-app-header');
    }
    /*Restaurante*/
    $categories = DB::table('restaurants')
                    ->select('*')
                    ->where('id', '=', $restaurant->restaurant)
                    ->get();

    /*Categorias del restaurante*/
    $restaurantC = DB::table('meal_categories')
                      ->select('*')
                      ->where('restaurant_id', '=', $categories[0]->id)
                      ->get();

    //return $categories;
    if(count($restaurantC) == 0){
      $restaurantC = DB::table('meal_categories')
                        ->select('*')
                        ->where('restaurant_id', '=', $restaurant->id)
                        ->get();

      return view('restaurant.home', ['restaurant' => $restaurant, 'categories' => $categories, 'CategoriesR' => $restaurantC, 'id' => $restaurantC[0]->id]);
    }
    else{
      return view('restaurant.home', ['restaurant' => $restaurant, 'categories' => $categories, 'CategoriesR' => $restaurantC, 'id' => $restaurantC[0]->id]);
    }
  }

  function addCategory(Request $request, $restaurant_id){
    $restaurant = RU::find($restaurant_id);
    
    return view('restaurant.category.form', ['restaurant' => $restaurant]);
  }

  function editCategorie(Request $request){
    $restaurant = DB::table('meal_categories')
                      ->select('*')
                      ->where('name', '=', $request->id)
                      ->get();

    return view('restaurant.category.edit-category', ['restaurant' => $restaurant]);
  }

  function createCategory(Request $request, $restaurant_id){
    /*if(!$request->hasFile("image")){
      $category = DB::table('meal_categories')
                    ->insert([
                        'name'          => $request['name'],
                        'restaurant_id' => $restaurant_id,
                        'active'        => 1,
                        'created_at'    => Carbon::now(),
                        'updated_at'    => Carbon::now(),
                        'image'         => null
                    ]);
    }
    else{
      $image = $request->file('image');
      $image_name = $request['name'].'-logo'.$image->extension();
      $image_path = $image->move(public_path().'/images/logos/', $image_name);
      $category->image  = $image_name;

      $category = DB::table('meal_categories')
                    ->insert([
                        'name'          => $request['name'],
                        'restaurant_id' => $restaurant_id,
                        'active'        => 1,
                        'created_at'    => Carbon::now(),
                        'updated_at'    => Carbon::now(),
                        'image'         => $image_name
                    ]);
    }*/

    $restaurant = DB::table('restaurant_users')
                         ->select('*')
                         ->where('id', '=', $request->id)
                         ->get();

    $category = new Categories();
    $category->name              = $request['name'];
    $category->restaurant_id     = $restaurant[0]->restaurant;
    $category->active            = 1;
    if(!$request->hasFile("image")){
      $category->image           = null;
    }
    else{
      $image = $request->file('image');
      $image_name = $request['name'].'-logo.'.$image->extension();
      $image_path = $image->move(public_path().'/images/restaurants/categories/', $image_name);
      $category->image  = $image_name;
    }

    $category->created_at        = Carbon::now();
    $category->updated_at        = Carbon::now();
    $category->save();

    return redirect('/restaurante/inicio/'. $request->id);
  }

  function deleteCategorie(Request $request){
    $categorie = DB::table('meal_categories')
                     ->where('id', '=', $request->id)
                     ->update(['active' => 0, 'updated_at' => Carbon::now()]);
    return $request->id;
  }

  function meals(Request $req, $id){
    $meals = Meal::where('category_id', '=', $id)->get();

    $categorie = DB::table('meal_categories')
                    ->select('id', 'name', 'restaurant_id')
                    ->where('id', '=', $id)
                    ->get();
    
    $restaurant = DB::table('restaurants')
                    ->select('id', 'name')
                    ->where('id', '=', $categorie[0]->restaurant_id)
                    ->get();

    return view('restaurant.meals', ['meals' => $meals, 'id' => $id, 'categorie' => $restaurant]);
 }

 function editMeal(Request $request){
  $rules = [
      'name'                 => 'required',
      'time'                 => 'required | int',
      'description'          => 'required',
      'price'                => 'required | int'
    ];

  $messages = [
    'name.required'           => 'Agrega el campo nombre',
    'time.required'           => 'Agrega el campo Tiempo de preparación',
    'time.int'                => 'Necesita ser datos numericos en tiempo de preparación',
    'description.required'    => 'Agrega el campo de descripsion',
    'price.required'          => 'Agrega el campo de precio',
    'price.int'               => 'Necesita ser datos numericos en el campo de precio'
  ];

  $this->validate($request, $rules, $messages);

  $UPDATE = DB::table('meals')
                ->where('id', '=', $request->id)
                ->update([
                  'name' => $request->name,
                  'preparation_time' => $request->time,
                  'description' => $request->description,
                  'price' => $request->price,
                  'updated_at' => Carbon::now()
                ]);

  $meals = DB::table('meals')
               ->select('*')
               ->where('id', '=', $request->id)
               ->get();

  $categorie = DB::table('meal_categories')
            ->select('*')
            ->where('id', '=', $meals[0]->category_id)
            ->get();

  $restaurant = DB::table('restaurants')
                    ->select('*')
                    ->where('id', '=', $categorie[0]->restaurant_id)
                    ->get();

  $ru = RU::find($restaurant[0]->id+1);

  $mealsAll = DB::table('meals')
                  ->select('*')
                  ->where('category_id', '=', $categorie[0]->id)
                  ->get();

  return view('restaurant.meals', ['categorie' => $restaurant, 'id' => $ru->id, 'meals' => $mealsAll]);
 }

 function addMeal(Request $req, $id){
   return view('restaurant.addMeal', ['id' => $id]);
 }

 function deleteMeal(Request $request){
    $categorie = DB::table('meals')
                       ->where('id', '=', $request->id)
                       ->update(['active' => 0, 'updated_at' => Carbon::now()]);
    return $request->id;
 }

 function addMealC(Request $req){
    $rules = [
      'name'                 => 'required',
      'preparation_time'     => 'required | int',
      'description'          => 'required',
      'price'                => 'required | int'
    ];

    $messages = [
      'name.required'                 => 'Agrega el campo nombre',
      'preparation_time.required'     => 'Agrega el campo Tiempo de preparación',
      'preparation_time.int'       => 'Necesita ser datos numericos en tiempo de preparación',
      'description.required'          => 'Agrega el campo de descripsion',
      'price.required'                => 'Agrega el campo de precio',
      'price.int'                  => 'Necesita ser datos numericos en el campo de precio'
    ];

    $this->validate($req, $rules, $messages);
      $create = DB::table('meals')->insert(
               ['category_id' => $req->id, 
                'description' => $req->description,
                'preparation_time' => $req->preparation_time,
                'name' => $req->name,
                'image' => $req->file('image'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'active' => 1,
                'price' => $req->price
               ]
          );
 return redirect('/restaurante/comidas/'.$req->id);
}

function ingredients(Request $req, $id){
   $ingredients = Ingredient::where('meal_id', '=', $id)->get();

   $meal = DB::table('meals')
              ->select('id', 'description', 'category_id')
              ->where('id', '=', $id)
              ->get();

    $categorie = DB::table('meal_categories')
                    ->select('id', 'name', 'restaurant_id')
                    ->where('id', '=', $meal[0]->category_id)
                    ->get();

    $restaurant = DB::table('restaurants')
                    ->select('id', 'name')
                    ->where('id', '=', $categorie[0]->restaurant_id)
                    ->get();

   return view('restaurant.ingredients', ['id' => $id, 'ingredients' => $ingredients, 'restaurant' => $restaurant]);
 }

 function createIngredient(Request $req){
   $data = $req->all();
   $validator = Validator::make($data, [
     'price' => 'required',
     'name' => 'required',
     'meal_id' => 'required'
   ]);
   if(!$validator->fails()){
     try {
        $ingredient = new Ingredient();
        $ingredient->price = $req->price;
        $ingredient->meal_id = $req->meal_id;
        $ingredient->name = $req->name;
        $ingredient->active = 1;
        $ingredient->save();
        return Response::json(array("status" => "200", "data" => $ingredient));
      } catch (Exception $e) {
        return Response::json(array("status" => "500", "data" => $e));
      }
   }
   else {
     return Response::json(array("status" => "401", "data" => $validator->messages()));
   }
 }






















  /*Get All Restaurants*/
  function getRestaurants(Request $req){
    $restaurants = Restaurant::where('active', '=', 1)->get();
    return view('admin.restaurants.home', ['restaurants' => $restaurants]);
  }

  function infoRestaurant(Request $req, $restaurant_id){
    $restaurant = Restaurant::where('id', '=', $restaurant_id)->first();
    return view('admin.restaurants.form', ['restaurant' => $restaurant]);
  }

  /*Create New Restaurant*/
  function createRestaurant(Request $req){
    $data = $req->all();
    $validator = Validator::make($data, [
      'address' => 'required',
      'details' => 'required',
      'name' => 'required'
    ]);
    if(!$validator->fails()){
      try {
         $public_path = public_path();
         $restaurant = new Restaurant();
         $restaurant->name = $req->name;
         $restaurant->address = $req->address;
         $restaurant->details = $req->details;
         $restaurant->password = Hash::make($req->password);
         $restaurant->username = $req->user;
          if(!$req->hasFile("image")){
            $restaurant->logo = "default.png";
          }else{
            $bannerFile = $req->file('image');
            $bannerName = md5($bannerFile->getClientOriginalName()."".Carbon::now()).".".$bannerFile->getClientOriginalExtension();
            $bannerFile->move($public_path.'/images/logos/', $bannerName);
            $restaurant->logo = $bannerName;
          }
         $restaurant->active = 1;
         $restaurant->save();

         $bnn = $req->file('ban');

         $img_name = 'res-'.$restaurant->id.'-ban.'.$bnn->extension();

         $img_path = $bnn->move(public_path().'/images/restaurants/banners/', $img_name);
         $restaurant->banner = $img_name;

         $restaurant->save();
         return Response::json(array("status" => "200", "data" => $restaurant, 'bnn' => $img_name));
       } catch (Exception $e) {
         return Response::json(array("status" => "500", "data" => $e));
       }
    }
    else {
      return Response::json(array("status" => "401", "data" => $validator->messages()));
    }

  }

  function update_restaurant(Request $req){
    $data = $req->all();
    $validator = Validator::make($data, [
      'address' => 'required',
      'details' => 'required',
      'name' => 'required'
    ]);
    if(!$validator->fails()){
      try {
         $public_path = public_path();
         $restaurant = Restaurant::where('id', '=', $req->id)->first();
         $restaurant->name = $req->name;
         $restaurant->address = $req->address;
         $restaurant->details = $req->details;
         $restaurant->username = $req->user;
          if($req->hasFile("image")){
            $bannerFile = $req->file('image');
            $bannerName = md5($bannerFile->getClientOriginalName()."".Carbon::now()).".".$bannerFile->getClientOriginalExtension();
            $bannerFile->move($public_path.'/images/logos/', $bannerName);
            $restaurant->logo = $bannerName;
          }
          if ($req->password) {
            $restaurant->password = Hash::make($req->password);
          }
         $restaurant->active = 1;
         $restaurant->save();
         return Response::json(array("status" => "200", "data" => $restaurant));
       } catch (Exception $e) {
         return Response::json(array("status" => "500", "data" => $e));
       }
    }
    else {
      return Response::json(array("status" => "401", "data" => $validator->messages()));
    }
  }

  function deleteRestaurant(Request $req){
    $restaurant = Restaurant::where('id', '=', $req->id)->update(array(
      'active' => 0
    ));
    if ($restaurant > 0){
      return Response::json(array("status" => "200", "data" => $restaurant));
    }
    else {
      return Response::json(array("status" => "404", "data" => $restaurant));
    }
  }

  /*Get Restaurant By Id*/
  function getRestaurant(Request $request, $restaurant_id){
    $data = $request->all();
    $restaurant = Restaurant::find($restaurant_id);
    return response()->json(['restaurant' => $restaurant]);

  }

  /**
   * orders functions
   */

  function orders(Request $req){
    return view('admin.restaurants.orders');
  }

  function deliveryMan(Request $req){
    $delivery_mans = deliveryMen::where('active', '=', 1)->get();
    return view('admin.orders.delivery-man', ['deliveryMans' => $delivery_mans]);
  }

  function add_deliveryMan(Request $req){
    $delivery_man = null;
    return view('admin.orders.add_deliveryMan', ['delivery_man' => $delivery_man]);
  }

  public function getOrders(){
   try {
     $orders = DB::table('orders')->select('meal_id as id','meal_category_id as category_id','preparation_time','restaurant_id','restaurants.name as restaurant','meals.name as name','orders.created_at as date','orders.id as order_id','meals.image as image','description','price','total','status')->join('restaurants','restaurant_id','=','restaurants.id')->join('meals','meal_id','=','meals.id')->get();

     return $orders;
   }
   catch(Exception $ex) {
     return response()->json($ex->message);
   }
  }

  function getinfoDeliveryMan(Request $req, $delMan_id){
    $delivery_man = deliveryMen::where('id', '=', $delMan_id)->first();
    return view('admin.orders.add_deliveryMan', ['delivery_man' => $delivery_man]);
  }

  function add_delivery_man(Request $req){
    $data = $req->all();
    $validator = Validator::make($data, [
      'address' => 'required',
      'details' => 'required',
      'name' => 'required'
    ]);
    if(!$validator->fails()){
      try {
         $public_path = public_path();
         $delivery_man = new deliveryMen();
         $delivery_man->name = $req->name;
         $delivery_man->phone = $req->phone;
         $delivery_man->details = $req->details;
         $delivery_man->age = $req->age;
         $delivery_man->curp = $req->curp;
         $delivery_man->address = $req->address;
         $delivery_man->gender = $req->gender;
          if(!$req->hasFile("image")){
            $delivery_man->logo = "default.png";
          }else{
            $bannerFile = $req->file('image');
            $bannerName = md5($bannerFile->getClientOriginalName()."".Carbon::now()).".".$bannerFile->getClientOriginalExtension();
            $bannerFile->move($public_path.'/images/delivery_man/', $bannerName);
            $delivery_man->logo = $bannerName;
          }
         $delivery_man->active = 1;
         $delivery_man->save();
         return Response::json(array("status" => "200", "data" => $delivery_man));
       } catch (Exception $e) {
         return Response::json(array("status" => "500", "data" => $e));
       }
    }
    else {
      return Response::json(array("status" => "401", "data" => $validator->messages()));
    }
  }

  function update_delivery_man(Request $req){
    $data = $req->all();
    $validator = Validator::make($data, [
      'address' => 'required',
      'details' => 'required',
      'name' => 'required'
    ]);
    if(!$validator->fails()){
      try {
         $public_path = public_path();
         $delivery_man = deliveryMen::where('id', '=', $req->id)->first();
         $delivery_man->name = $req->name;
         $delivery_man->phone = $req->phone;
         $delivery_man->details = $req->details;
         $delivery_man->age = $req->age;
         $delivery_man->curp = $req->curp;
         $delivery_man->address = $req->address;
         $delivery_man->gender = $req->gender;
          if($req->hasFile("image")){
            $bannerFile = $req->file('image');
            $bannerName = md5($bannerFile->getClientOriginalName()."".Carbon::now()).".".$bannerFile->getClientOriginalExtension();
            $bannerFile->move($public_path.'/images/delivery_man/', $bannerName);
            $delivery_man->logo = $bannerName;
          }
         $delivery_man->active = 1;
         $delivery_man->save();
         return Response::json(array("status" => "200", "data" => $delivery_man));
       } catch (Exception $e) {
         return Response::json(array("status" => "500", "data" => $e));
       }
    }
    else {
      return Response::json(array("status" => "401", "data" => $validator->messages()));
    }
  }

  function deleteDeliveryMan(Request $req){
    $delivery_man = deliveryMen::where('id', '=', $req->id)->update(array(
      'active' => 0
    ));
    if ($delivery_man > 0){
      return Response::json(array("status" => "200", "data" => $delivery_man));
    }
    else {
      return Response::json(array("status" => "404", "data" => $delivery_man));
    }
  }



/**
 *
 */

 function all_orders(Request $req){
  $name = $req->id;

  $id = DB::table('restaurants')->where('name', $name)->get();

  $allOrders = DB::select('select orders.created_at as "order_date", orders.id as "order_id", users.name, meals.name as "meal_name", orders.ingredients from orders LEFT JOIN meals ON orders.meal_id = meals.id LEFT JOIN users ON orders.user_id = users.firebase_id where restaurant_id = '.$id[0]->id.'');

  return view('restaurant.restaurants-orders', ['orders' => $allOrders, 'restaurant' => $id[0]->name]);
 }

/**
 *
 */

 function getDelivery(Request $req, $id){

   $data = $id;

   $order = DB::table('orders')->where('id', '=', $id)->get();
   // OneSignalFacade::sendNotificationToUser("Orden Entrante", "676d30df-4dd9-43d6-a0ce-2bb842d6a1c6"	, $url = null, $data = array(['id' => $id, 'user_lat' => $order->latitude, 'user_lng' => $order->longitude,'res_lat' => 25.524224, 'res_lng' => -103.415248, ]), $buttons = null, $schedule = null);


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

   public function getMeals(){
     $meals = [];
     foreach (\App\MealCategory::where('restaurant_id','=',24)->get() as $category) {
       $mealCategory = \App\MealCategory::find($category['id']);
       $mealCategory->meals;
       array_push($meals, $mealCategory);
     }

     return $meals;

   }

   public function saveOrder(Request $request) {
     try {
       \DB::table('orders')->insert([
         'restaurant_id' => $request['restaurant_id'],
         'meal_category_id' => $request['meal_category_id'],
         'meal_id' => $request['meal_id'],
         'user_id' => $request['user_id'],
         'latitude' => $request['latitude'],
         'longitude' => $request['longitude'],
         'total' => $request['total'],
         'created_at' => $request['date']
       ]);

       $client = new \GuzzleHttp\Client();

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
       ])->getBody()->getContents();

       return response('success', 200)
               ->header('Content-Type', 'application/json');

     }
     catch (Exception $e) {
       return response('error '+$e->message, 404)
               ->header('Content-Type', 'application/json');
     }

   }

}
