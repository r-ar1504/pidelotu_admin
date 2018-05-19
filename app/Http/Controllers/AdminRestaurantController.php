<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/* MODELS---------------------------------------------------------*/
use App\Restaurant as Restaurant;
use App\MealCategory as Category;
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
      $category = DB::table('meal_categories')->insert([
        'name' => $data['name'],
        'restaurant_id' => $restaurant_id
      ]);
      return response()->json(['data' => $data, 'category' => $category, 'file' => $image]);

      // $image_name = 'res-'.$restaurant_id.'-cat-'.$category->id.'.'.$image->extension();
      $image_path = $image->move(public_path().'/images/restaurants/categories/', $image_name);
      $category->dashboard_banner = $image_name;
      $category->save();
      return response()->json(['data' => $data, 'id' => $restaurant->id, 'file' => $image_path]);
  }

  /*Get Category By Id*/
  function getRestaurant(Request $request, $restaurant_id){
    $data = $request->all();
    $restaurant = Restaurant::find($restaurant_id);
    return response()->json(['restaurant' => $restaurant]);
  }
}
