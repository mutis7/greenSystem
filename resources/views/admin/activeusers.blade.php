@extends('layouts.adminDashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>active users</h2></div>

                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Email</th>
                                <th>Phone number</th> 
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php $count =0;  ?>
                        @foreach($users as $user)
                            <tr>
                                <td>{{++$count}}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td> 
                                <td>{{ $user->telephoneNumber}}</td>                    
                                
                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
