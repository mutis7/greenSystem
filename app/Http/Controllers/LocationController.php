<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\County;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('admin');
    }

    public function index()
    {
        //
        $locations = DB::table('locations')
            ->leftJoin('counties', 'locations.county_id', 'counties.id')
            ->select('locations.id', 'counties.county', 'locations.location', 'locations.collection_day')
            ->paginate(20);
            
        return view('location.locations',['locations'=>$locations]);
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
        return view('location.locationcreate',['counties'=> $counties]);
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
            'county_id' => 'required|numeric',
            'location' => 'required',
            'collection_day' => 'required']);
        $location = new Location;
        $location->county_id = $request->county_id;
        $location->location = $request->location;
        $location->collection_day = $request->collection_day;
        $location->save();
        return redirect('/locations');
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
        $location = Location::findOrFail($id);
        return view('location.locationedit',
            ['location'=> $location,
             'counties'=>$counties,]);

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
            'county_id' => 'required|numeric',
            'location' => 'required',
            'collection_day' => 'required']);
        $location = Location::findOrFail($id);
        $location->update($request->all());
        return redirect('/locations');
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
        $location = Location::findOrFail($id);
        $location-> delete();
        return redirect('/locations');
    }
}
