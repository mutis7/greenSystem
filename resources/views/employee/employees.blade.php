@extends('layouts.adminDashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Employees details</h2></div>

                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>employee Id</th>
                                <th>national Id</th>
                                <th>first name</th>
                                <th>last name</th>
                                <th>phone number</th>
                                <th>email</th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php $count= 0; ?>
                        @foreach($employees as $employee)
                            <tr>
                                <td>{{ ++$count }}</td>
                                <td>{{ $employee->idNumber }}</td>
                                <td>{{ $employee->firstName }}</td>
                                <td>{{ $employee->lastName }}</td>
                                <td>{{ $employee->telephoneNumber }}</td>
                                <td>{{ $employee->email }}</td>
                                <td><a class="btn btn-info btn-sm" href="{{ url('employees/'.$employee->employee_id.'/edit') }}">edit</a></td>
                                <td><form action="{{ url('employees/'.$employee->employee_id) }}" method="POST" >
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE')}}
                                            <button class="btn btn-danger btn-sm">delete</button>
                                        </form></td>
                                
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
