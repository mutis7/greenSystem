@extends('layouts.userdashboard')

@section('content')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Profile</h4>
                            </div>
                            <div class="content">
                                <form class="form-horizontal" role="form" method="post" action="{{url('usersave')}}">
                                {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                                <label for="first_name" style="margin-left: 10px;">First Name</label>
                                                <input id="first_name" name="first_name" type="text" class="form-control"  value="{{$user->first_name}}" style="margin-left: 10px;">
                                                @if ($errors->has('first_name'))
                                                    <span class="help-block">
                                                         <strong>{{ $errors->first('first_name') }}</strong>
                                                    </span>
                                                @endif
                                                <input type="hidden" name="id" value="{{ $user->id}}">
                                            </div>
                                        </div>
                                    
                                
                                        <div class="col-md-5 col-md-offset-1">
                                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                                <label for="last_name">Last Name</label>
                                                <input id="last_name" name="last_name" type="text" class="form-control"  value="{{$user->last_name}}">
                                                @if ($errors->has('last_name'))
                                                    <span class="help-block">
                                                         <strong>{{ $errors->first('last_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label for="email" style="margin-left: 10px;">Email</label>
                                                <input id="email" name="email" type="email" class="form-control"  value="{{$user->email}}" style="margin-left: 10px;">
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                         <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-md-offset-1">
                                            <div class="form-group{{ $errors->has('telephoneNumber') ? ' has-error' : '' }}">
                                                <label for="telephoneNumber">Telephone Number</label>
                                                <input id="telephoneNumber" name="telephoneNumber" type="text" class="form-control"  value="{{$phone}}">
                                                @if ($errors->has('telephoneNumber'))
                                                    <span class="help-block">
                                                         <strong>{{ $errors->first('telephoneNumber') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                                <label for="username" style="margin-left: 10px;">Username</label>
                                                <input id="username" name="username" type="text" class="form-control"  value="{{$user->username}}" style="margin-left: 10px;">
                                                @if ($errors->has('username'))
                                                    <span class="help-block">
                                                         <strong>{{ $errors->first('username') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>



                                    <button type="submit" class="btn btn-info btn-fill ">Update Profile</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="background-color: #ececec;">
                            <div class="header">
                                <h4>Change Password</h4>
                            </div>
                            
                            <div class="content">
                                <form class="form-horizontal" role="form" method="post" action="{{url('changepassword')}}">
                                {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group {{ $errors->has('oldpassword') ? ' has-error' : '' }}">
                                                <label for="oldpassword" style="margin-left: 10px;"><b>OLD PASSWORD</b></label>
                                                <input type="password" name="oldpassword" class="form-control" placeholder="oldpassword"  style="margin-left: 10px;">
                                                @if ($errors->has('oldpassword'))
                                                    <span class="help-block">
                                                         <strong>{{ $errors->first('oldpassword') }}</strong>
                                                    </span>
                                                @endif
                                                @if(session('error'))                                                    
                                                    <span class="has-error">
                                                         <strong>{{ Session::get('error')}}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-md-offset-1">
                                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                                <label for="password"><b>NEW PASSWORD</b></label>
                                                <input type="password" name="password" class="form-control" placeholder="password" >
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                         <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    
                                    
                                        <div class="col-md-3 col-md-offset-1">
                                            <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                                <label for="password_confirmation"><b>CONFIRM PASSWORD</b></label>
                                                <input type="password" name="password_confirmation" class="form-control" placeholder="confirm password" >
                                                @if ($errors->has('password_confirmation'))
                                                    <span class="help-block">
                                                         <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-fill ">change password</button>
                                    <div class="clearfix"></div>
                                </form>
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
