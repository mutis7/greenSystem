<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
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
    public function index()
    {
        if(Auth::user()->role=='admin'){    
            return redirect('/admin');
        } else {
            if(Auth::user()->status=='inactive'){
                //wait for activation
                return view('user.userInactive');
            } else {
                //activated
            $user = Auth::user();
            $balance = $user->getUserBalance();
            // dd($balance);
                return view('user.userHome1',[
                    
                    ]);
            }
        }
        
    }
}
