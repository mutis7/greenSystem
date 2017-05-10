@extends('layouts.userdashboard')

@section('content')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">                  
                        <div class="card">
                           <div class="header">
                               <h6 class="title">add house</h6>
                               <div class="content">
                                <p><a href="{{url('houses/create')}}">+ house</a></p>
                               </div>                                
                           </div>
                        </div>
                    </div>

                    <div class="col-md-12">                     
                        <div class="card">
                            <div class="header">
                                <h4 class="title">my houses</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>#</th>
                                        <th>County</th>
                                        <th>Location</th>
                                        <th>House</th>
                                        <th>Monthly Fee</th>
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
                                            <td>{{++$count}}</td>
                                            <td>{{$countyName}}</td>
                                            <td>{{$locationName}}</td>
                                            <td>{{ $house->house }}</td>
                                            <td>2000</td>
                                            <td><a class="btn btn-primary btn-fill" href="{{ url('houses/'.$house->id.'/edit') }}">edit</a></td>
                                            <td><form action="{{ url('houses/'.$house->id) }}" method="POST" >
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE')}}
                                            <button class="btn btn-danger btn-fill">Delete</button>
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
