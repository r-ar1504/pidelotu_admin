<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Openpay as OpenPay;

/*------------------------------------------------------------------
| Payment Controller uses- OpenPay Integration                     |
--------------------------------------------------------------------
 @createOrder(Request, $user_id);
 @attemptPayment(Request, $product_list);
------------------------------------------------------------------*/
class PaymentController extends Controller{

    function createOrder(Request $request, $user_id){
        $data = $request->all();
        $items = DB::table('cart')->where('user_id', '=', $user_id)->get();
        $open_pay = OpenPay::getInstance('mf4nsxsfmoaic0jt53jk', 'sk_8c9cb2db0fcb42d2b10dec6444b13324');
        $attempt_data = $this->attemptPayment($items, $user_id);
        
        return response()->json( [ 'message' => $attempt_data] );             
    }//List items by user, tries payment and returns a message & a code.

    function attemptPayment($items, $user_id){
        $customer = $this->getCustomerData($user_id);
        
    }

    function getCustomerData($user_id){
        $user = DB::table('users')->where('firebase_id', '=', $user_id)->first();
        $full_name = explode(" ", $user->name);
        
        return array(
            'name' => $full_name[0],
            'last_name' => $full_name[1],
            'email' => $user->email,
            'phone_number' => $user->phone,
        );
    }
}
