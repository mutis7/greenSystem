@extends('layouts.userdashboard')

@section('content')
<div class="container-fluid">
                <div class="row">
                     <div class="col-md-4">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Balances</h4>
                                <H1>$0.00</H1>

                                <p class="category">my houses</p>
                            </div>
                            <div class="content">
                                <div>
                                    house 1: <b>$0.00</b><br><hr>
                                    house 2: <b>$0.00</b><br><hr>
                                    house 3: <b>$0.00</b><br>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">collection day</h4>
                            </div>
                            <div class="content">
                                <h3>Thursday</h3>
                                <p>12/03/2017</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">notification</h4>
                            </div>
                            <div class="content">
                                <p>no pending notifications</p>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
@endsection
