<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Complaint;

class ComplainController extends Controller
{
    //
    public function __construct(){
        $this->middleware('admin')->except(['index', 'store']);
        $this->middleware('user')->only(['index', 'store']);
    }
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
    	return back()->with(['message'=> "your complaint has been succesifuly been submited"]);

    }

    public function indexUnread(){
        $complaints = Complaint::where('read', 0)
        ->leftJoin('users', 'users.id', 'complaints.user_id')
        ->select('complaints.id', 'complaints.complain', 'complaints.created_at', 'users.email')
        ->paginate(10);
        // dd($complaints);
        return view ('complain.unreadcomplaints',['complaints'=>$complaints]);
    }
    public function indexRead(){
        $complaints = Complaint::where('read', 1)
        ->leftJoin('users', 'users.id', 'complaints.user_id')
        ->select('complaints.id', 'complaints.complain', 'complaints.created_at', 'users.email')
        ->paginate(10);
        // dd($complaints);
        return view ('complain.readcomplaints',['complaints'=>$complaints]);
    }
    public function read($id){
        Complaint::where('id', $id)->update(['read'=> 1]);
        return back();
    }
}
