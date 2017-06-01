@extends('layouts.adminDashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>
                add a new job</h2></div>

                <div class="panel-body">
                    
                     <form class="form-horizontal" role="form" method="POST" action="{{ url('/jobs') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('vehicle_id') ? ' has-error' : '' }}">
                            <label for="vehicle_id" class="col-md-4 control-label">Vehicle</label>
                            <div class="col-md-6">
                                <select name="vehicle_id" class="form-control">
                                    <option selected="selected"> select vehicle</option>
                                    @foreach($vehicles as $vehicle)
                                    <option value="{{$vehicle->id}}"> {{$vehicle->vehicle}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('employee1_id') ? ' has-error' : '' }}">
                            <label for="employee1_id" class="col-md-4 control-label">Employee 1</label>
                            <div class="col-md-6">
                                <select name="employee1_id" class="form-control">
                                    <option selected="selected"> select employee</option>
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->id}}"> {{$employee->firstName}} {{$employee->lastName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('employee2_id') ? ' has-error' : '' }}">
                            <label for="employee2_id" class="col-md-4 control-label">Employee 2</label>
                            <div class="col-md-6">
                                <select name="employee2_id" class="form-control">
                                    <option selected="selected"> select employee</option>
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->id}}"> {{$employee->firstName}} {{$employee->lastName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('employee3_id') ? ' has-error' : '' }}">
                            <label for="employee3_id" class="col-md-4 control-label">Employee 3</label>
                            <div class="col-md-6">
                                <select name="employee3_id" class="form-control">
                                    <option selected="selected"> select employee</option>
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->id}}"> {{$employee->firstName}} {{$employee->lastName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('employee4_id') ? ' has-error' : '' }}">
                            <label for="employee4_id" class="col-md-4 control-label">Employee 4</label>
                            <div class="col-md-6">
                                <select name="employee4_id" class="form-control">
                                    <option selected="selected"> select employee</option>
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->id}}"> {{$employee->firstName}} {{$employee->lastName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('location_id') ? ' has-error' : '' }}">
                            <label for="location_id" class="col-md-4 control-label">Location</label>
                            <div class="col-md-6">
                                <select name="location_id" class="form-control">
                                    <option selected="selected"> select location</option>
                                    @foreach($locations as $location)
                                    <option value="{{$location->id}}"> {{$location->location}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
