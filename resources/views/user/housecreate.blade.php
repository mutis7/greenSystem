@extends('layouts.userdashboard')

@section('content')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Add House</h4>
                            </div>
                            <div class="content">
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/houses') }}" >
                                    {{csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group {{ $errors->has('county_id') ? ' has-error' : '' }}">
                                                <label for="county_id" class="control-label">County Name</label>
                                                <select class="form-control" id="county">
                                                    <option selected="selected"> select county</option>
                                                    @foreach($counties as $county)
                                                        <option value="{{$county->id}}"> {{$county->county}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group {{ $errors->has('location_id') ? ' has-error' : '' }}">
                                                <label for="location_id" class="control-label">Location Name</label>
                                                <select class="form-control" id="location" name="location_id">
                                                    <option selected="selected"> select Location</option>
                                                    @foreach($locations as $location)
                                                        <option value="{{$location->id}}" class="{{$location->county_id}}"> {{$location->location}}</option>
                                                     @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
        
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group {{ $errors->has('house') ? ' has-error' : '' }}">
                                                <label for="house" class="control-label">House Name</label>
                                                <input id="house" type="text" class="form-control" name="house" value="{{ old('house') }}" required autofocus>
                                                @if ($errors->has('house'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('house') }}</strong>
                                                    </span>
                                                @endif
                                               <input type="hidden" value="{{ Auth::user()->id}}" name="user_id"> 
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-left">Submit</button>
                                    <div class="clearfix"></div>
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
