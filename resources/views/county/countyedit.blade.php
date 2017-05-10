@extends('layouts.adminDashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>
                edit county</h2></div>

                <div class="panel-body">
                    
                     <form class="form-horizontal" role="form" method="POST" action="/counties/{{$county->id}}">  

                     {{ csrf_field() }}
                     {{ method_field('PUT') }}

                        <div class="form-group{{ $errors->has('county') ? ' has-error' : '' }}">
                            <label for="county" class="col-md-4 control-label">County Name</label>
                            <div class="col-md-6">
                                <input id="county" type="text" class="form-control" name="county" value="{{ $county->county }}" required autofocus>
                                @if ($errors->has('county'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('county') }}</strong>
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
