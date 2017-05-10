@extends('layouts.adminDashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>inactive users</h2></div>

                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>email</th>
                                <th>status</th>
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
                                <td>{{ $user->status }}</td>
                                <td><a class="btn btn-info btn-sm" href="{{ url('activate/'.$user->id) }}">activate</a></td>
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
