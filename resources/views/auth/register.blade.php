@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">first name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">last name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('telephoneNo') ? ' has-error' : '' }}">
                            <label for="telephoneNo" class="col-md-4 control-label">Phone Number</label>

                            <div class="col-md-6">
                                <input id="telephoneNo" type="text" class="form-control" name="telephoneNo" value="{{ old('telephoneNo') }}" required placeholder="07XXXXXXXX">

                                @if ($errors->has('telephoneNo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telephoneNo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('county_id') ? ' has-error' : '' }}">
                            <label for="county_id" class="col-md-4 control-label">county Name</label>
                            <div class="col-md-6">
                                <select class="form-control" id="county">
                                    <option selected="selected"> select county</option>
                                    @foreach($counties as $county)
                                    <option value="{{$county->id}}"> {{$county->county}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('location_id') ? ' has-error' : '' }}">
                            <label for="location_id" class="col-md-4 control-label">location Name</label>
                            <div class="col-md-6">
                                <select name="location_id" class="form-control" id="location">
                                    <option selected="selected"> select location</option>
                                    @foreach($locations as $location)
                                    <option value="{{$location->id}}" class="{{$location->county_id}}"> {{$location->location}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('house') ? ' has-error' : '' }}">
                            <label for="house" class="col-md-4 control-label">house Name</label>
                            <div class="col-md-6">
                                <input id="house" type="text" class="form-control" name="house" value="{{ old('house') }}" required autofocus>
                                @if ($errors->has('house'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('house') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#county").change(function(event){
              var county = $("#county").val();
              $("#location>*").hide();
              $("."+county).show();
        }); 
    });
</script>
@endsection
