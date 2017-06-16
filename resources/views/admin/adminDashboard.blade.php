@extends('layouts.adminDashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Quick Navigations</h2></div>

                <div class="panel-body">
                    <br>
                    <a href="{{url('jobs/create')}}" class="btn btn-info btn-lg">Assign Jobs</a><br>
                    <a href="{{url('unreadcomplaints')}}" class="btn btn-info btn-lg">Respond to complaints</a><br>
                    <a href="{{url('exceptionjobs')}}" class="btn btn-info btn-lg">contact customers with exceptions</a><br>
                    <a href="{{url('debthouses')}}" class="btn btn-info btn-lg">houses with debts</a><br>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
