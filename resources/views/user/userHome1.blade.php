@extends('layouts.userdashboard')

@section('content')
<div class="container-fluid">
                <div class="row">
                     <div class="col-md-5">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Balances</h4>
                                <H1>$0.00</H1>

                                <p class="category">my houses</p>
                            </div>
                            <div class="content">
                            
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>House Name</th>
                                    <th>Monthly Fee</th>
                                    <th>collection day</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($houses as $house)
                                   <tr>
                                    <td>{{$house->house}}</td>
                                    <td>{{$house->monthlyfee}}</td>
                                    <td>{{ $house->collection_day}}</td>
                                   </tr>
                                @endforeach
                                </tbody>

                            </table>
                                
                            
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">notification</h4>
                            </div>
                            <div class="content">
                                @foreach($pendings as $pending)
                                <div>
                                    {{ $pending->house}}: is waiting approval from the admin<br>
                                </div>
                            @endforeach
                            <p>no more pending notifications</p>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
@endsection
