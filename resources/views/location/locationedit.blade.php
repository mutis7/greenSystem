@extends('layouts.adminDashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>
                edit location</h2></div>

                <div class="panel-body">
                    
                     <form class="form-horizontal" role="form" method="POST" action="/locations/{{$location->id}}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group{{ $errors->has('county_id') ? ' has-error' : '' }}">
                            <label for="county_id" class="col-md-4 control-label">county Name</label>
                            <div class="col-md-6">
                                <select name="county_id" class="form-control">
                                    @foreach($counties as $county)
                                    <option value="{{$county->id}}"> {{$county->county}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">Location Name</label>
                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control" name="location" value="{{$location->location}}" required autofocus>
                                @if ($errors->has('location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
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
