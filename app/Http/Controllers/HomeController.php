<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\House;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\MessageNotification\SmsMessages;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function updateBalance(){
        $now = Carbon::now();
        $activeHouses= House::where('status', 'active')->select('id', 'activated_at', 'balance', 'monthlyfee')->get();
        foreach ($activeHouses as $activeHouse) {
            $activatedAt = new Carbon($activeHouse->activated_at);
            $days =  $now->diffInDays($activatedAt); 
            if($days>=30){
                $activatedAt = $activatedAt->addDays(30);
                House::where('id', $activeHouse->id)->update(['activated_at'=> $activatedAt]);
                House::where('id', $activeHouse->id)->update(['balance'=>$activeHouse->balance + $activeHouse->monthlyfee]);
            } 
        
        }       
        
    }

    public function index(){    
        if(Auth::user()->role=='admin'){  
            $this->updateBalance();
            $this->dailyNotifications();  
            return redirect('/admin');
        } else {
        $houses = DB::table('houses')->where([['user_id', Auth::user()->id],['status', 'active']])
        ->leftJoin('locations', 'locations.id', 'houses.location_id')
        ->get();
        $mybalance = DB::table('houses')->where([['user_id', Auth::user()->id],['status', 'active']])->sum('balance');
        
        $pendings = DB::table('houses')->where([['user_id', Auth::user()->id],['status', 'pending']])->get();
                   
         return view('user.userHome1',['houses'=> $houses, 'pendings'=> $pendings, 'mybalance'=>$mybalance]);
         
        }
        
    }

    public function dailyNotifications(){
        $today = Carbon::today()->dayOfWeek;
        if($today==1){
            $day = DB::table('notifiers')->where('id', 1)->first()->monday;

            if($day==0){
                //send bulk sms to all supposed to receive text
                $myContacts = $this->contacts('monday');
                foreach ($myContacts as $contact) {
                    $message = new SmsMessages();
                     $message->send('today we will be collecting garbage for house'.$contact->house, $contact->telephoneNumber);
                }
                //update the record to one and set the rest to 0
                DB::table('notifiers')->where('id', 1)->update(['monday'=> 1, 'tuesday'=> 0, 'wednesday'=>0, 'thursday'=>0,'friday'=>0,'saturday'=>0,'sunday'=>0]);
                
                        
            }

        }
        if($today==2){
            $day = DB::table('notifiers')->where('id', 1)->first()->tuesday;

            if($day==0){
                //send bulk sms to all supposed to receive text
                $myContacts = $this->contacts('tuesday');
                foreach ($myContacts as $contact) {
                    $message = new SmsMessages();
                     $message->send('today we will be collecting garbage for house'.$contact->house, $contact->telephoneNumber);
                }
                //update the record to one and set the rest to 0
               DB::table('notifiers')->where('id', 1)->update(['monday'=> 0, 'tuesday'=> 1, 'wednesday'=>0, 'thursday'=>0,'friday'=>0,'saturday'=>0,'sunday'=>0]);
            }

        }
        if($today==3){
            $day = DB::table('notifiers')->where('id', 1)->first()->wednesday;

            if($day==0){
                //send bulk sms to all supposed to receive text
                $myContacts = $this->contacts('wednesday');
                foreach ($myContacts as $contact) {
                    $message = new SmsMessages();
                     $message->send('today we will be collecting garbage for house'.$contact->house, $contact->telephoneNumber);
                }
                //update the record to one and set the rest to 0
               DB::table('notifiers')->where('id', 1)->update(['monday'=> 0, 'tuesday'=> 0, 'wednesday'=>1, 'thursday'=>0,'friday'=>0,'saturday'=>0,'sunday'=>0]);
            }

        }
        if($today==4){
            $day = DB::table('notifiers')->where('id', 1)->first()->thursday;

            if($day==0){
                //send bulk sms to all supposed to receive text
                $myContacts = $this->contacts('thursday');
                foreach ($myContacts as $contact) {
                    $message = new SmsMessages();
                     $message->send('today we will be collecting garbage for house'.$contact->house, $contact->telephoneNumber);
                }
                //update the record to one and set the rest to 0
               DB::table('notifiers')->where('id', 1)->update(['monday'=> 0, 'tuesday'=> 0, 'wednesday'=>0, 'thursday'=>1,'friday'=>0,'saturday'=>0,'sunday'=>0]);
            }

        }
        if($today==5){
            $day = DB::table('notifiers')->where('id', 1)->first()->friday;

            if($day==0){
                //send bulk sms to all supposed to receive text
                $myContacts = $this->contacts('friday');
                foreach ($myContacts as $contact) {
                    $message = new SmsMessages();
                     $message->send('today we will be collecting garbage for house'.$contact->house, $contact->telephoneNumber);
                }
                //update the record to one and set the rest to 0
                DB::table('notifiers')->where('id', 1)->update(['monday'=> 0, 'tuesday'=> 0, 'wednesday'=>0, 'thursday'=>0,'friday'=>1,'saturday'=>0,'sunday'=>0]);
            }

        }
        if($today==6){
            $day = DB::table('notifiers')->where('id', 1)->first()->saturday;

            if($day==0){
                //send bulk sms to all supposed to receive text
                $myContacts = $this->contacts('saturday');
                foreach ($myContacts as $contact) {
                    $message = new SmsMessages();
                     $message->send('today we will be collecting garbage for house'.$contact->house, $contact->telephoneNumber);
                }
                //update the record to one and set the rest to 0
                DB::table('notifiers')->where('id', 1)->update(['monday'=> 0, 'tuesday'=> 0, 'wednesday'=>0, 'thursday'=>0,'friday'=>0,'saturday'=>1,'sunday'=>0]);
            }

        }
        if($today==7){
            $day = DB::table('notifiers')->where('id', 1)->first()->sunday;

            if($day==0){
                //send bulk sms to all supposed to receive text
                $myContacts = $this->contacts('sunday');
                foreach ($myContacts as $contact) {
                    $message = new SmsMessages();
                     $message->send('today we will be collecting garbage for house'.$contact->house, $contact->telephoneNumber);
                }
                //update the record to one and set the rest to 0
               DB::table('notifiers')->where('id', 1)->update(['monday'=> 0, 'tuesday'=> 0, 'wednesday'=>0, 'thursday'=>0,'friday'=>0,'saturday'=>0,'sunday'=>1]);
            }

        }
        
    }

    public function contacts($day){
        $locationId = DB::table('locations')->where('collection_day', $day)->first()->id;
       
        $houses = DB::table('houses')->where('location_id', $locationId)
            ->leftJoin('telephones', 'telephones.user_id', 'houses.user_id')
            ->select('telephones.telephoneNumber', 'houses.house')
            ->get();
            return $houses;
    }

   

}
