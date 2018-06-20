<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\deliveryMen;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

/* MODELS---------------------------------------------------------*/
use App\Restaurant      as Restaurant;
use App\RestaurantUsers as RU;
use App\MealCategory    as Category;
use App\deliveryMen     as Delivery;
use App\Meal;
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
| Uses Category Model                                            |                                                               |
--------------------------------------------------------------------
*  id - Int,
*  name - String,
*  phone - String,
*  address - String,
*  created_at - Date,
*  updated_at - Date
------------------------------------------------------------------*/
class AdminRestaurantController extends Controller
{
  /*Get All Categories*/
  function getCategories(Request $request, $restaurant_id){
    $restaurant = Restaurant::find($restaurant_id);
    
    if($restaurant === null){
      return view('restaurants.admin-app-header');
    }
    $categories = $restaurant->categories()->get();

    return view('admin.home', ['restaurant' => $restaurant, 'categories' => $categories]);
  }

  function getCateogrie(Request $request){
    $restaurant = DB::table('restaurants')
                ->where('name', '=', $request['id'])
                ->get();
    
    $categories = DB::table('meal_categories')
                  ->where('restaurant_id', '=', $restaurant[0]->id)
                  ->get();
    
    return view('admin.home', ['restaurant' => $restaurant[0], 'categories' => $categories]);
  }

   function meals(Request $req, $id){
    $meals = Meal::where('category_id', '=', $id)->get();

    $category = DB::table('meal_categories')
                    ->select('restaurant_id')
                    ->where('id', '=', $id)
                    ->get();
    
    $restaurant = DB::table('restaurants')
                      ->select('name')
                      ->where('id', '=', $category[0]->restaurant_id)
                      ->get();
    

    return view('admin.meals', ['meals' => $meals, 'name' => $restaurant]);
   }

  function ingredients(Request $req, $id){
    $ingredients = Ingredient::where('meal_id', '=', $id)->get();

    $meal = DB::table('meals')
                ->select('category_id')
                ->where('id', '=', $id)
                ->get();

    $restaurant = DB::table('meal_categories')
                      ->select('restaurant_id')
                      ->where('id', '=', $meal[0]->category_id)
                      ->get();

    $name = DB::table('restaurants')
                ->select('name')
                ->where('id', '=', $restaurant[0]->restaurant_id)
                ->get();

    return view('admin.ingredients', ['id' => $id, 'ingredients' => $ingredients, 'name' => $name]);
  }

  function all_orders(Request $req){
    $id = DB::table('restaurants')->where('name', $req->id)->get();

    $allOrders = DB::select('select orders.created_at as "order_date", orders.id as "order_id", users.name, meals.name as "meal_name", orders.ingredients from orders LEFT JOIN meals ON orders.meal_id = meals.id LEFT JOIN users ON orders.user_id = users.firebase_id where restaurant_id = '.$id[0]->id.'');
    
    return view('admin.restaurants-orders', ['orders' => $allOrders, 'id' => $id]);
  }

  /*Load Form*/
  function addCategory(Request $request, $restaurant_id){
    $restaurant = Restaurant::find($restaurant_id);
    return view('restaurant.category.form', ['restaurant' => $restaurant]);
  }

  /*Create New Restaurant*/
  function createCategory(Request $request, $restaurant_id){
    // $data = $req->all();
    // $validator = Validator::make($data, [
    //   'address' => 'required',
    //   'details' => 'required',
    //   'name' => 'required'
    // ]);
    // if(!$validator->fails()){
    //   try {
    //      $public_path = public_path();
    //      $restaurant = new Restaurant();
    //      $restaurant->name = $req->name;
    //      $restaurant->address = $req->address;
    //      $restaurant->details = $req->details;
    //       if(!$req->hasFile("image")){
    //         $restaurant->logo = "default.png";
    //       }else{
    //         $bannerFile = $req->file('image');
    //         $bannerName = md5($bannerFile->getClientOriginalName()."".Carbon::now()).".".$bannerFile->getClientOriginalExtension();
    //         $bannerFile->move($public_path.'/images/logos/', $bannerName);
    //         $restaurant->logo = $bannerName;
    //       }
    //      $restaurant->active = 1;
    //      $restaurant->save();
    //      return Response::json(array("status" => "200", "data" => $restaurant));
    //    } catch (Exception $e) {
    //      return Response::json(array("status" => "500", "data" => $e));
    //    }
    // }
    // else {
    //   return Response::json(array("status" => "401", "data" => $validator->messages()));
    // }
      $data = $request->all();
      $image = $request->file('image');
      $restaurant = Restaurant::find($restaurant_id);
      // $category = $restaurant->categories()->create(['name' => $data['name']]);
      $category = DB::table('meal_categories')->insertGetId([
        'name' => $data['name'],
        'restaurant_id' => $restaurant_id
      ]);

      $image_name = 'res-'.$restaurant_id.'-cat-'.$category.'.'.$image->extension();

      $new_category = DB::table('meal_categories')->where('id','=',$category);
      $image_path = $image->move(public_path().'/images/restaurants/categories/', $image_name);
      $new_category->update([
        'dashboard_banner' => $image_name
      ]);

      return response()->json(['data' => $data, 'id' => $restaurant->id, 'file' => $image_path,'files' => $image_name]);
  }

  /*Get Category By Id*/
  function getRestaurant(Request $request, $restaurant_id){
    $data = $request->all();
    $restaurant = Restaurant::find($restaurant_id);
    return response()->json(['restaurant' => $restaurant]);
  }





  private $idRestaurante;

  /* Funciones del administrador */
  function getRestaurants(Request $req){
    $restaurants = Restaurant::where('active', '=', 1)->get();
    return view('admin.restaurants.home', ['restaurants' => $restaurants]);
  }

  function infoRestaurant(Request $req, $restaurant_id){
    $idRestaurante = $restaurant_id;
    $restaurant = Restaurant::where('id', '=', $restaurant_id)->first();
    $RU = DB::table('restaurant_users')
              ->select('*')
              ->where('restaurant', '=', $restaurant->id)
              ->get();

    return view('admin.restaurants.form', ['restaurant' => $restaurant, 'ru' => $RU]);
  }

  public function add_restaurant(Request $request){
    $rules = [
      'name'       => 'required',
      'user'       => 'required',
      'password'   => 'required',
      'address'    => 'required',
      'details'    => 'required',
    ];

    $messages = [
      'name'       => 'Agrega el campo nombre',
      'user'       => 'Agrega el campo usuario',
      'password'   => 'Agrega el campo de contraseña',
      'address'    => 'Agrega el campo de dirección',
      'details'    => 'Agrega el campo detalles',
    ];

    $this->validate($request, $rules, $messages);

    $restaurante = new Restaurant();
    $restaurante->name       = $request['name'];
    $restaurante->active     = 1;
    $restaurante->address    = $request['address'];
    $restaurante->details    = $request['details'];
    if(!$request->hasFile("image")){
      $restaurante->logo   = null;
    }
    else{
      $image = $request->file('image');
      $image_name = $request['name'].'-logo'.$image->extension();
      $image_path = $image->move(public_path().'/images/logos/', $image_name);
      $restaurante->logo  = $image_name;
    }
    $restaurante->open_time  = $request['open_time'];
    $restaurante->close_time = $request['close_time'];
    $restaurante->created_at = Carbon::now();
    $restaurante->updated_at = Carbon::now();
    $restaurante->not_working= 1;
    $restaurante->save();

    $id = Restaurant::where('created_at', Carbon::now())->first();
    
    $UserRestaurant = new RU();
    $UserRestaurant->username   = $request['user'];
    $UserRestaurant->email      = $request['email'];
    $UserRestaurant->password   = Hash::make($request['password']);
    $UserRestaurant->created_at = Carbon::now();
    $UserRestaurant->updated_at = Carbon::now();
    $UserRestaurant->role       = 'restaurante';
    $UserRestaurant->restaurant = $id->id;
    $UserRestaurant->save();

    $category = DB::table('meal_categories')->insert([
                    [
                      'name'          => 'oculto',
                      'active'        => 0,
                      'restaurant_id' => $id->id
                    ],
                ]);   

    return redirect('/administrador/restaurantes');
  }

  public function editRestaurant(Request $request){
    $rules = [
      'name'              => 'required',
      'email'             => 'required',
      'password'          => 'required',
      'address'           => 'required',
      'details'           => 'required'
    ];

    $messages = [
      'name.required'     => 'Agrega el campo Nombre.',
      'email.required'    => 'Agrega el campo de email.',
      'password.required' => 'Agrega el campo de contraseña.',
      'address.required'  => 'Agrega el campo de dirección.',
      'details.required'  => 'Agrega el campo de detalles.',
    ];

    $this->validate($request, $rules, $messages);

    $edit = Restaurant::find($request['id']);
    $edit->name    = $request['name'];
    $edit->address = $request['address'];
    $edit->details = $request['details'];
    if(!$request->hasFile("image")){
      
    }
    else{
      $image = $request->file('image');
      $image_name = $request['name'].'-logo'.$image->extension();
      $image_path = $image->move(public_path().'/images/logos/', $image_name);
      $edit->logo  = $image_name;
    }
    $edit->save();

    $RU = DB::table('restaurant_users')
              ->where('restaurant', $request['id'])
              ->update(['username' => $request['user'], 'password' => Hash::make($request['password']), 'email' => $request['email'], 'updated_at' => Carbon::now()]);

    return redirect('/administrador/restaurantes');
  }

  function deleteRestaurant(Request $req){
    $delete = Restaurant::find($req['id']);
    $delete->active = 0;
    $delete->save();

    return 'Ok';
    /*if ($delete->save() > 0){
      return Response::json(array("status" => "200", "data" => $delete));
    }
    else {
      return Response::json(array("status" => "404", "data" => $delete));
    }*/
  }

  function orders(Request $req){
    //return view('admin.restaurants.orders');
    $delivery_mans = deliveryMen::where('active', '=', 1)->get();
    return view('admin.orders.delivery-man', ['deliveryMans' => $delivery_mans]);
  }

  function deliveryMan(Request $req){
    $delivery_mans = deliveryMen::where('active', '=', 1)->get();
    return view('admin.orders.delivery-man', ['deliveryMans' => $delivery_mans]);
  }

  function add_deliveryMan(Request $req){
    $delivery_man = null;
    return view('admin.orders.add_deliveryMan', ['delivery_man' => $delivery_man]);
  }

  function getinfoDeliveryMan(Request $req, $delMan_id){
    $delivery_man = deliveryMen::where('id', '=', $delMan_id)->first();
    return view('admin.orders.add_deliveryMan', ['delivery_man' => $delivery_man]);
  }

  function add_delivery_man(Request $req){
    $add             = new Delivery();
    $add->name       = $req['name'];
    $add->address    = $req['address'];
    $add->details    = $req['details'];
    $add->age        = $req['age'];
    $add->gender     = $req['gender'];
    $add->phone      = $req['phone'];
    $add->curp       = $req['curp'];
    if(!$req->hasFile("image")){
      $add->logo     = null;
    }
    else{
      $image = $req->file('image');
      $image_name    = $req['name'].'-logo'.$image->extension();
      $image_path    = $image->move(public_path().'/images/delivery_man/', $image_name);
      $add->logo     = $image_name;
    }
    $add->created_at = Carbon::now();
    $add->updated_at = Carbon::now();
    $add->active     = 1;
    $add->save();

    return 'ok';
  }

  function update_delivery_man(Request $req){
    $put = deliveryMen::find($req['id']);
    $put->name       = $req['name'];
    $put->phone      = $req['phone'];
    $put->details    = $req['details'];
    $put->age        = $req['age'];
    $put->curp       = $req['curp'];
    $put->address    = $req['address'];
    $put->gender     = $req['gender'];
    if(!$req->hasFile("image")){
      $put->logo     = null;
    }
    else{
      $image = $req->file('image');
      $image_name    = $req['name'].'-logo'.$image->extension();
      $image_path    = $image->move(public_path().'/images/delivery_man/', $image_name);
      $put->logo     = $image_name;
    }
    $put->updated_at = Carbon::now();

    $put->save();
    return 'ok';
  }

  function deleteDeliveryMan(Request $req){
    $delivery_man = deliveryMen::where('id', '=', $req->id)->update(array(
      'active' => 0
    ));
    return 'ok';
  }

  function update_restaurant(Request $req){
    $data       = $req->all();
    $validator  = Validator::make($data, [
      'address' => 'required',
      'details' => 'required',
      'name'    => 'required'
    ]);
    if(!$validator->fails()){
      try {
         $public_path          = public_path();
         $restaurant           = Restaurant::where('id', '=', $req->id)->first();
         $restaurant->name     = $req->name;
         $restaurant->address  = $req->address;
         $restaurant->details  = $req->details;
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
}
