<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Telephone;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    //
    // public function __construct(){
    // 	$this->middleware('user');
    // }

    public function profile(){
    	return "user profile";
    }

    public function edit($id){
    	 $user= User::findOrFail($id);
    	 $phone = Telephone::where('user_id',$id)->firstOrFail()->telephoneNumber;//confirm this is working
    	 return view('user.userProfile', [
    	 	'user'=>$user,
    	 	'phone'=>$phone]);
    }

    public function update(Request $request){

    	$user = User::findOrFail($request->id);
    	$this->validate($request,[
    		'first_name'=> 'required',
    		'last_name'=> 'required',
    		'email'=> 'required',
    		'telephoneNumber'=> 'required',
    		'id'=>'required|numeric',
    		'username'=>'required'
    		]);
    	$user->update([
    		'first_name'=> $request->first_name,
    		'last_name'=> $request->last_name,
    		'email'=> $request->email,
    		'username'=> $request->username,]);
    	$tel = Telephone::where('user_id', $request->id);
    	$tel->update([
    		'telephoneNumber'=> $request->telephoneNumber]);
    	return back();
    	
    }
    public function updatepassword(Request $request){
    	
    	$this->validate($request,[
    		'oldpassword'=> 'required',
    		'password'=> 'required',
    		'password_confirmation'=> 'required|same:password'
    		]);
    	$status="";
	$customerror = "password did not match one in our records";
    	if(Hash::check($request->oldpassword, Auth::user()->password)){
    		Auth::user()->update(['password'=>$request->password]);
    		$status="success";
    		$customerror = "";
    	} 
    	
    	return back()->with(['status'=>$status,
    		'error'=>$customerror]);
    }
}
