<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

/* MODELS---------------------------------------------------------*/
use App\Restaurant as Restaurant;
use App\Categories as Categories;
use App\deliveryMen;
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
         return Response::json(array("status" => "200", "data" => $restaurant));
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
}
