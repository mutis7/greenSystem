<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }

    public function index(){
    	return view('admin.adminDashboard');
    }

    public function inactiveUsers(){
    	$users = User::where('status','inactive')->paginate(10);    	
    	return view('admin.activateusers', [
    		'users'=> $users
    		]);

    }

    public function activateUser($id){

    	$user = User::findOrFail($id);
    	$user->update([
    		'status'=>'active'
    		]);
    	
    	return redirect()->back();
    }
    public function activeUsers(){
        $users = User::where('status','active')->paginate(10);        
        return view('admin.activeusers', [
            'users'=> $users
            ]);

    }

    
}
