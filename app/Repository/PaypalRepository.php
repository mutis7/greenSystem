<?php


namespace App\Repository;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;

class PaypalRepository{

    protected $client_id = 'ASJ_aoTiY6_9DUbB_MxNzdwuJGTX7G9KON8B0LN6NHk6wZbVSM-Gyb0w-ny9nKQPy0TpIxlxcZ1Oxb46';
    protected $secret = 'EJpRzgGIrAImsbR8uyIO4fgTQLX8CHj458db8g1xsHk7lMurZ7G2S7E5ptz1hv-O0ZTY9Rxpj4SkcmVr';
    protected $return_url;
    protected $cancel_url;
    protected $url_head = "https://api.sandbox.paypal.com/v1/payments/payment";

    public function __construct()
    {
       $this->cancel_url = action('PaypalController@cancel');
       $this->return_url = action('PaypalController@success');
    }

    public function payout($amount,$account_email,$op_id)
    {
        $this->cancel_url = url('motor-rider/payout/cancel?id='.$op_id);
        $this->return_url = url('motor-rider/payout/return?id='.$op_id);

        $url = "https://svcs.sandbox.paypal.com/AdaptivePayments/Pay";
        $header = [
            "X-PAYPAL-SECURITY-USERID: caller_1312486258_biz_api1.gmail.com",
            "X-PAYPAL-SECURITY-PASSWORD: 1312486294",
            "X-PAYPAL-SECURITY-SIGNATURE: AbtI7HV1xB428VygBUcIhARzxch4AL65.T18CTeylixNNxDZUu0iO87e",
            "X-PAYPAL-REQUEST-DATA-FORMAT: JSON",
            "X-PAYPAL-RESPONSE-DATA-FORMAT: JSON",
            "X-PAYPAL-APPLICATION-ID: APP-80W284485P519543T"
        ];
        $data = '{
  "actionType":"PAY",
  "currencyCode":"USD",
  "receiverList":{
    "receiver":[
      {
        "amount":"'.$amount.'",
        "email":"'.$account_email.'"
      }
    ]
  },
  "returnUrl":"'.$this->return_url.'",
  "cancelUrl":"'.$this->cancel_url.'",
  "requestEnvelope":{
    "errorLanguage":"en_US",
    "detailLevel":"ReturnAll"
  }
}';
        $content = $this->execCurl($url,$data,$header);
        return $content;
    }

    public function execCurl($url,$data,$header)
    {

        $method = 'POST';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl,CURLOPT_HTTPHEADER, $header);
        $content = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $json_response = null;
        if($status==200 || $status==201){
            $json_response = json_decode($content);
        }
        else{
            echo 'Curl error: ' . curl_error($curl);
            $content = json_decode($content);
//            return redirect()->back()->with('notice',['class'=>'warning','message'=>$content->message]);
            var_dump($content,$status,"curl fetch empty");
            exit;
        }

        return $json_response;

    }

    public function getAccessToken()
    {

        $url = "https://$this->client_id:$this->secret@api.sandbox.paypal.com/v1/oauth2/token?grant_type=client_credentials";

        $header = [
            'Accept: application/json',
            'Accept-Language: en_US'
        ];
        $data = [
            'grant_type'=>'client_credentials'
        ];
        $data = json_encode($data);
        $content = $this->execCurl($url,$data,$header);
        $access_token = $content->access_token;
        return $access_token;
    }

    public function checkout($house_id, $house, $amount)
    {

        $url = $this->url_head;
        $header = [
            "Content-Type:application/json",
            "Authorization: Bearer ".$this->getAccessToken().""
        ];
        $data = '{
  "intent": "sale",
  "payer": {
  "payment_method": "paypal"
  },
  "transactions": [
  {
    "amount": {
    "total": "'.$amount.'",
    "currency": "USD",
    "details": {
      "subtotal": "'.$amount.'",
      "tax": "0.00",
      "shipping": "0.00"
    }
    },
    "description": "Green Systems.",
            "item_list": {
                "items":[
                    {
                        "quantity":"1",
                        "name":"'.$house.'",
                        "price":"'.$amount.'",
                        "sku":"'.$house_id.'",
                        "currency":"USD"
                    }
                ]
            }
  }
  ],
  "note_to_payer": "Contact us for any questions on your payment.",
  "redirect_urls": {
  "return_url": "'.$this->return_url.'",
  "cancel_url": "'.$this->cancel_url.'"
  }
}';

        $content = $this->execCurl($url,$data,$header);

        $payerID = $content->id; //submit to database on
        $state = $content->state;

        $approval_url = "";
        if($state == "created"){
            $approval_url = $content->links[1]->href;
            $execute_url = $content->links[2]->href;

            $data = header('Location: '.$approval_url);
            var_dump("Checkout Failed"); exit;


        }
    }

    /**
     * Paypal checkout final request.
     *Execute payment after the payer has approved
     */
    public function execute($payer_id,$payment_id)
    {
        $url = $this->url_head."/$payment_id/execute";
        $header = [
            "Content-Type:application/json",
            "Authorization: Bearer ".$this->getAccessToken().""
        ];

        $data = '{
  "payer_id": "'.$payer_id.'"
}';
        return $this->execCurl($url,$data,$header);

    }

    public function paymentDetails($paykey)
    {
        $url = "https://svcs.sandbox.paypal.com/AdaptivePayments/PaymentDetails";
        $header = [
            "X-PAYPAL-SECURITY-USERID: caller_1312486258_biz_api1.gmail.com",
            "X-PAYPAL-SECURITY-PASSWORD: 1312486294",
            "X-PAYPAL-SECURITY-SIGNATURE: AbtI7HV1xB428VygBUcIhARzxch4AL65.T18CTeylixNNxDZUu0iO87e",
            "X-PAYPAL-REQUEST-DATA-FORMAT: JSON",
            "X-PAYPAL-RESPONSE-DATA-FORMAT: JSON",
            "X-PAYPAL-APPLICATION-ID: APP-80W284485P519543T"
        ];
        $data = '{
    "payKey": "'.$paykey.'",
    "requestEnvelope.errorLanguage": "en_US"
     }';
        return $this->execCurl($url,$data,$header);
    }
}

