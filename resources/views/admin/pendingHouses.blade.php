@extends('layouts.adminDashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>pending Houses</h2></div>

                <div class="panel-body">
                    <table class="table table-striped table-hover" id="tabledormanthouses">
                        <thead>
                            <tr>
                                <th> #</th>
                                <th>House Name </th>
                                <th>Location </th>
                                <th>Regestered Email</th>
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
                                <td><form action="{{ url('allhouses/more') }}" method="POST" >
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" value="{{ $house->id }}">
                                            <button class="btn btn-info btn-sm">more details</button>
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
     // $("#tabledormanthouses").DataTable();
     <!-- Datatables -->

    /*Display contacts_list table*/
    $(document).ready(function() {
        var handleDataTableButtons = function() {
            if ($("#tabledormanthouses").length) {
                $("#tabledormanthouses").DataTable({
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
