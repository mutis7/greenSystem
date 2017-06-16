<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehicle;
use App\Employee;
use App\Location;
use App\Job;
use App\House;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        return $this->middleware('admin');
    }
    public function index()
    {
        //used alias when joining to more than one table
        $jobs = DB::table('jobs')->where('jobs.status', 'ongoing')
            ->leftJoin('vehicles', 'jobs.vehicle_id', 'vehicles.id')
            ->leftJoin('employees as emp1', 'jobs.employee1_id', 'emp1.id')
            ->leftJoin('employees as emp2', 'jobs.employee2_id', 'emp2.id')
            ->leftJoin('employees as emp3', 'jobs.employee3_id', 'emp3.id')
            ->leftJoin('employees as emp4', 'jobs.employee4_id', 'emp4.id')
            ->leftJoin('locations', 'jobs.location_id', 'locations.id')
            ->select('jobs.id', 'vehicles.description as vehicle', 'emp1.firstName as emp1FirstName', 'emp1.lastName as emp1LastName', 'emp2.firstName as emp2FirstName', 'emp2.lastName as emp2LastName', 'emp3.firstName as emp3FirstName', 'emp3.lastName as emp3LastName', 'emp4.firstName as emp4FirstName', 'emp4.lastName as emp4LastName', 'locations.location', 'jobs.created_at')
            ->get();
            // dd($jobs);


            return view('jobs.jobs',['jobs'=>$jobs]);
          
             
    }
        public function completedJobs()
    {
        //used alias when joining to more than one table
        $jobs = DB::table('jobs')->where('jobs.status', 'complete')
            ->leftJoin('vehicles', 'jobs.vehicle_id', 'vehicles.id')
            ->leftJoin('employees as emp1', 'jobs.employee1_id', 'emp1.id')
            ->leftJoin('employees as emp2', 'jobs.employee2_id', 'emp2.id')
            ->leftJoin('employees as emp3', 'jobs.employee3_id', 'emp3.id')
            ->leftJoin('employees as emp4', 'jobs.employee4_id', 'emp4.id')
            ->leftJoin('locations', 'jobs.location_id', 'locations.id')
            ->select('jobs.id', 'vehicles.description as vehicle', 'emp1.firstName as emp1FirstName', 'emp1.lastName as emp1LastName', 'emp2.firstName as emp2FirstName', 'emp2.lastName as emp2LastName', 'emp3.firstName as emp3FirstName', 'emp3.lastName as emp3LastName', 'emp4.firstName as emp4FirstName', 'emp4.lastName as emp4LastName', 'locations.location', 'jobs.created_at')
            ->get();
            // dd($jobs);


            return view('jobs.jobscompleted',['jobs'=>$jobs]);
          
             
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $vehicles = Vehicle::where('assigned', 0)->select('id', 'description as vehicle')->get();
        $employees = Employee::where('assigned', 0)->select('id', 'firstName', 'lastName')->get();
        $locations = Location::select('id', 'location')->get();
        return view('jobs.jobcreate', [
            'vehicles'=>$vehicles,
            'employees'=>$employees,
            'locations'=> $locations
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate first
        $this->validate($request,[
            'vehicle_id'=> 'required|numeric',
            'employee1_id'=> 'required|numeric',
            'employee2_id'=> 'required|numeric',
            'employee3_id'=> 'required|numeric',
            'employee4_id'=> 'required|numeric',
            'location_id'=> 'required|numeric']);

        //mark the employees and houses as assigned
        Vehicle::where('id', $request->vehicle_id)->update(['assigned' => 1]);
        Employee::where('id', $request->employee1_id)->update(['assigned' => 1]);
        Employee::where('id', $request->employee2_id)->update(['assigned' => 1]);
        Employee::where('id', $request->employee3_id)->update(['assigned' => 1]);
        Employee::where('id', $request->employee4_id)->update(['assigned' => 1]);

        //insert into jobs table
        $job = new Job;
        $job->vehicle_id = $request->vehicle_id;
        $job->employee1_id = $request->employee1_id;
        $job->employee2_id = $request->employee2_id;
        $job->employee3_id = $request->employee3_id;
        $job->employee4_id = $request->employee4_id;
        $job->location_id = $request->location_id;
        $job->save();
        return redirect('/jobs');
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
        $job= Job::where('id', $id)->first();
        $vehicle = Vehicle::where('id', $job->vehicle_id)->first();
        $emp1 = DB::table('employees')->where('employees.id', $job->employee1_id)
        ->leftJoin('telephones', 'telephones.employee_id', 'employees.id')->first();
        $emp2 = DB::table('employees')->where('employees.id', $job->employee2_id)
        ->leftJoin('telephones', 'telephones.employee_id', 'employees.id')->first();
        $emp3 = DB::table('employees')->where('employees.id', $job->employee3_id)
        ->leftJoin('telephones', 'telephones.employee_id', 'employees.id')->first();
        $emp4 = DB::table('employees')->where('employees.id', $job->employee4_id)
        ->leftJoin('telephones', 'telephones.employee_id', 'employees.id')->first();
        $location = DB::table('locations')->where('locations.id', $job->location_id)
        ->leftJoin('counties', 'counties.id', 'locations.county_id')->first();
        

        return view('jobs.jobdetails',
            ['vehicle'=>$vehicle,
             'emp1'=>$emp1,
             'emp2'=>$emp2,
             'emp3'=>$emp3,
             'emp4'=>$emp4,
             'location'=>$location,
             'job'=>$job]);
        
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
        $job = Job::where('id', $id)->first();
        Vehicle::where('id', $job->vehicle_id)->update(['assigned' => 0]);
        Employee::where('id', $job->employee1_id)->update(['assigned' => 0]);
        Employee::where('id', $job->employee2_id)->update(['assigned' => 0]);
        Employee::where('id', $job->employee3_id)->update(['assigned' => 0]);
        Employee::where('id', $job->employee4_id)->update(['assigned' => 0]);
        $vehicles = Vehicle::where('assigned', 0)->select('id', 'description as vehicle')->get();
        $employees = Employee::where('assigned', 0)->select('id', 'firstName', 'lastName')->get();
        $locations = Location::select('id', 'location')->get();
        $preVehicle = Vehicle::where('id', $job->vehicle_id)->first();
        $preEmp1 = Employee::where('id', $job->employee1_id)->first();
        $preEmp2 = Employee::where('id', $job->employee2_id)->first();
        $preEmp3 = Employee::where('id', $job->employee3_id)->first();
        $preEmp4 = Employee::where('id', $job->employee4_id)->first();
        $prevloc = Location::where('id', $job->location_id)->first();

        // dd($job->id);
        return view('jobs.jobedit', [
            'vehicles'=>$vehicles,
            'employees'=>$employees,
            'locations'=> $locations,
            'preVehicle'=>$preVehicle,
            'preEmp1'=>$preEmp1,
            'preEmp2'=>$preEmp2,
            'preEmp3'=>$preEmp3,
            'preEmp4'=>$preEmp4,
            'prevloc'=>$prevloc,
            'job'=>$job->id
            ]);

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
            'vehicle_id'=> 'required|numeric',
            'employee1_id'=> 'required|numeric',
            'employee2_id'=> 'required|numeric',
            'employee3_id'=> 'required|numeric',
            'employee4_id'=> 'required|numeric',
            'location_id'=> 'required|numeric']);

        //mark the employees and houses as assigned
        Vehicle::where('id', $request->vehicle_id)->update(['assigned' => 1]);
        Employee::where('id', $request->employee1_id)->update(['assigned' => 1]);
        Employee::where('id', $request->employee2_id)->update(['assigned' => 1]);
        Employee::where('id', $request->employee3_id)->update(['assigned' => 1]);
        Employee::where('id', $request->employee4_id)->update(['assigned' => 1]);

        //insert into jobs table
        $job =Job::findOrFail($id);
        $job->vehicle_id = $request->vehicle_id;
        $job->employee1_id = $request->employee1_id;
        $job->employee2_id = $request->employee2_id;
        $job->employee3_id = $request->employee3_id;
        $job->employee4_id = $request->employee4_id;
        $job->location_id = $request->location_id;
        $job->update();
        return redirect('/jobs');
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
    }
    public function markCompleted($id){
        $job = Job::where('id', $id)->first();
        Vehicle::where('id', $job->vehicle_id)->update(['assigned' => 0]);
        Employee::where('id', $job->employee1_id)->update(['assigned' => 0]);
        Employee::where('id', $job->employee2_id)->update(['assigned' => 0]);
        Employee::where('id', $job->employee3_id)->update(['assigned' => 0]);
        Employee::where('id', $job->employee4_id)->update(['assigned' => 0]);
        Job::where('id', $id)->update(['status'=> 'complete']);
        return redirect('jobs');
    }
    public function jobActiveHouses($id){
       $location = Job::findOrFail($id)->location_id;
       $area = Location::findOrFail($location)->location;
       
       $houses = House::where([['location_id', $location],['status', 'active']])->get();
       
       return view('jobs.jobhouses',['houses'=>$houses,
            'area'=>$area]);
       
  }
}
