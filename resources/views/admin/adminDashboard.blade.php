@extends('layouts.adminDashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>{{ Auth::user()->username }}</h2></div>

                <div class="panel-body">
                    You are logged in Admin!<br>
                    <a href="{{url('/activate')}}">activate users</a><br>
                    <a href="{{url('/activeusers')}}">active users</a><br>
                    <a href="{{url('/payments/create')}}">add payment</a><br>
                    <a href="{{url('/payments')}}">payments details</a><br>
                    <a href="{{url('/employees')}}">employees details</a><br>
                    <a href="{{url('/employees/create')}}">add employee</a><br>
                    <a href="{{url('/counties/create')}}">add county</a><br>
                    <a href="{{url('/counties')}}">counties</a><br>
                    <a href="{{url('/locations/create')}}">add location</a><br>
                    <a href="{{url('/locations')}}">locations</a><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
