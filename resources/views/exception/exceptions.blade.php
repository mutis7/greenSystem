@extends('layouts.adminDashboard')

@section('content')


    @forelse($exceptionJobs as $exceptionJob)
    <div class="col-md-9 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{$exceptionJob->house}} in location {{$exceptionJob->location}}
                <span class="pull-right clear-fix">
                    {{$exceptionJob->created_at->diffForHumans()}}
                </span>
            </div>
            <div class="panel-body">
                {{ $exceptionJob->description }}
            </div>
            <div class="panel-footer" style="height: 45px;">
               <span class="pull-right"> contact user using &nbsp; 
               <a href="{{url('genemail/'.$exceptionJob->id)}}" class="btn btn-sm btn-primary"> email</a>          
            </div>            
        </div>
    </div>
   
    @empty
    No Articles.
    @endforelse 

@endsection
