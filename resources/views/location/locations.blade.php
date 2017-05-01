@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Locations</h2></div>

                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th> Id</th>
                                <th>county Id</th>
                                <th>location name</th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach($locations as $location)
                            <tr>
                                <td>{{ $location->id }}</td>
                                <td>{{ $location->county_id }}</td>
                                <td>{{ $location->location }}</td>
                                
                                <td><a class="btn btn-info btn-sm" href="{{ url('locations/'.$location->id.'/edit') }}">edit</a></td>
                                <td><form action="{{ url('locations/'.$location->id) }}" method="POST" >
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