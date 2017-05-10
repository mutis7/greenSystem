<?php

namespace App\Http\Controllers;
use App\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
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
        $vehicles = Vehicle::paginate(20);
        return view('vehicle.vehicles',['vehicles'=>$vehicles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('vehicle.vehiclecreate');
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
            'type'=> 'required',
            'description' => 'required',
            'status' => 'required']);
        $vehicle = new Vehicle;
        $vehicle->type = $request->type;
        $vehicle->description = $request->description;
        $vehicle->status = $request->status;
        $vehicle->save();
        return redirect('/vehicles');
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
        $vehicle = Vehicle::findOrFail($id);
        return view('vehicle.vehicleedit', ['vehicle' => $vehicle]);
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
            'type'=> 'required',
            'description' => 'required',
            'status' => 'required']);

        $vehicle = Vehicle::findOrFail($id);
        $vehicle->type = $request->type;
        $vehicle->description = $request->description;
        $vehicle->status = $request->status;
        $vehicle->save();
        return redirect('/vehicles');
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
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();
        return redirect('/vehicles');
    }
}
