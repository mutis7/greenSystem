<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\House;
use App\Location;
use App\County;
use App\Payment;
use App\MessageNotification\SmsMessages;
use Illuminate\Support\Facades\DB;
use Auth;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('user');

    }
    public function index()
    {
        //
        $houses = House::where('user_id',Auth::user()->id)
            ->leftJoin('locations', 'locations.id', 'houses.location_id')
            ->leftJoin('counties', 'counties.id', 'locations.county_id')
            ->select('houses.id', 'houses.house', 'houses.monthlyfee', 'houses.balance', 'locations.location', 'locations.collection_day',
                'counties.county')
            ->get();
        return view('user.userHouse1', [
            'houses'=>$houses]);
         // return view('house.houses',['houses'=>$houses,
         //                              'counties'=>$counties,
         //                              'locations'=> $locations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $counties = County::all();
        $locations = Location::all();
        return view('user.housecreate',
            ['counties'=>$counties,
             'locations'=>$locations]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request,[
            'location_id'=> 'required|numeric',
            'house'=> 'required',
            'user_id'=> 'required|numeric']);

        $house = new House;
        $house->location_id = $request->location_id;
        $house->house = $request->house;
        $house->user_id = $request->user_id;
        $house->save();
        return redirect('/houses');
              }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $counties = County::all();
        $locations = Location::all();
        $house = House::findOrFail($id);
        $locationId = $house->location_id;
        $loc = Location::findOrFail($house->location_id);
        $locationName= $loc->location;
        $cnty = County::findOrFail($loc->county_id);
        $countyId = $cnty->id;
        $countyName = $cnty->county;

        return view('user.houseedit',
            ['counties'=>$counties,
             'locations'=>$locations,
             'house'=>$house,
             'countyId'=>$countyId,
             'countyName'=> $countyName,
             'locationId'=> $locationId,
             'locationName'=>$locationName]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
            'location_id'=> 'required|numeric',
            'house'=> 'required',
            'user_id'=> 'required|numeric']);

        $house = House::findOrFail($id);
        $house->update($request->all());
        return redirect('/houses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $house = House::findOrFail($id);
        $house-> delete();
        return redirect('/houses');
    }
    
    public function housepay($id){
        $house = House::findOrFail($id);

        return view('payment.userpaymentform', ['house'=>$house]);
    }

    public function houses(){

        $houses = House::where(['user_id'=> Auth::user()->id],
            ['status'=> 'active'])->get();
        
        return view('payment.userhouses', ['houses'=>$houses]);
    }
    public function payhouse(){
        $res = DB::table('temppayments')->where('id', 1)->first();
       
        $amount = $res->amount;
        $house_id = $res->house_id;
        $house = $res->house;
        DB::table('temppayments')->where('house', $house)->delete();
       
        //api validation

        //end of api validation

        $payment = new Payment;
        $payment->amount = $amount;
        $payment->house_id = $house_id;
        $payment->payer = Auth::user()->username;
        $payment->save();
        $house = House::where('id', $house_id)->first()->house;
        $phone = House::where('houses.id', $house_id)->leftJoin('telephones', 'telephones.user_id',
            'houses.user_id')->first()->telephoneNumber;
      
        House::where('id', $house_id)->first()->decrement('balance', $amount);
        
        //show that payment was successifully paid
        //alert using text as proof
            $message = new SmsMessages();
            $message->send('transaction number: '.$payment->id.'. Amount '.$payment->amount.' has been paid for house '.$house, $phone);
        //return back with a sucess message
        return redirect('payforhouses')->with('message', 'payment successifully added');
    }
}
