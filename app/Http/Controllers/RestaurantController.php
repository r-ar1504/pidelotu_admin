<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* MODELS---------------------------------------------------------*/
use App\Restaurant as Restaurant;
use App\Categories as Categories;
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
  function getRestaurants(Request $request){
    $restaurants = Restaurant::all();
    return view('admin.restaurants.home', ['restaurants' => $restaurants]);
  }

  /*Create New Restaurant*/
  function createRestaurant(Request $request){
    $data = $request->all();
    $image = $request->file('image');
    $restaurant = Restaurant::create(['name' => $data['name'], 'address' => $data['address'], 'details' => $data['details']]);

    $image_name = 'res-'.$restaurant->id.'.'.$image->extension();

    $image_path = $image->storeAs('/public/restaurants', $image_name);

    if ( file_exists(storage_path('/app/'.$image_path))) {
      $restaurant->logo = $image_name;
      $restaurant->save();
      return response()->json(['data' => $data, 'id' => $restaurant->id, 'file' => $image_path]);
    }else{
      return response()->json(['data' => storage_path('/app'. $image_path)]);
    }


  }

  /*Get Restaurant By Id*/
  function getRestaurant(Request $request, $restaurant_id){
    $data = $request->all();
    $restaurant = Restaurant::find($restaurant_id);
    return response()->json(['restaurant' => $restaurant]);

  }
}
