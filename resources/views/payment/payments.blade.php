@extends('layouts.adminDashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>payments records</h2></div>

                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>payment id</th>
                                <th>Amount</th>
                                <th>house</th>
                                <th>paid at</th>
                                <th>paid by</th>                                
                            </tr>
                        </thead>
                        <tbody>
                        
                        @foreach($payments as $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
                                <td>{{ $payment->amount }}</td>
                                <td>{{ $payment->house }}</td>
                                <td>{{ $payment->created_at }}</td>
                                <td>{{ $payment->payer }}</td>         
                                <td><a class="btn btn-info btn-sm" href="{{ url('payments/'.$payment->id.'/edit') }}">edit</a></td>
                                <td><form action="{{ url('payments/'.$payment->id) }}" method="POST" >
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE')}}
                                            <button class="btn btn-danger btn-sm">delete</button>  
                                            </form>
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
@endsection
