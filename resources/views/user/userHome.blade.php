@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>{{ Auth::user()->username }}</h2></div>

                <div class="panel-body">
                    You are logged in user!<br>
                    balance is: {{Auth::user()->getUserBalance()}}
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
