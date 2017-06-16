@extends('layouts.adminDashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>active users</h2></div>

                <div class="panel-body">
                    <table class="table table-striped table-hover" id="users">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Email</th>
                                <th>Phone number</th> 
                                
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
                                <td>{{ $user->telephoneNumber}}</td>              
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
