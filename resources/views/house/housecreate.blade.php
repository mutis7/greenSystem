@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>
                add a new house</h2></div>

                <div class="panel-body">
                    
                     <form class="form-horizontal" role="form" method="POST" action="{{ url('/houses') }}" >
                        {{ csrf_field() }}

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
                            <input type="hidden" value="{{ Auth::user()->id}}" name="user_id">
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
