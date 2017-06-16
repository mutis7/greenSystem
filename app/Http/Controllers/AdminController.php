<?php

namespace App\Http\Controllers;
use App\User;
use App\House;
use Illuminate\Support\Facades\DB;
use App\MessageNotification\SmsMessages;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


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
    public function viewHouses(){
        $houses = DB::table('houses')
            ->where('status', '=', 'active')
            ->leftJoin('locations', 'houses.location_id', 'locations.id')
            ->leftJoin('users', 'houses.user_id', 'users.id')
            ->paginate(20);
            

        return view('admin.viewhouses',[
            'houses' => $houses]);
    }

    public function activateHouses(){
        $houses = DB::table('houses')
            ->where('status', '=', 'pending')
            ->leftJoin('locations', 'locations.id', 'houses.location_id')
            ->leftJoin('users', 'houses.user_id', 'users.id')
            ->select('houses.id', 'houses.house', 'locations.location', 'users.email')
            ->paginate(20);
            return view('admin.pendingHouses',[
                'houses' => $houses]);
    }

    public function moreDetails(Request $request){
        $house = DB::table('houses')
            ->where('houses.id', '=', $request->id)
            ->leftJoin('locations', 'houses.location_id', 'locations.id')
            ->leftJoin('users', 'houses.user_id', 'users.id')
            ->leftJoin('telephones', 'telephones.user_id', 'houses.user_id')
            ->select('houses.id', 'houses.house', 'houses.monthlyfee', 'houses.balance', 'locations.location', 'locations.county_id','users.first_name', 'users.last_name', 'users.email','telephones.telephoneNumber')->first();
            $county = DB::table('counties')->where('id', '=', $house->county_id)->select('county')->first();
            
            
            return view('admin.moreHouseDetails', ['house'=>$house, 'county' =>$county]);

    }

    public function makeActive(Request $request){
        $this->validate($request,[
            'monthlyfee' => 'required|numeric']);
        DB::table('houses')->where('id', $request->id)->update(
            ['monthlyfee' => $request->monthlyfee,
             'status'=> 'active',
             'activated_at'=> Carbon::now()]); 
        $house = DB::table('houses')->where('houses.id', $request->id)
            ->leftJoin('users', 'users.id', 'houses.user_id')
            ->leftJoin('telephones', 'users.id', 'telephones.user_id')
            ->select('telephones.telephoneNumber', 'houses.house')
            ->first();
            
              $message = new SmsMessages();
              $message->send('house '.$house->house.' has been activated', $house->telephoneNumber); 
    

        return redirect('/allhouses');
    }

    public function editProfile(){
        // dd("here");
        return view('admin.adminedit');
    }
    public function saveProfile(Request $request){
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'username' => 'required']);

            $admin = User::findOrFail(Auth::user()->id);
            $admin->first_name  = $request->first_name;
            $admin->last_name = $request->last_name;
            $admin->email = $request->email;
            $admin->username = $request->username;
            $admin->update();
            return back()->with(['status'=>'profile successifully updated']);
    }

    public function passwordsave(Request $request){
        $this->validate($request,[
            'oldPassword'=> 'required',
            'password'=> 'required',
            'confirmPassword'=> 'required|same:password'
            ]);
        $status="";
    $customerror = "password did not match one in our records";
        if(Hash::check($request->oldPassword, Auth::user()->password)){
            Auth::user()->update(['password'=>$request->password]);
            $status="password successifully changed";
            $customerror = "";
        } 
        
        return back()->with(['status'=>$status,
            'error'=>$customerror]);
    }

    public function debthouses(){
        $houses = House::where('balance','>',0)
            ->leftJoin('users', 'users.id', 'houses.user_id')
            ->leftJoin('telephones', 'telephones.user_id', 'users.id')
            ->leftJoin('locations', 'locations.id', 'houses.location_id')
            ->select('houses.house', 'locations.location', 'users.email', 'telephones.telephoneNumber', 'houses.balance')
            ->get();

            return view('house.debthouses',['houses'=>$houses]);
    }

   
}
