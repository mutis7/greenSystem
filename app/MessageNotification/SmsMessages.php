<?php

namespace App\MessageNotification;
use App\MessageNotification\AfricasTalkingGateway;


class SmsMessages{
	// Specify your login credentials
protected $username   = "franckmutis";
protected $apikey     = "272318f9149ce6bc2b8235880733c69891ebb943335af4409277dfae2cc4d038";
    //
public function send()
{
$message    = "the demo works fine";
$recipients = +254706126006;
	$gateway    = new AfricasTalkingGateway($this->username, $this->apikey, "sandbox" );
// NOTE: If connecting to the sandbox, please add the sandbox flag to the constructor:
/*************************************************************************************
             ****SANDBOX****
$gateway    = new AfricasTalkingGateway($username, $apiKey, "sandbox");
**************************************************************************************/
// Any gateway error will be captured by our custom Exception class below, 
// so wrap the call in a try-catch block
try 
{ 
  // Thats it, hit send and we'll take care of the rest. 
  $results = $gateway->sendMessage($recipients, $message);
            
  foreach($results as $result) {
    // status is either "Success" or "error message"
    echo " Number: " .$result->number;
    echo " Status: " .$result->status;
    
  }
}
catch ( AfricasTalkingGatewayException $e )
{
  echo "Encountered an error while sending: ".$e->getMessage();
}


}
// Be sure to include the file you've just downloaded

// NOTE: If connecting to the sandbox, please use your sandbox login credentials
// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
// And of course we want our recipients to know what we really do
// $message    = "I'm a lumberjack and its ok, I sleep all night and I work all day";
// Create a new instance of our awesome gateway class
// DONE!!! 
}
