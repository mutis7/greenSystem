@extends('layouts.adminDashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>
                Manual Payment</h2></div>

                <div class="panel-body">
                    
                     <form class="form-horizontal" role="form" method="POST" action="{{ url('/payments') }}">
                        {{ csrf_field() }}

                        

                        <div class="form-group{{ $errors->has('house') ? ' has-error' : '' }}">
                            <label for="house" class="col-md-4 control-label">House Name</label>
                            <div class="col-md-6">
                                <input id="house" type="text" class="form-control" name="house" value="{{ old('house') }}" required autofocus>
                                @if ($errors->has('house'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('house') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Payers Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="amount" class="col-md-4 control-label">Amount</label>
                            <div class="col-md-6">
                                <input id="amount" type="number" class="form-control" name="amount" value="{{ old('amount') }}" required autofocus>
                                @if ($errors->has('amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
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
@if(session('message'))
    <script type="text/javascript">
        alert('{{ Session::get('message')}}');
    </script>
@endif
@endsection
