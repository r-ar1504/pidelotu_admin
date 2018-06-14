<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\RestaurantUsers as Restaurant;
use Illuminate\Support\Facades\Hash;

class RegisterRestaurantController extends Controller
{
	public function seend(Request $request){
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
					$message->from('irving_alejandro_34@hotmail.com','Pídelo Tú');
					$message->subject($data['subject']);
					$message->to($data['to'], $data['name']);
				});
		} catch (Exception $e) {
			return 'Ups';
		}
		redirect_to('/');
	}

	public function register(Request $request){
		Restaurant::create(array(
      'username'    => 'restaurante',
      'email'       => 'la@admin.com',
      'password'    => Hash::make('admin2'),
      'created_at'  => Carbon::now(),
      'updated_at'  => Carbon::now(),
      'role'         => 'restaurante',
      
    ));

    return 'OK';
	}
}
