<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExceptionJob;
use App\House;
use App\Job;

class ExceptionJobController extends Controller
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
        $exceptionJobs = ExceptionJob::leftJoin('houses', 'houses.id', 'exception_jobs.house_id')
            ->leftJoin('jobs', 'jobs.id', 'exception_jobs.job_id')
            ->leftJoin('locations', 'jobs.location_id', 'locations.id')
            ->select('houses.house', 'exception_jobs.description', 'exception_jobs.created_at', 'locations.location')
            ->paginate(20);
            // dd($exceptionJobs);
            return view('exception.exceptions', ['exceptionJobs'=>$exceptionJobs]);
    }

    
    public function job($id){
        $job_id= $id;
        $location_id =Job::where('id', $job_id)->first()->location_id;
        $houses = House::where('location_id', $location_id)->select('id', 'house')->get();
        return view('exception.exceptioncreate', ['houses'=>$houses,
            'job_id'=>$job_id]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'job_id' => 'required|numeric',
            'house_id' => 'required|numeric',
            'description' => 'required']);
        $exceptionJob = new ExceptionJob;
         $exceptionJob->job_id = $request->job_id;
         $exceptionJob->house_id = $request->house_id;
         $exceptionJob->description = $request->description;
         $exceptionJob->save();
         return back()->with(['status'=>'sucessifully added']);
    }
}
