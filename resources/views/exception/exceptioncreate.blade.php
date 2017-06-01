@extends('layouts.adminDashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>
                add a new exception</h2></div>

                <div class="panel-body">
                    
                     <form class="form-horizontal" role="form" method="POST" action="{{ url('exceptionsave') }}" >
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('house_id') ? ' has-error' : '' }}">
                            <label for="house_id" class="col-md-4 control-label">House Name</label>
                            <div class="col-md-6">
                                <select class="form-control" id="house" name="house_id">
                                    <option selected="selected" value=""> select House</option>
                                    @foreach($houses as $house)
                                    <option value="{{$house->id}}"> {{$house->house}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>
                            <div class="col-md-6">
                                <textarea id="description"  class="form-control" name="description" value="{{ old('description') }}" required autofocus></textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <input type="hidden" value="{{ $job_id}}" name="job_id">
                        </div>

                        
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    submit
                                </button>
                            </div>
                        </div>
                    </form>
                    <a href="{{url('jobs/'.$job_id)}}" class="btn btn-sm btn-primary pull-right"> back to more details of the job</a>
                </div>
            </div>
        </div>
    </div>
</div>
 @if(session('status'))
    <script type="text/javascript">
        alert('{{ Session::get('status')}}');
    </script>
@endif

@endsection
