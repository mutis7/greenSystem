@extends('layouts.adminDashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>house details</h2></div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/makeActive') }}">
                        {{ csrf_field() }}
                        <div>
                            <label for="house" class="col-md-4 control-label">House</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control"  value="{{$house->house}}" disabled="disabled">
                            </div>
                        </div>
                        <div>
                            <label for="location" class="col-md-4 control-label">Location</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control"  value="{{$house->location}}" disabled="disabled">
                            </div>
                        </div>
                        <div>
                            <label for="county" class="col-md-4 control-label">County</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control"  value="{{$county->county}}" disabled="disabled">
                            </div>
                        </div>
                        <div>
                            <label for="fname" class="col-md-4 control-label">User First Name</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" " value="{{$house->first_name}}" disabled="disabled">
                            </div>
                        </div>
                        <div>
                            <label for="lname" class="col-md-4 control-label">User Last Name</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control"  value="{{$house->last_name}}" disabled="disabled">
                            </div>
                        </div>
                        <div>
                            <label for="email" class="col-md-4 control-label">User Email</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control"  value="{{$house->email}}" disabled="disabled">
                            </div>
                        </div>
                        <div>
                            <label for="phone" class="col-md-4 control-label">User Telephone Number</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control"  value="{{$house->telephoneNumber}}" disabled="disabled">

                            </div>
                        </div>
                        <div>
                            <label for="balance" class="col-md-4 control-label">Balance</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control"  value="{{$house->balance}}" disabled="disabled">

                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('monthlyfee') ? ' has-error' : '' }}">
                            <label for="monthlyfee" class="col-md-4 control-label">Monthly Fee</label>
                            <div class="col-md-7">
                                <input id="monthlyfee" type="text" class="form-control" name="monthlyfee" value="{{$house->monthlyfee}}" required>

                                @if ($errors->has('monthlyfee'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('monthlyfee') }}</strong>
                                    </span>
                                @endif
                                <p>please update monthly fee to put the amount to be paid</p>
                            </div>
                            <input type="hidden" name="id" value="{{$house->id}}">
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    activate
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
 