<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Telephone;
use Illuminate\Support\Facades\DB;
class EmployeeController extends Controller
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
        $employees=DB::table('employees')
            ->leftJoin('telephones', 'employees.id', 'telephones.employee_id')
            ->paginate(10);

        return view('employee.employees',['employees'=>$employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('employee.employeecreate');
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
            'idNumber' => 'required|numeric',
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|unique:employees|email',
            'phoneNumber' => 'required|numeric']);

        $employee = new Employee;
        $employee->idNumber = $request->idNumber;
        $employee->firstName = $request->firstName;
        $employee->lastName = $request->lastName;
        $employee->email = $request->email;
        $employee->save();

        $telephone = new Telephone;
        $telephone->telephoneNumber = $request->phoneNumber;
        $telephone->employee_id = $employee->id;
        $telephone->save();

        return redirect('/employees');

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
        $employee=DB::table('employees')
            ->where('employee_id', $id)
            ->leftJoin('telephones', 'employees.id', 'telephones.employee_id')
            ->first();

        return view('employee.employeeedit', ['employee'=>$employee]);

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
            'idNumber' => 'required|numeric',
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'telephoneNumber' => 'required|numeric']);

        $employee = Employee::findOrFail($id);
        $employee->idNumber = $request->idNumber;
        $employee->firstName = $request->firstName;
        $employee->lastName = $request->lastName;
        $employee->email = $request->email;
        $employee->update();
        
        $tel = Telephone::where('employee_id', '=', $id)->get();
        $tel->telephoneNumber = $request->telephoneNumber;
        $tel->update(); //this update method is not working  
        
        return redirect('/employees');

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
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect('/employees');
    }

   
}
