@extends('layouts.admindashboard')

@section('content')
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>houses in {{$area}}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table id="jobhouses" class="table table-bordered">
                                
                                    <thead>
                                        <th>#</th>
                                        <th>done</th>
                                        <th>house</th>
                                        <th>exceptons</th>
                                    </thead>
                                    <tbody>
                                        <?php $count =0; ?>
                        @foreach($houses as $house)
                                        <tr>
                                            <td>{{++$count}}</td>
                                            <td><input type="checkbox" name=""></td>
                                            <td>{{$house->house}}</td>
                                            <td><textarea style="height: 40px; width: 500px;"></textarea></td>
                                            
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
     // $("#tableongoingjobs").DataTable();
     <!-- Datatables -->

    /*Display contacts_list table*/
    $(document).ready(function() {
        var handleDataTableButtons = function() {
            if ($("#jobhouses").length) {
                $("#jobhouses").DataTable({
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