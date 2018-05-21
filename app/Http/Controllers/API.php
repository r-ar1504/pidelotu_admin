<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class API extends Controller
{
  //<!-- Get All Restaurants -->//
  function getRestaurants(Request $request){
    $restaurants = DB::table('restaurants')->get();
    return response()->json(['restaurants' => $restaurants ]);
  }
}
