<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\DB;

class ReminderController extends Controller
{
    //

    public function __construct(){
    	$this->middleware('admin');
    }

    public function index(Request $request){
        $this->validate($request,[
            'mail' => 'required']);       
    	
        //when not testing  make sure the email here is set to $user->email
        $data= array('email'=>'franckmutis@gmail.com', 'name'=>'Green System', 'from'=>'greensystems77@gmail.com', 'body'=>$request->mail);
        Mail::send('mail.reminder', $data, function($message) use ($data){
            $message->to($data['email'])
                ->from($data['from'], $data['name'])
                ->subject('issues concerning your house');
            });
    	
        return back()->with(['message'=>'mail sent successifully']);
    	
    }

    public function sendmail($id){
    	$user = DB::table('houses')->where('houses.id', $id)
    	->leftJoin('users', 'users.id', 'houses.user_id')
    	->select('houses.house', 'users.username', 'users.email')
    	->first();
        

       	return view('mail.prepareemail', ['user'=>$user]);
    }
}
  