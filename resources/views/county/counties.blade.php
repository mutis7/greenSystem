@extends('layouts.adminDashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Counties</h2></div>

                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>county Id</th>
                                <th>county name</th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach($counties as $county)
                            <tr>
                                <td>{{ $county->id }}</td>
                                <td>{{ $county->county }}</td>
                                
                                <td><a class="btn btn-info btn-sm" href="{{ url('counties/'.$county->id.'/edit') }}">edit</a></td>
                                <td><form action="{{ url('counties/'.$county->id) }}" method="POST" >
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
