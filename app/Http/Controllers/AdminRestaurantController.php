<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    $data = $request->all();
    $image = $request->file('image');
    $restaurant = Restaurant::find($restaurant_id);
    $category = $restaurant->categories()->create(['name' => $data['name']]);

    $image_name = 'res-'.$restaurant_id.'-cat-'.$category->id.'.'.$image->extension();

    $image_path = $image->storeAs('/public/restaurants/categories', $image_name);

    if ( file_exists(storage_path('/app/'.$image_path))) {
      $category->dashboard_banner = $image_name;
      $category->save();
      return response()->json(['data' => $data, 'id' => $restaurant->id, 'file' => $image_path]);
    }else{
      return response()->json(['data' => storage_path('/app'.$image_path)]);
    }


  }

  /*Get Category By Id*/
  function getRestaurant(Request $request, $restaurant_id){
    $data = $request->all();
    $restaurant = Restaurant::find($restaurant_id);
    return response()->json(['restaurant' => $restaurant]);

  }
}
