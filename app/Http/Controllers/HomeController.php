<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\House;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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
            return redirect('/admin');
        } else {
        $houses = DB::table('houses')->where([['user_id', Auth::user()->id],['status', 'active']])
        ->leftJoin('locations', 'locations.id', 'houses.location_id')
        ->get();
        
        $pendings = DB::table('houses')->where([['user_id', Auth::user()->id],['status', 'pending']])->get();
                   
         return view('user.userHome1',['houses'=> $houses, 'pendings'=> $pendings]);
         
        }
        
    }

   

}
