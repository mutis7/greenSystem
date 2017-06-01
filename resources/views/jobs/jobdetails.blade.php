@extends('layouts.adminDashboard')

@section('content')
<div class="container">
    <div class="row">
        
              
              <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Vehicles</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Type</th>
                          <th>Description</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>{{$vehicle->type}}</td>
                          <td>{{$vehicle->description}}</td>
                          <td>{{$vehicle->status}}</td>
                        </tr>                  
                      </tbody>
                    </table>
                   </div>
                </div>
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Location</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>County Name</th>
                          <th>Location Name</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>{{$location->location}}</td>
                          <td>{{$location->county}}</td>
                        </tr>                  
                      </tbody>
                    </table>
                   </div>
                </div>
              </div>

              <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Employees</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>ID Number</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Email</th>
                          <th>Telephone Number</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>{{$emp1->idNumber}}</td>
                          <td>{{$emp1->firstName}}</td>
                          <td>{{$emp1->lastName}}</td>
                          <td>{{$emp1->email}}</td>
                          <td>{{$emp1->telephoneNumber}}</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>{{$emp2->idNumber}}</td>
                          <td>{{$emp2->firstName}}</td>
                          <td>{{$emp2->lastName}}</td>
                          <td>{{$emp2->email}}</td>
                          <td>{{$emp2->telephoneNumber}}</td>
                        </tr>  
                        <tr>
                          <td>3</td>
                          <td>{{$emp3->idNumber}}</td>
                          <td>{{$emp3->firstName}}</td>
                          <td>{{$emp3->lastName}}</td>
                          <td>{{$emp3->email}}</td>
                          <td>{{$emp3->telephoneNumber}}</td>
                        </tr>    
                        <tr>
                          <td>4</td>
                          <td>{{$emp4->idNumber}}</td>
                          <td>{{$emp4->firstName}}</td>
                          <td>{{$emp4->lastName}}</td>
                          <td>{{$emp4->email}}</td>
                          <td>{{$emp4->telephoneNumber}}</td>
                        </tr>            
                      </tbody>
                    </table>
                   </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <a class="btn btn-info" href="{{ url('jobs/'.$job->id.'/edit') }}">edit</a>
              <a href="{{url('completedjob/'.$job->id)}}" class="btn btn-success">completed</a>
              <a href="{{url('exjobs/'.$job->id)}}" class="btn btn-primary">exceptions</a>
              <a href="{{url('jobhouses/'.$job->id)}}" class="btn btn-primary">houses</a>
    </div>
</div>
@endsection
