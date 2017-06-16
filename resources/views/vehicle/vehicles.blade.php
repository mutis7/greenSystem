@extends('layouts.adminDashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Vehicles details</h2></div>

                <div class="panel-body">
                    <table class="table table-striped table-hover" id="tablevehicle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>type</th>
                                <th>description</th>
                                <th>status</th>
                                <th></th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php $count= 0; ?>
                        @foreach($vehicles as $vehicle)
                            <tr>
                                <td>{{ ++$count }}</td>
                                <td>{{ $vehicle->type }}</td>
                                <td>{{ $vehicle->description }}</td>
                                <td>{{ $vehicle->status }}</td>
                                <td><a class="btn btn-info btn-sm" href="{{ url('vehicles/'.$vehicle->id.'/edit') }}">edit</a></td>
                                <td><form action="{{ url('vehicles/'.$vehicle->id) }}" method="POST" >
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
<script type="text/javascript">
     // $("#tablevehicle").DataTable();
     <!-- Datatables -->

    /*Display contacts_list table*/
    $(document).ready(function() {
        var handleDataTableButtons = function() {
            if ($("#tablevehicle").length) {
                $("#tablevehicle").DataTable({
                    autoWidth:false,
                    dom: "Bfrtip",
                    buttons: [
                        {
                            extend: "copy",
                            className: "btn-sm"
                        },
                        {
                            extend: "csv",
                            className: "btn-sm"
                        },
                        
                        {
                            extend: "print",
                            className: "btn-sm"
                        },
                    ],
                    responsive: true
                });
            }
        };

        TableManageButtons = function() {
            "use strict";
            return {
                init: function() {
                    handleDataTableButtons();
                }
            };
        }();

        TableManageButtons.init();
    });

</script>
@endsection
