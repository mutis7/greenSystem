@extends('layouts.adminDashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>All Active Houses</h2></div>

                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th> #</th>
                                <th>House Name </th>
                                <th>Location </th>
                                <th>Regestered Email</th>
                                <th>Monthly Fee</th>
                                <th>Balance</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                        <?php $count =0; ?>
                        @foreach($houses as $house)
                            <tr>
                                <td>{{ ++$count }}</td>
                                <td>{{ $house->house}}</td>
                                <td>{{ $house->location }}</td>
                                <td>{{ $house->email }}</td>
                                <td>{{ $house->monthlyfee }}</td>
                                <td>{{ $house->balance }}</td> 

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
