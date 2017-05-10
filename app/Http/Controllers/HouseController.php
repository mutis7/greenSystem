<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\House;
use App\Location;
use App\County;
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
        $counties = County::all();
        $locations = Location::all();
        $houses = House::where('user_id',Auth::user()->id)->paginate(10);
        // dd($counties->all(), $locations->all(), $houses->all());
        return view('user.userHouse1', [
            'houses'=>$houses,
            'counties'=>$counties,
            'locations'=> $locations
            ]);
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
    
}
