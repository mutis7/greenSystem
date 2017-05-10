@extends('layouts.userdashboard')

@section('content')
           <div class="row">
                <div class="col-md-8 col-md-offset-2">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Launch compaints</h4>
                            </div>
                            <div class="content">
                                <form class="form-horizontal" role="form" method="POST" action="/suggestions/save">
                                {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group {{ $errors->has('complain') ? 'has-error' : '' }}">
                                                <textarea class="form-control" id="complain" name="complain" rows="10" cols="30" required autofocus ></textarea> 
                                                @if ($errors->has('complain'))
                                                    <span class="help-block">
                                                     <strong>{{ $errors->first('complain') }}</strong>
                                                    </span>
                                                 @endif                                               
                                            </div>
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                                        </div>                                    
                                    </div>
                                    <button type="submit" class="btn btn-info btn-fill pull-left">submit</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
