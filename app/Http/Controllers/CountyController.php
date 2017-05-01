<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\County;

class CountyController extends Controller
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

        $counties = County::paginate(20);
        return view('county.counties',['counties'=>$counties]);
        //more to come
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('county.countycreate');
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
        $county = new County;
        $county->county = $request->county;
        $county->save();
        return redirect('/counties');
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
        $county = County::findOrFail($id);
        return view('county.countyedit',['county'=> $county]);
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
        $county = County::findOrFail($id);
        $county->update($request->all());
        return redirect('/counties');
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
        $county = County::findOrFail($id);
        $county-> delete();
        return redirect('/counties');
    }
}
