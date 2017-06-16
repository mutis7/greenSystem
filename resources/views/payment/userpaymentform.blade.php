@extends('layouts.userdashboard')

@section('content')
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">pay for house</h4>
                            </div>
                            <div class="content">
                                <form class="form-horizontal" role="form" method="POST" action="{{url('paypal')}}">
                                {{ csrf_field() }}
                                   
                                    <div class="col-md-12">
                                        <label class="form-group">{{$house->house}}</label>
                                    </div>
                                        <div class="col-md-12">
                                        <label class="form-group">Amount</label>
                                            <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                                                <input class="form-control" id="amount" name="amount" required autofocus >

                                                @if ($errors->has('amount'))
                                                    <span class="help-block">
                                                     <strong>{{ $errors->first('amount') }}</strong>
                                                    </span>
                                                 @endif                                               
                                            </div>
                                            <input type="hidden" name="house_id" value="{{ $house->id}}">
                                            <input type="hidden" name="house" value="{{ $house->house}}">
                                        </div>                                    
                                    
                                    <button type="submit" class="btn btn-info btn-fill pull-left">pay</button>
                                    <div class="clearfix"></div>
                                </form>
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
