@extends('layouts.adminDashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>currently ongoing Jobs details</h2></div>

                <div class="panel-body">
                    <table class="table table-striped table-hover" id="tablecompletedjobs">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>vehicle dispatched</th>
                                <th>Employee 1</th>
                                <th>Employee 2</th>
                                <th>Employee 3</th>
                                <th>Employee 4</th> 
                                <th>Location</th>
                                <th>date</th> 
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $count= 0; ?>
                        @foreach($jobs as $job)
                            <tr>
                                <td>{{ ++$count }}</td>
                                <td>{{ $job->vehicle }}</td>
                                <td>{{ $job->emp1FirstName }}  {{ $job->emp1LastName }}</td>
                                <td>{{ $job->emp2FirstName }}  {{ $job->emp2LastName }}</td>
                                <td>{{ $job->emp3FirstName }}  {{ $job->emp3LastName }}</td>
                                <td>{{ $job->emp4FirstName }}  {{ $job->emp4LastName }}</td>
                                <td>{{ $job->location }}</td> 
                                <td>{{ $job->created_at}}</td>
                                <td>
                                	<a href="{{ url('jobs/'.$job->id) }}" class="btn btn-sm btn-info">more</a>
                                </td>
                                
                                <td>
                                    <a href="{{url('exjobs/'.$job->id)}}" class="btn btn-sm btn-danger">exceptions</a>
                                </td>
                                
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
     // $("#tablecompletedjobs").DataTable();
     <!-- Datatables -->

    /*Display contacts_list table*/
    $(document).ready(function() {
        var handleDataTableButtons = function() {
            if ($("#tablecompletedjobs").length) {
                $("#tablecompletedjobs").DataTable({
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
