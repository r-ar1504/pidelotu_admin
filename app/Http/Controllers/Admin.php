<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Auth;
use App\RestaurantUsers;
use App\Restaurant;

class Admin extends Controller
{
/*
|--------------------------------------------------------------------------|
| Admin Panel Controller.                                                  |
|--------------------------------------------------------------------------|
|
| This controller handles authenticating users for the application and
| redirecting them to your home screen. The controller uses a trait
| to conveniently provide its functionality to your applications.
|   Models:
|    @Restaurant,
|    @Meal,
|    @MealVariant,
|    @Ingredient,
*/

function checkOut(Request $request){
  if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
    $user = RestaurantUsers::where('email', '=', $request->email)->first();
    
    if($user->role == 'restaurante'){
      return Response::json(array("status" => "200", "role" => $user->role, "restaurant" => $user->id));
    }
    else{
      return Response::json(array("status" => "200", "role" => $user->role));
    }
  }
  else {
    return Response::json(array("status" => "403"));
  }
}

function create(){
  $RestaurantUsers = new RestaurantUsers();
  $RestaurantUsers->username = 'Admin';
  $RestaurantUsers->email = 'admin1@hotmail.com';
  $RestaurantUsers->password = Hash::make(123);
  $RestaurantUsers->created_at = \Carbon\Carbon::now()->toDateTimeString();
  $RestaurantUsers->updated_at = \Carbon\Carbon::now()->toDateTimeString();
  $RestaurantUsers->role = 'adminR';

  $RestaurantUsers->save();
  return $RestaurantUsers;
}

function logout(){
  \Auth::logout();
  return view('/landing');
}


}

// $secret = Hash::make("pidelotu123");
//   $level = new RestaurantUsers();
//   $level->email = 'admin@pidelotu.com';
//   $level->username = "admin";
//   $level->password = $secret;
//   $level->save();
