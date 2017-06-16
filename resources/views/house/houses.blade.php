@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>my Houses</h2></div>

                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th> #</th>
                                <th>county </th>
                                <th>location </th>
                                <th>house</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $count =0; ?>
                        @foreach($houses as $house)
                        <?php
foreach ($locations as $location) {
    # code...
    if ($location->id==$house->location_id) {
        # code...
        $locationName = $location->location;
        $countyId = $location->county_id;
        break;
    }
}
foreach ($counties as $county) {
    # code...
    if($county->id== $countyId){
        $countyName = $county->county;
        break;
    }
}
  ?>
                            <tr>
                                <td>{{ ++$count }}</td>
                                <td>{{ $countyName}}</td>
                                <td>{{ $locationName }}</td>
                                <td>{{ $house->house }}</td>
                                
                                <td><a class="btn btn-info btn-sm" href="{{ url('houses/'.$house->id.'/edit') }}">edit</a></td>
                                <td><form action="{{ url('houses/'.$house->id) }}" method="POST" >
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
     // $("#users").DataTable();
     <!-- Datatables -->

    /*Display contacts_list table*/
    $(document).ready(function() {
        var handleDataTableButtons = function() {
            if ($("#users").length) {
                $("#users").DataTable({
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
