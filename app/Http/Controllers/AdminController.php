<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }

    public function index(){
    	return view('admin.adminDashboard');
    }

    public function activeUsers(){

        $users=DB::table('users')
            ->where('role', '<>', 'admin')
            ->leftJoin('telephones', 'users.id', 'telephones.user_id')
            ->paginate(10);

        return view('admin.activeusers', [
            'users'=> $users
            ]);

    }

    
}
