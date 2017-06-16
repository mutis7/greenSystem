@extends('layouts.userdashboard')

@section('content')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">                     
                        <div class="card">
                            <div class="header">
                                <h4 class="title">my houses</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>#</th>
                                        <th>House</th>
                                        <th>Monthly fee</th>
                                        <th>Balance</th>
                                        <th>Pay here</th>
                                    </thead>
                                    <tbody>
                                        <?php $count =0; ?>
                        @foreach($houses as $house)
                                        <tr>
                                            <td>{{++$count}}</td>
                                            <td>{{$house->house}}</td>
                                            <td>{{$house->monthlyfee}}</td>
                                            <td>{{ $house->balance }}</td>
                                            
                                            
                                            <td><a class="btn btn-primary btn-fill" href="{{ url('housepay/'.$house->id) }}">Pay</a></td>
                                        </tr>
                             @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
 @if(session('message'))
    <script type="text/javascript">
        alert('{{ Session::get('message')}}');
    </script>
@endif
@endsection
