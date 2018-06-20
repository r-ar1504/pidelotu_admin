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
  $RestaurantUsers->password = Hash::make(4789108);
  $RestaurantUsers->created_at = \Carbon\Carbon::now()->toDateTimeString();
  $RestaurantUsers->updated_at = \Carbon\Carbon::now()->toDateTimeString();
  $RestaurantUsers->role = 'admin';
  $RestaurantUsers->save();
  return redirect('/');
}

function logout(){
  \Auth::logout();
  return view('/landing');
}

function email(Request $request){

  $data       = [
      "name"             => $request["name"            ],
      "phone"            => $request["phone"           ],
      "cp"               => $request["cp"              ],
      "city"             => $request["city"            ],
      "address"          => $request["address"         ],
      "number"           => $request["number"          ],
      "number-r"         => $request["number-r"        ],
      "details"          => $request["details"         ],
      "contact_name"     => $request["contact_name"    ],
      "contact_lastname" => $request["contact_lastname"],
      "contact_email"    => $request["contact_email"   ],
      "contact_phone"    => $request["contact_phone"   ],
      "time"             => $request["time"            ],
      "count_month"      => $request["count_month"     ],
      "count_rep"        => $request["count_rep"       ],
      "type_rep"         => $request["type_rep"        ],
      "subject"          => "Un restaurante quiere unirse a ti, revisa su información",
      "to"               => "irving_alejandro_34@hotmail.com"
    ];

    try {
      \Mail::send('email.register',[
        'data'  => $data], function($message) use ($data){
          $message->from('alejandro@hotmail.com','Pídelo Tú');
          $message->subject($data['subject']);
          $message->to($data['to'], $data['name']);
        });
    } catch (Exception $e) {
      console.log('error');
    }
}


}

// $secret = Hash::make("pidelotu123");
//   $level = new RestaurantUsers();
//   $level->email = 'admin@pidelotu.com';
//   $level->username = "admin";
//   $level->password = $secret;
//   $level->save();
