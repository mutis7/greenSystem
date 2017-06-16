<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\PaypalRepository;
use Illuminate\Support\Facades\DB;

class PaypalController extends Controller
{
	
   public function charge(Request $request)
   {
      $this->validate($request,[
            'house' => 'required',
            'house_id' => 'required|numeric',
            'amount' => 'required|numeric']);
      DB::table('temppayments')->insert(
    ['house' => $request->house,
     'house_id' => $request->house_id,
     'amount' => $request->amount]);
      
      
   	$paypal = new PaypalRepository();
   
   	
   	$response = $paypal->checkout($request->house_id, $request->house,$request->amount);
   	
   }
   public function success(Request $request)
   {
     
   	return redirect()->action('HouseController@payhouse');
   }

   public function cancel(Request $request)
   {
   	return redirect('payforhouses')->with(['message'=> "We were unable to complete your payments"]);
   }
}
