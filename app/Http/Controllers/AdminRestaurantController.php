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
      return view('layouts.admin-app-header');
    }
    $categories = $restaurant->categories()->get();
    return view('restaurant.home', ['restaurant' => $restaurant, 'categories' => $categories]);
    // return response()->json(['restaurant' => $restaurant, 'categories' => $categories]);
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
    return view('admin.restaurants.form', ['restaurant' => $restaurant]);
  }

  public function add_restaurant(Request $request){
    $rules = [
      'name'     => 'required',
      'user'     => 'required',
      'password' => 'required',
      'address'  => 'required',
      'details'  => 'required'
    ];

    $messages = [
      'name'     => 'Agrega el campo nombre',
      'user'     => 'Agrega el campo usuario',
      'password' => 'Agrega el campo de contraseña',
      'address'  => 'Agrega el campo de dirección',
      'details'  => 'Agrega el campo detalles'
    ];

    $this->validate($request, $rules, $messages);

    $restaurante = new Restaurant();
    $restaurante->name       = $request['name'];
    $restaurante->active     = 1;
    $restaurante->address    = $request['address'];
    $restaurante->details    = $request['details'];
    if($request['image']     == null){
      $restaurante->logo     = null;
    }
    else{
      $restaurante->logo     = $request['image'];
    }
    $restaurante->created_at = Carbon::now();
    $restaurante->updated_at = Carbon::now();
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

    return redirect('/administrador/restaurantes');
  }

  public function editRestaurant(Request $request){
    $edit = Restaurant::find($request['id']);
    $edit->name    = $request['name'];
    $edit->address = $request['address'];
    $edit->details = $request['details'];
    if($request['image'] == null){
      $edit->logo  = null;
    }
    else{
      $edit->logo  = $request['image'];
    }
    $edit->save();

    $RU = DB::table('restaurant_users')->where('restaurant', $request['id'])->update(['username' => $request['user'], 'password' => Hash::make($request['password']), 'email' => $request['email'], 'updated_at' => Carbon::now()]);

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
    $add = new Delivery();
    $add->name = $req['name'];
    $add->address = $req['address'];
    $add->details = $req['details'];
    $add->age = $req['age'];
    $add->gender = $req['gender'];
    $add->phone = $req['phone'];
    $add->curp = $req['curp'];
    $add->active = 1;
    $add->save();

    return 'ok';
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
    return 'ok';
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
}
