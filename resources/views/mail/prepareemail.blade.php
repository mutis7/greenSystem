@extends('layouts.adminDashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>
                This email will be sent to {{$user->username}} concerning house {{$user->house}}</h2></div>
                <div class="panel-body">
                    
                     <form class="form-horizontal" role="form" method="POST" action="{{url('email')}}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('mail') ? ' has-error' : '' }}">
                            
                            <div class="col-md-7">
                                <textarea id="mail" class="form-control" name="mail" value="{{ old('mail') }}" rows="10" cols="30" required autofocus>
                                    
                                </textarea>
                                @if ($errors->has('mail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mail') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <div class="col-md-7">
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
 @if(session('message'))
    <script type="text/javascript">
        alert('{{ Session::get('message')}}');
    </script>
@endif
@endsection
