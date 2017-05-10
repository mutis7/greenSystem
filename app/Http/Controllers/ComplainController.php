<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Complaint;

class ComplainController extends Controller
{
    //
    public function index(){
    	return view('user.userComplaints');
    }


    public function store(Request $request){
        $this->validate($request,[
            'complain'=>'required'
            ]);
    	$complaint = new Complaint;
    	$complaint->complain = $request->complain;
    	$complaint->user_id = $request->user_id;
    	$complaint->save();
    	return back();

    }
}
