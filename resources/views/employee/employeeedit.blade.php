@extends('layouts.adminDashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>
                edit employee</h2></div>

                <div class="panel-body">
                    
                     <form class="form-horizontal" role="form" method="POST" action="{{ url('employees/'.$employee->employee_id) }}">  
                     {{ csrf_field() }} 
                     {{ method_field('PUT') }}

                     <div class="form-group{{ $errors->has('idNumber') ? ' has-error' : '' }}">
                            <label for="idNumber" class="col-md-4 control-label">National Id Number</label>
                            <div class="col-md-6">
                                <input id="idNumber" type="text" class="form-control" name="idNumber" value="{{ $employee->idNumber }}" required autofocus>
                                @if ($errors->has('idNumber'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('idNumber') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                            <label for="firstName" class="col-md-4 control-label">First Name</label>
                            <div class="col-md-6">
                                <input id="firstName" type="text" class="form-control" name="firstName" value="{{ $employee->firstName }}" required autofocus>
                                @if ($errors->has('firstName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                            <label for="lastName" class="col-md-4 control-label">Last Name</label>
                            <div class="col-md-6">
                                <input id="lastName" type="text" class="form-control" name="lastName" value="{{ $employee->lastName }}" required autofocus>
                                @if ($errors->has('lastName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $employee->email }}" autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('telephoneNumber') ? ' has-error' : '' }}">
                            <label for="telephoneNumber" class="col-md-4 control-label">Telephone Number</label>
                            <div class="col-md-6">
                                <input id="telephoneNumber" type="text" class="form-control" name="telephoneNumber" value ="{{ $employee->telephoneNumber }}">

                                @if ($errors->has('telephoneNumber'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telephoneNumber') }}</strong>
                                    </span>
                                @endif
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
