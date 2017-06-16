@extends('layouts.adminDashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Locations</h2></div>

                <div class="panel-body">
                    <table class="table table-striped table-hover" id="tablelocation">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>county Name</th>
                                <th>location name</th>
                                <th>Collection Day</th>
                                <th></th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach($locations as $location)
                            <tr>
                                <td>{{ $location->id }}</td>
                                <td>{{ $location->county }}</td>
                                <td>{{ $location->location }}</td>
                                <td>{{ $location->collection_day }}</td>
                                
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
<script type="text/javascript">
     // $("#tablelocation").DataTable();
     <!-- Datatables -->

    /*Display contacts_list table*/
    $(document).ready(function() {
        var handleDataTableButtons = function() {
            if ($("#tablelocation").length) {
                $("#tablelocation").DataTable({
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
